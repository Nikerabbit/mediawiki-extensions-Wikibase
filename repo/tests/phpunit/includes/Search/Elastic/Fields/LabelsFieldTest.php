<?php

namespace Wikibase\Repo\Tests\Search\Elastic\Fields;

use CirrusSearch;
use PHPUnit_Framework_TestCase;
use SearchEngine;
use Wikibase\DataModel\Entity\EntityDocument;
use Wikibase\DataModel\Entity\Item;
use Wikibase\DataModel\Entity\Property;
use Wikibase\Repo\Search\Elastic\Fields\LabelsField;

/**
 * @covers Wikibase\Repo\Search\Elastic\Fields\LabelsField
 *
 * @group WikibaseElastic
 * @group Wikibase
 *
 */
class LabelsFieldTest extends PHPUnit_Framework_TestCase {

	public function getFieldDataProvider() {
		$item = new Item();
		$item->getFingerprint()->setLabel( 'es', 'Gato' );
		$item->getFingerprint()->setLabel( 'ru', 'Кошка' );
		$item->getFingerprint()->setLabel( 'de', 'Katze' );
		$item->getFingerprint()->setLabel( 'fr', 'Chat' );

		$prop = Property::newFromType( 'string' );
		$prop->getFingerprint()->setLabel( 'en', 'astrological sign' );
		$prop->getFingerprint()->setLabel( 'ru', 'знак зодиака' );
		$prop->getFingerprint()->setAliasGroup( 'en', [ 'zodiac sign' ] );
		$prop->getFingerprint()->setAliasGroup( 'es', [ 'signo zodiacal' ] );

		$mock = $this->getMock( EntityDocument::class );

		return [
			[
				[
					'es' => [ 'Gato' ],
					'ru' => [ 'Кошка' ],
					'de' => [ 'Katze' ],
					'fr' => [ 'Chat' ]
				],
				$item
			],
			[
				[
					'en' => [ 'astrological sign', 'zodiac sign' ],
					'ru' => [ 'знак зодиака' ],
					'es' => [ '', 'signo zodiacal' ],
				],
				$prop
			],
			[ [], $mock ]
		];
	}

	/**
	 * @dataProvider  getFieldDataProvider
	 */
	public function testLabels( $expected, EntityDocument $entity ) {
		$labels = new LabelsField( [ 'en', 'es', 'ru', 'de' ] );
		$this->assertEquals( $expected, $labels->getFieldData( $entity ) );
	}

	public function testGetMapping() {
		if ( !class_exists( CirrusSearch::class ) ) {
			$this->markTestSkipped( 'CirrusSearch needed.' );
		}
		$labels = new LabelsField( [ 'en', 'es', 'ru', 'de' ] );

		$searchEngine = $this->getMockBuilder( CirrusSearch::class )->getMock();
		$searchEngine->expects( $this->never() )->method( 'makeSearchFieldMapping' );

		$mapping = $labels->getMapping( $searchEngine );
		$this->assertArrayHasKey( 'properties', $mapping );
		$this->assertCount( 4, $mapping['properties'] );
		$this->assertEquals( 'object', $mapping['type'] );
	}

	public function testGetMappingOtherSearchEngine() {
		$labels = new LabelsField( [ 'en', 'es', 'ru', 'de' ] );

		$searchEngine = $this->getMockBuilder( SearchEngine::class )->getMock();
		$searchEngine->expects( $this->never() )->method( 'makeSearchFieldMapping' );

		$this->assertSame( [], $labels->getMapping( $searchEngine ) );
	}

	public function testHints() {
		$labels = new LabelsField( [ 'en', 'es', 'ru', 'de' ] );
		if ( !class_exists( CirrusSearch::class ) ) {
			$searchEngine = $this->getMockBuilder( SearchEngine::class )->getMock();
			$this->assertEquals( [], $labels->getEngineHints( $searchEngine ) );
		} else {
			$searchEngine = $this->getMockBuilder( CirrusSearch::class )->getMock();
			$this->assertEquals( [ 'noop' => 'equals' ],
				$labels->getEngineHints( $searchEngine ) );
		}
	}

}
