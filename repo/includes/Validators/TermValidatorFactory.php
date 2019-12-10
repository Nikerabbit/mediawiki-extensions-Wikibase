<?php

namespace Wikibase\Repo\Validators;

use InvalidArgumentException;
use ValueValidators\ValueValidator;
use Wikibase\DataModel\Entity\EntityIdParser;
use Wikibase\DataModel\Entity\Item;
use Wikibase\DataModel\Entity\Property;
use Wikibase\DataModel\Services\Lookup\TermLookup;
use Wikibase\LabelDescriptionDuplicateDetector;
use Wikibase\Repo\Store\TermsCollisionDetectorFactory;

/**
 * Provides validators for terms (like the maximum length of labels, etc).
 *
 * @license GPL-2.0-or-later
 * @author Daniel Kinzler
 */
class TermValidatorFactory {

	/**
	 * @var int
	 */
	private $maxLength;

	/**
	 * @var string[]
	 */
	private $languageCodes;

	/**
	 * @var EntityIdParser
	 */
	private $idParser;

	/**
	 * @var LabelDescriptionDuplicateDetector
	 */
	private $duplicateDetector;

	/**
	 * @var TermsCollisionDetectorFactory
	 */
	private $termsCollisionDetectorFactory;

	/**
	 * @var TermLookup
	 */
	private $termLookup;

	/** @var array */
	private $itemTermsMigrationStage;

	/** @var int */
	private $propertyTermsMigrationStage;

	/**
	 * @param int $maxLength The maximum length of terms.
	 * @param string[] $languageCodes A list of valid language codes
	 * @param EntityIdParser $idParser
	 * @param LabelDescriptionDuplicateDetector $duplicateDetector
	 * @param TermsCollisionDetectorFactory $termsCollisionDetectorFactory
	 * @param TermLookup $termLookup
	 *
	 * @throws InvalidArgumentException
	 */
	public function __construct(
		$maxLength,
		array $languageCodes,
		EntityIdParser $idParser,
		LabelDescriptionDuplicateDetector $duplicateDetector,
		TermsCollisionDetectorFactory $termsCollisionDetectorFactory,
		TermLookup $termLookup,
		array $itemTermsMigrationStage,
		int $propertyTermsMigrationStage
	) {
		if ( !is_int( $maxLength ) || $maxLength <= 0 ) {
			throw new InvalidArgumentException( '$maxLength must be a positive integer.' );
		}

		$this->maxLength = $maxLength;
		$this->languageCodes = $languageCodes;
		$this->idParser = $idParser;
		$this->duplicateDetector = $duplicateDetector;
		$this->termsCollisionDetectorFactory = $termsCollisionDetectorFactory;
		$this->termLookup = $termLookup;
		$this->itemTermsMigrationStage = $itemTermsMigrationStage;
		$this->propertyTermsMigrationStage = $propertyTermsMigrationStage;
	}

	public function getFingerprintUniquenessValidator( string $entityType ): ?ValueValidator {
		if ( in_array( $entityType, [ Item::ENTITY_TYPE, Property::ENTITY_TYPE ] ) ) {
			$fingerprintUniquenessValidator = new FingerprintUniquenessValidator(
				$this->termsCollisionDetectorFactory->getTermsCollisionDetector( $entityType ),
				$this->termLookup
			);

			return new ByIdFingerprintUniquenessValidator(
				$this->itemTermsMigrationStage,
				$this->propertyTermsMigrationStage,
				$fingerprintUniquenessValidator
			);
		}

		return null;
	}

	/**
	 * Returns a validator for checking an (updated) fingerprint.
	 * May be used to apply global uniqueness checks.
	 *
	 * @note The fingerprint validator provided here is intended to apply
	 *       checks in ADDITION to the ones performed by the validators
	 *       returned by the getLabelValidator() etc functions below.
	 *
	 * @param string $entityType
	 *
	 * @return FingerprintValidator
	 */
	public function getFingerprintValidator( $entityType ) {
		$notEqualValidator = new LabelDescriptionNotEqualValidator();

		//TODO: Make this configurable. Use a builder. Allow more types to register.

		switch ( $entityType ) {
			case Item::ENTITY_TYPE:
				return new CompositeFingerprintValidator( [
					$notEqualValidator,
					new LabelDescriptionUniquenessValidator( $this->duplicateDetector ),
				] );

			default:
				return $notEqualValidator;
		}
	}

	/**
	 * @param string $entityType
	 *
	 * @return ValueValidator
	 */
	public function getLabelValidator( $entityType ) {
		$validators = $this->getCommonTermValidators( 'label-' );

		//TODO: Make this configurable. Use a builder. Allow more types to register.
		if ( $entityType === Property::ENTITY_TYPE ) {
			$validators[] = new NotEntityIdValidator( $this->idParser, 'label-no-entityid', [ Property::ENTITY_TYPE ] );
		}

		return new CompositeValidator( $validators, true );
	}

	/**
	 * @return ValueValidator
	 */
	public function getDescriptionValidator() {
		$validators = $this->getCommonTermValidators( 'description-' );

		return new CompositeValidator( $validators, true );
	}

	/**
	 * @param string $entityType
	 *
	 * @return ValueValidator
	 */
	public function getAliasValidator( $entityType ) {
		$validators = $this->getCommonTermValidators( 'alias-' );

		return new CompositeValidator( $validators, true );
	}

	/**
	 * @param string $errorCodePrefix
	 * @return ValueValidator[]
	 */
	private function getCommonTermValidators( $errorCodePrefix ) {
		$validators = [];
		$validators[] = new TypeValidator( 'string' );
		$validators[] = new StringLengthValidator( 1, $this->maxLength, 'mb_strlen', $errorCodePrefix );
		// no leading/trailing whitespace, no tab or vertical whitespace, no line breaks.
		$validators[] = new RegexValidator( '/^\s|[\v\t]|\s$/u', true );

		return $validators;
	}

	/**
	 * @return ValueValidator
	 */
	public function getLanguageValidator() {
		$validators = [];
		$validators[] = new TypeValidator( 'string' );
		$validators[] = new MembershipValidator( $this->languageCodes, 'not-a-language' );

		$validator = new CompositeValidator( $validators, true ); //Note: each validator is fatal
		return $validator;
	}

}
