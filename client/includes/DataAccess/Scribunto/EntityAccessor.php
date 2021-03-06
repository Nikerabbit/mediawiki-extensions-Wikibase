<?php

namespace Wikibase\Client\DataAccess\Scribunto;

use Language;
use Serializers\Serializer;
use Wikibase\Client\Serializer\ClientEntitySerializer;
use Wikibase\Client\Serializer\ClientStatementListSerializer;
use Wikibase\Client\Usage\UsageAccumulator;
use Wikibase\DataModel\Entity\EntityIdParser;
use Wikibase\DataModel\Services\Lookup\EntityLookup;
use Wikibase\DataModel\Services\Lookup\PropertyDataTypeLookup;
use Wikibase\DataModel\Statement\StatementListProvider;
use Wikibase\DataModel\Entity\PropertyId;
use Wikibase\LanguageFallbackChain;
use Wikibase\Lib\ContentLanguages;
use Wikibase\Lib\Store\RevisionedUnresolvedRedirectException;

/**
 * Functionality needed to expose Entities to Lua.
 *
 * @license GPL-2.0+
 */
class EntityAccessor {

	/**
	 * @var EntityIdParser
	 */
	private $entityIdParser;

	/**
	 * @var EntityLookup
	 */
	private $entityLookup;

	/**
	 * @var UsageAccumulator
	 */
	private $usageAccumulator;

	/**
	 * @var Serializer
	 */
	private $entitySerializer;

	/**
	 * @var Serializer
	 */
	private $statementSerializer;

	/**
	 * @var PropertyDataTypeLookup
	 */
	private $dataTypeLookup;

	/**
	 * @var LanguageFallbackChain
	 */
	private $fallbackChain;

	/**
	 * @var Language
	 */
	private $language;

	/**
	 * @var ContentLanguages
	 */
	private $termsLanguages;

	public function __construct(
		EntityIdParser $entityIdParser,
		EntityLookup $entityLookup,
		UsageAccumulator $usageAccumulator,
		Serializer $entitySerializer,
		Serializer $statementSerializer,
		PropertyDataTypeLookup $dataTypeLookup,
		LanguageFallbackChain $fallbackChain,
		Language $language,
		ContentLanguages $termsLanguages
	) {
		$this->entityIdParser = $entityIdParser;
		$this->entityLookup = $entityLookup;
		$this->usageAccumulator = $usageAccumulator;
		$this->entitySerializer = $entitySerializer;
		$this->statementSerializer = $statementSerializer;
		$this->dataTypeLookup = $dataTypeLookup;
		$this->fallbackChain = $fallbackChain;
		$this->language = $language;
		$this->termsLanguages = $termsLanguages;
	}

	/**
	 * Recursively renumber a serialized array in place, so it is indexed at 1, not 0.
	 * Just like Lua wants it.
	 *
	 * @param array &$entityArr
	 */
	private function renumber( array &$entityArr ) {
		foreach ( $entityArr as &$value ) {
			if ( !is_array( $value ) ) {
				continue;
			}
			if ( array_key_exists( 0, $value ) ) {
				$value = array_combine( range( 1, count( $value ) ), array_values( $value ) );
			}
			$this->renumber( $value );
		}
	}

	/**
	 * Get entity from prefixed ID (e.g. "Q23") and return it as serialized array.
	 *
	 * @param string $prefixedEntityId
	 *
	 * @return array|null
	 */
	public function getEntity( $prefixedEntityId ) {
		$prefixedEntityId = trim( $prefixedEntityId );

		$entityId = $this->entityIdParser->parse( $prefixedEntityId );

		$this->usageAccumulator->addAllUsage( $entityId );

		try {
			$entityObject = $this->entityLookup->getEntity( $entityId );
		} catch ( RevisionedUnresolvedRedirectException $ex ) {
			// We probably hit a double redirect
			wfLogWarning(
				'Encountered a UnresolvedRedirectException when trying to load ' . $prefixedEntityId
			);

			return null;
		}

		if ( $entityObject === null ) {
			return null;
		}

		$entityArr = $this->newClientEntitySerializer()->serialize( $entityObject );

		// Renumber the entity as Lua uses 1-based array indexing
		$this->renumber( $entityArr );
		$entityArr['schemaVersion'] = 2;

		return $entityArr;
	}

	/**
	 * Get statement list from prefixed ID (e.g. "Q23") and property (e.g "P123") and return it as serialized array.
	 *
	 * @param string $prefixedEntityId
	 * @param string $propertyIdSerialization
	 *
	 * @return array|null
	 */
	public function getEntityStatement( $prefixedEntityId, $propertyIdSerialization ) {
		$prefixedEntityId = trim( $prefixedEntityId );
		$entityId = $this->entityIdParser->parse( $prefixedEntityId );

		$propertyId = new PropertyId( $propertyIdSerialization );
		$this->usageAccumulator->addStatementUsage( $entityId, $propertyId );
		$this->usageAccumulator->addOtherUsage( $entityId );

		try {
			$entityObject = $this->entityLookup->getEntity( $entityId );
		} catch ( RevisionedUnresolvedRedirectException $ex ) {
			// We probably hit a double redirect
			wfLogWarning(
				'Encountered a UnresolvedRedirectException when trying to load ' . $prefixedEntityId
			);

			return null;
		}

		if ( $entityObject === null ) {
			return null;
		}

		$statements = $entityObject->getStatements();

		$statementsProp = $statements->getByPropertyId( $propertyId );
		$statementsRanked = $statementsProp->getBestStatements();
		$statementArr = $this->newClientStatementListSerializer()->serialize( $statementsRanked );
		$this->renumber( $statementArr );

		return $statementArr;
	}

	private function newClientEntitySerializer() {
		return new ClientEntitySerializer(
			$this->entitySerializer,
			$this->dataTypeLookup,
			array_unique( array_merge(
				$this->termsLanguages->getLanguages(),
				$this->fallbackChain->getFetchLanguageCodes(),
				[ $this->language->getCode() ]
			) ),
			[ $this->language->getCode() => $this->fallbackChain ]
		);
	}

	private function newClientStatementListSerializer() {
		return new ClientStatementListSerializer(
			$this->statementSerializer,
			$this->dataTypeLookup
		);
	}

}
