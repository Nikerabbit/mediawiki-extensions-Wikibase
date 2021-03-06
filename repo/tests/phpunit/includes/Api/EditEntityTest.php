<?php

namespace Wikibase\Repo\Tests\Api;

use User;
use ApiUsageException;
use Wikibase\DataModel\Entity\Item;
use Wikibase\DataModel\Entity\Property;
use Wikibase\Repo\WikibaseRepo;

/**
 * @covers Wikibase\Repo\Api\EditEntity
 * @covers Wikibase\Repo\Api\ModifyEntity
 *
 * @license GPL-2.0+
 * @author Addshore
 * @author Michal Lazowik
 *
 * @group API
 * @group Wikibase
 * @group WikibaseAPI
 * @group BreakingTheSlownessBarrier
 * @group Database
 * @group medium
 */
class EditEntityTest extends WikibaseApiTestCase {

	/**
	 * @var string[]
	 */
	private static $idMap;

	/**
	 * @var bool
	 */
	private static $hasSetup;

	protected function setUp() {
		parent::setUp();

		if ( !isset( self::$hasSetup ) ) {
			$wikibaseRepo = WikibaseRepo::getDefaultInstance();
			$store = $wikibaseRepo->getEntityStore();

			$prop = Property::newFromType( 'string' );
			$store->saveEntity( $prop, 'EditEntityTestP56', $GLOBALS['wgUser'], EDIT_NEW );
			self::$idMap['%P56%'] = $prop->getId()->getSerialization();
			self::$idMap['%StringProp%'] = $prop->getId()->getSerialization();

			$prop = Property::newFromType( 'string' );
			$store->saveEntity( $prop, 'EditEntityTestP72', $GLOBALS['wgUser'], EDIT_NEW );
			self::$idMap['%P72%'] = $prop->getId()->getSerialization();

			$this->initTestEntities( [ 'Berlin' ], self::$idMap );
			self::$idMap['%Berlin%'] = EntityTestHelper::getId( 'Berlin' );

			$p56 = self::$idMap['%P56%'];
			$berlinData = EntityTestHelper::getEntityOutput( 'Berlin' );
			self::$idMap['%BerlinP56%'] = $berlinData['claims'][$p56][0]['id'];

			$badge = new Item();
			$store->saveEntity( $badge, 'EditEntityTestQ42', $GLOBALS['wgUser'], EDIT_NEW );
			self::$idMap['%Q42%'] = $badge->getId()->getSerialization();

			$badge = new Item();
			$store->saveEntity( $badge, 'EditEntityTestQ149', $GLOBALS['wgUser'], EDIT_NEW );
			self::$idMap['%Q149%'] = $badge->getId()->getSerialization();

			$badge = new Item();
			$store->saveEntity( $badge, 'EditEntityTestQ32', $GLOBALS['wgUser'], EDIT_NEW );
			self::$idMap['%Q32%'] = $badge->getId()->getSerialization();

			$wikibaseRepo->getSettings()->setSetting( 'badgeItems', [
				self::$idMap['%Q42%'] => '',
				self::$idMap['%Q149%'] => '',
				'Q99999' => '', // Just in case we have a wrong config
			] );

			// Create a file page for which we can later create a MediaInfo entity.
			// XXX It's ugly to have knowledge about MediaInfo here. But since we currently can't
			// inject mock handlers for a mock media type, this is the only way to test automatic
			// creation.

			$titleInfo = $this->insertPage( 'File:EditEntityTest.jpg' );
			self::$idMap['%M11%'] = 'M' . $titleInfo['id'];
		}
		self::$hasSetup = true;
	}

	/**
	 * Provide data for a sequence of requests that will work when run in order
	 */
	public function provideData() {
		return [
			'new item' => [
				'p' => [ 'new' => 'item', 'data' => '{}' ],
				'e' => [ 'type' => 'item' ] ],
			'new property' => [ // make sure if we pass in a valid type it is accepted
				'p' => [ 'new' => 'property', 'data' => '{"datatype":"string"}' ],
				'e' => [ 'type' => 'property' ] ],
			'new property with data' => [ // this is our current example in the api doc
				'p' => [
					'new' => 'property',
					'data' => '{"labels":{"en-gb":{"language":"en-gb","value":"Propertylabel"}},'
						. '"descriptions":{"en-gb":{"language":"en-gb","value":"Propertydescription"}},'
						. '"datatype":"string"}'
				],
				'e' => [ 'type' => 'property' ] ],
			'new mediainfo from id' => [
				'p' => [ 'id' => '%M11%', 'data' => '{}' ],
				'e' => [ 'type' => 'mediainfo' ],
				'requires' => 'mediainfo', // skip if MediaInfo is not configured
			],
			'add a sitelink..' => [ // make sure if we pass in a valid id it is accepted
				'p' => [
					'data' => '{"sitelinks":{"dewiki":{"site":"dewiki",'
						. '"title":"TestPage!","badges":["%Q42%","%Q149%"]}}}'
				],
				'e' => [
					'sitelinks' => [
						[
							'site' => 'dewiki',
							'title' => 'TestPage!',
							'badges' => [ '%Q42%', '%Q149%' ]
						]
					]
				]
			],
			'add a label, (making sure some data fields are ignored)' => [
				'p' => [
					'data' => [
						'labels' => [ 'en' => [ 'language' => 'en', 'value' => 'A Label' ] ],
						'length' => 'ignoreme!',
						'count' => 'ignoreme!',
						'touched' => 'ignoreme!',
						'modified' => 'ignoreme!',
					],
				],
				'e' => [
					'sitelinks' => [
						[
							'site' => 'dewiki',
							'title' => 'TestPage!',
							'badges' => [ '%Q42%', '%Q149%' ]
						]
					],
					'labels' => [ 'en' => 'A Label' ]
				]
			],
			'add a description..' => [
				'p' => [ 'data' => '{"descriptions":{"en":{"language":"en","value":"DESC"}}}' ],
				'e' => [
					'sitelinks' => [
						[
							'site' => 'dewiki',
							'title' => 'TestPage!',
							'badges' => [ '%Q42%', '%Q149%' ]
						]
					],
					'labels' => [ 'en' => 'A Label' ],
					'descriptions' => [ 'en' => 'DESC' ]
				]
			],
			'remove a sitelink..' => [
				'p' => [ 'data' => '{"sitelinks":{"dewiki":{"site":"dewiki","title":""}}}' ],
				'e' => [
					'labels' => [ 'en' => 'A Label' ],
					'descriptions' => [ 'en' => 'DESC' ] ]
				],
			'remove a label..' => [
				'p' => [ 'data' => '{"labels":{"en":{"language":"en","value":""}}}' ],
				'e' => [ 'descriptions' => [ 'en' => 'DESC' ] ] ],
			'remove a description..' => [
				'p' => [ 'data' => '{"descriptions":{"en":{"language":"en","value":""}}}' ],
				'e' => [ 'type' => 'item' ] ],
			'clear an item with some new value' => [
				'p' => [
					'data' => '{"sitelinks":{"dewiki":{"site":"dewiki","title":"page"}}}',
					'clear' => ''
				],
				'e' => [
					'type' => 'item',
					'sitelinks' => [
						[
							'site' => 'dewiki',
							'title' => 'Page',
							'badges' => []
						]
					]
				]
			],
			'clear an item with no value' => [
				'p' => [ 'data' => '{}', 'clear' => '' ],
				'e' => [ 'type' => 'item' ] ],
			'add 2 labels' => [
				'p' => [ 'data' => '{"labels":{"en":{"language":"en","value":"A Label"},'
					. '"sv":{"language":"sv","value":"SVLabel"}}}' ],
				'e' => [ 'labels' => [ 'en' => 'A Label', 'sv' => 'SVLabel' ] ] ],
			'remove a label with remove' => [
				'p' => [ 'data' => '{"labels":{"en":{"language":"en","remove":true}}}' ],
				'e' => [ 'labels' => [ 'sv' => 'SVLabel' ] ] ],
			'override and add 2 descriptions' => [
				'p' => [ 'clear' => '', 'data' => '{"descriptions":{'
					. '"en":{"language":"en","value":"DESC1"},'
					. '"de":{"language":"de","value":"DESC2"}}}' ],
				'e' => [ 'descriptions' => [ 'en' => 'DESC1', 'de' => 'DESC2' ] ] ],
			'remove a description with remove' => [
				'p' => [ 'data' => '{"descriptions":{"en":{"language":"en","remove":true}}}' ],
				'e' => [ 'descriptions' => [ 'de' => 'DESC2' ] ] ],
			'override and add 2 sitelinks..' => [
				'p' => [ 'data' => '{"sitelinks":{'
					. '"dewiki":{"site":"dewiki","title":"BAA"},'
					. '"svwiki":{"site":"svwiki","title":"FOO"}}}' ],
				'e' => [
					'type' => 'item',
					'sitelinks' => [
						[
							'site' => 'dewiki',
							'title' => 'BAA',
							'badges' => []
						],
						[
							'site' => 'svwiki',
							'title' => 'FOO',
							'badges' => []
						]
					]
				]
			],
			'unset a sitelink using the other sitelink' => [
				'p' => [
					'site' => 'svwiki',
					'title' => 'FOO',
					'data' => '{"sitelinks":{"dewiki":{"site":"dewiki","title":""}}}'
				],
				'e' => [
					'type' => 'item',
					'sitelinks' => [
						[
							'site' => 'svwiki',
							'title' => 'FOO',
							'badges' => []
						]
					]
				]
			],
			'set badges for a existing sitelink, title intact' => [
				'p' => [
					'data' => '{"sitelinks":{"svwiki":{"site":"svwiki","badges":["%Q149%","%Q42%"]}}}'
				],
				'e' => [
					'type' => 'item',
					'sitelinks' => [
						[
							'site' => 'svwiki',
							'title' => 'FOO',
							'badges' => [ "%Q149%", "%Q42%" ]
						]
					]
				]
			],
			'set title for a existing sitelink, badges intact' => [
				'p' => [ 'data' => '{"sitelinks":{"svwiki":{"site":"svwiki","title":"FOO2"}}}' ],
				'e' => [
					'type' => 'item',
					'sitelinks' => [
						[
							'site' => 'svwiki',
							'title' => 'FOO2',
							'badges' => [ "%Q149%", "%Q42%" ]
						]
					]
				]
			],
			'delete sitelink by providing neither title nor badges' => [
				'p' => [ 'data' => '{"sitelinks":{"svwiki":{"site":"svwiki"}}}' ],
				'e' => [
					'type' => 'item',
				]
			],
			'add a claim' => [
				'p' => [ 'data' => '{"claims":[{"mainsnak":{"snaktype":"value",'
					. '"property":"%P56%","datavalue":{"value":"imastring","type":"string"}},'
					. '"type":"statement","rank":"normal"}]}' ],
				'e' => [ 'claims' => [
					'%P56%' => [
						'mainsnak' => [
							'snaktype' => 'value',
							'property' => '%P56%',
							'datavalue' => [ 'value' => 'imastring', 'type' => 'string' ]
						],
						'type' => 'statement',
						'rank' => 'normal'
					]
				] ]
			],
			'change the claim' => [
				'p' => [ 'data' => [
					'claims' => [
							[
								'id' => '%lastClaimId%',
								'mainsnak' => [
									'snaktype' => 'value',
									'property' => '%P56%',
									'datavalue' => [
										'value' => 'diffstring',
										'type' => 'string'
									],
								],
								'type' => 'statement',
								'rank' => 'normal',
							],
						],
					] ],
				'e' => [ 'claims' => [
					'%P56%' => [
						'mainsnak' => [ 'snaktype' => 'value', 'property' => '%P56%',
							'datavalue' => [
								'value' => 'diffstring',
								'type' => 'string' ] ],
						'type' => 'statement',
						'rank' => 'normal'
					]
				] ]
			],
			'remove the claim' => [
				'p' => [ 'data' => '{"claims":[{"id":"%lastClaimId%","remove":""}]}' ],
				'e' => [ 'claims' => [] ]
			],
			'add multiple claims' => [
				'p' => [ 'data' => '{"claims":['
					. '{"mainsnak":{"snaktype":"value","property":"%P56%","datavalue":'
					. '{"value":"imastring1","type":"string"}},"type":"statement","rank":"normal"},'
					. '{"mainsnak":{"snaktype":"value","property":"%P56%","datavalue":'
					. '{"value":"imastring2","type":"string"}},"type":"statement","rank":"normal"}'
					. ']}' ],
				'e' => [ 'claims' => [
					[
						'mainsnak' => [
							'snaktype' => 'value', 'property' => '%P56%',
							'datavalue' => [
								'value' => 'imastring1',
								'type' => 'string' ] ],
						'type' => 'statement',
						'rank' => 'normal' ],
					[
						'mainsnak' => [
							'snaktype' => 'value', 'property' => '%P56%',
							'datavalue' => [
								'value' => 'imastring2',
								'type' => 'string' ] ],
						'type' => 'statement',
						'rank' => 'normal' ]
				] ],
			],
			'remove all stuff' => [
				'p' => [ 'clear' => '', 'data' => '{}' ],
				'e' => [
					'labels' => [],
					'descriptions' => [],
					'aliases' => [],
					'sitelinks' => [],
					'claims' => []
				]
			],
			'add lots of data again' => [
				'p' => [ 'data' => '{"claims":['
					. '{"mainsnak":{"snaktype":"value","property":"%P56%","datavalue":'
					. '{"value":"imastring1","type":"string"}},"type":"statement","rank":"normal"},'
					. '{"mainsnak":{"snaktype":"value","property":"%P56%","datavalue":'
					. '{"value":"imastring2","type":"string"}},"type":"statement","rank":"normal"}'
					. '],'
					. '"sitelinks":{"dewiki":{"site":"dewiki","title":"page"}},'
					. '"labels":{"en":{"language":"en","value":"A Label"}},'
					. '"descriptions":{"en":{"language":"en","value":"A description"}}}' ],
				'e' => [ 'type' => 'item' ]
			],
			'make a null edit' => [
				'p' => [ 'data' => '{}' ],
				'e' => [ 'nochange' => '' ]
			],
			'remove all stuff in another way' => [
				'p' => [ 'clear' => true, 'data' => '{}' ],
				'e' => [
					'labels' => [],
					'descriptions' => [],
					'aliases' => [],
					'sitelinks' => [],
					'claims' => []
				]
			],
		];
	}

	/**
	 * Applies self::$idMap to all data in the given data structure, recursively.
	 *
	 * @param mixed &$data
	 */
	protected function injectIds( &$data ) {
		EntityTestHelper::injectIds( $data, self::$idMap );
	}

	/**
	 * Skips a test of the given entity type is not enabled.
	 *
	 * @param string|null $requiredEntityType
	 */
	private function skipIfEntityTypeNotKnown( $requiredEntityType ) {
		if ( $requiredEntityType === null ) {
			return;
		}

		$enabledTypes = WikibaseRepo::getDefaultInstance()->getLocalEntityTypes();
		if ( !in_array( $requiredEntityType, $enabledTypes ) ) {
			$this->markTestSkipped( 'Entity type not enabled: ' . $requiredEntityType );
		}
	}

	public function testUserCanEditWhenTheyHaveSufficientPermission() {
		$userWithAllPermissions = $this->createUserWithGroup( 'all-permission' );

		$this->setMwGlobals( 'wgGroupPermissions', [
			'all-permission' => [ 'read' => true, 'edit' => true, 'createpage' => true ],
			'*' => [ 'read' => true, 'edit' => false, 'writeapi' => true ]
		] );

		$newItem = $this->createItemUsing( $userWithAllPermissions );
		$this->assertArrayHasKey( 'id', $newItem );
	}

	public function testUserCannotEditWhenTheyLackPermission() {
		$userWithInsufficientPermissions = $this->createUserWithGroup( 'no-permission' );
		$userWithAllPermissions = $this->createUserWithGroup( 'all-permission' );

		$this->setMwGlobals( 'wgGroupPermissions', [
			'no-permission' => [ 'read' => true, 'edit' => false ],
			'all-permission' => [ 'read' => true, 'edit' => true, 'createpage' => true ],
			'*' => [ 'read' => true, 'edit' => false, 'writeapi' => true ]
		] );

		// And an existing item
		$newItem = $this->createItemUsing( $userWithAllPermissions );

		// Then the request is denied
		$expected = [
			'type' => ApiUsageException::class,
			'code' => 'permissiondenied'
		];

		$this->doTestQueryExceptions(
			$this->addSiteLink( $newItem['id'] ),
			$expected,
			$userWithInsufficientPermissions
		);
	}

	public function testEditingLabelRequiresEntityTermEditPermissions() {
		$this->markTestSkipped( 'Api\EditEntity currently does not check term edit permissions when editing terms!' );

		$userWithInsufficientPermissions = $this->createUserWithGroup( 'no-permission' );
		$userWithAllPermissions = $this->createUserWithGroup( 'all-permission' );

		$this->setMwGlobals( 'wgGroupPermissions', [
			'no-permission' => [ 'read' => true, 'edit' => true, 'item-term' => false, ],
			'all-permission' => [ 'read' => true, 'edit' => true, 'createpage' => true ],
			'*' => [ 'read' => true, 'edit' => false, 'writeapi' => true ]
		] );

		// And an existing item
		$newItem = $this->createItemUsing( $userWithAllPermissions );

		// Then the request is denied
		$expected = [
			'type' => ApiUsageException::class,
			'code' => 'permissiondenied'
		];

		$this->doTestQueryExceptions(
			$this->removeLabel( $newItem['id'] ),
			$expected,
			$userWithInsufficientPermissions );
	}

	private function createItemUsing( User $user ) {
		$createItemParams = [ 'action' => 'wbeditentity',
							  'new' => 'item',
							  'data' =>
							  '{"labels":{"en":{"language":"en","value":"something"}}}' ];
		list ( $result, ) = $this->doApiRequestWithToken( $createItemParams, null, $user );
		return $result['entity'];
	}

	private function createUserWithGroup( $groupName ) {
		$user = $this->createTestUser()->getUser();
		$user->addGroup( $groupName );
		return $user;

	}

	private function addSiteLink( $id ) {
		return [
			'action' => 'wbeditentity',
			'id' => $id,
			'data' => '{"sitelinks":{"site":"enwiki","title":"Hello World"}}'
		];
	}

	private function removeLabel( $id ) {
		return [
			'action' => 'wbeditentity',
			'id' => $id,
			'data' => '{"labels":{"en":{"language":"en","value":""}}}'
		];
	}

	/**
	 * @dataProvider provideData
	 */
	public function testEditEntity( $params, $expected, $needed = null ) {
		$this->skipIfEntityTypeNotKnown( $needed );

		$this->injectIds( $params );
		$this->injectIds( $expected );

		$p56 = '%P56%';
		$this->injectIds( $p56 );

		if ( isset( $params['data'] ) && is_array( $params['data'] ) ) {
			$params['data'] = json_encode( $params['data'] );
		}

		// -- set any defaults ------------------------------------
		$params['action'] = 'wbeditentity';
		if ( !array_key_exists( 'id', $params )
			&& !array_key_exists( 'new', $params )
			&& !array_key_exists( 'site', $params )
			&& !array_key_exists( 'title', $params )
		) {
			$params['id'] = self::$idMap['!lastEntityId!'];
		}

		// -- do the request --------------------------------------------------
		list( $result, , ) = $this->doApiRequestWithToken( $params );

		// -- steal ids for later tests -------------------------------------
		if ( array_key_exists( 'new', $params ) && stristr( $params['new'], 'item' ) ) {
			self::$idMap['!lastEntityId!'] = $result['entity']['id'];
		}
		if ( array_key_exists( 'claims', $result['entity'] )
			&& array_key_exists( $p56, $result['entity']['claims'] )
		) {
			foreach ( $result['entity']['claims'][$p56] as $claim ) {
				if ( array_key_exists( 'id', $claim ) ) {
					self::$idMap['%lastClaimId%'] = $claim['id'];
				}
			}
		}

		// -- check the result ------------------------------------------------
		$this->assertArrayHasKey( 'success', $result, "Missing 'success' marker in response." );
		$this->assertResultHasEntityType( $result );
		$this->assertArrayHasKey( 'entity', $result, "Missing 'entity' section in response." );

		$this->assertArrayHasKey(
			'id',
			$result['entity'],
			"Missing 'id' section in entity in response."
		);

		$this->assertEntityEquals( $expected, $result['entity'] );

		// -- check null edits ---------------------------------------------
		if ( isset( $expected['nochange'] ) ) {
			$this->assertArrayHasKey( 'nochange', $result['entity'] );
		}

		// -- check the item in the database -------------------------------
		$dbEntity = $this->loadEntity( $result['entity']['id'] );
		$this->assertEntityEquals( $expected, $dbEntity, false );

		// -- check the edit summary --------------------------------------------
		if ( !array_key_exists( 'warning', $expected )
			|| $expected['warning'] != 'edit-no-change'
		) {
			$this->assertRevisionSummary(
				[ 'wbeditentity' ],
				$result['entity']['lastrevid']
			);

			if ( array_key_exists( 'summary', $params ) ) {
				$this->assertRevisionSummary(
					'/' . $params['summary'] . '/',
					$result['entity']['lastrevid']
				);
			}
		}
	}

	/**
	 * Provide data for requests that will fail with a set exception, code and message
	 */
	public function provideExceptionData() {
		return [
			'empty entity id given' => [
				'p' => [ 'id' => '', 'data' => '{}' ],
				'e' => [ 'exception' => [
					'type' => ApiUsageException::class,
					'code' => 'invalid-entity-id'
				] ] ],
			'invalid id' => [
				'p' => [ 'id' => 'abcde', 'data' => '{}' ],
				'e' => [ 'exception' => [
					'type' => ApiUsageException::class,
					'code' => 'invalid-entity-id'
				] ] ],
			'unknown id' => [
				'p' => [ 'id' => 'Q1234567', 'data' => '{}' ],
				'e' => [ 'exception' => [
					'type' => ApiUsageException::class,
					'code' => 'no-such-entity'
				] ] ],
			'invalid explicit id' => [
				'p' => [ 'id' => '1234', 'data' => '{}' ],
				'e' => [ 'exception' => [
					'type' => ApiUsageException::class,
					'code' => 'invalid-entity-id'
				] ] ],
			'non existent sitelink' => [
				'p' => [ 'site' => 'dewiki','title' => 'NonExistent', 'data' => '{}' ],
				'e' => [ 'exception' => [
					'type' => ApiUsageException::class,
					'code' => 'no-such-entity-link'
				] ] ],
			'missing site (also bad title)' => [
				'p' => [ 'title' => 'abcde', 'data' => '{}' ],
				'e' => [ 'exception' => [
					'type' => ApiUsageException::class,
					'code' => 'param-missing'
				] ] ],
			'cant have id and new' => [
				'p' => [ 'id' => 'q666', 'new' => 'item', 'data' => '{}' ],
				'e' => [ 'exception' => [
					'type' => ApiUsageException::class,
					'code' => 'param-missing'
				] ] ],
			'when clearing must also have data!' => [
				'p' => [ 'site' => 'enwiki', 'title' => 'Berlin', 'clear' => '' ],
				'e' => [ 'exception' => [
					'type' => ApiUsageException::class,
					'code' => 'nodata'
				] ] ],
			'bad site' => [
				'p' => [ 'site' => 'abcde', 'data' => '{}' ],
				'e' => [ 'exception' => [
					'type' => ApiUsageException::class,
					'code' => 'unknown_site'
				] ] ],
			'no data provided' => [
				'p' => [ 'site' => 'enwiki', 'title' => 'Berlin' ],
				'e' => [ 'exception' => [
					'type' => ApiUsageException::class,
					'code' => 'nodata' // see 'no$1' in ApiBase::$messageMap
				] ]
			],
			'malformed json' => [
				'p' => [ 'site' => 'enwiki', 'title' => 'Berlin', 'data' => '{{{}' ],
				'e' => [ 'exception' => [
					'type' => ApiUsageException::class,
					'code' => 'invalid-json'
				] ] ],
			'must be a json object (json_decode s this an an int)' => [
				'p' => [ 'site' => 'enwiki', 'title' => 'Berlin', 'data' => '1234' ],
				'e' => [ 'exception' => [
					'type' => ApiUsageException::class,
					'code' => 'not-recognized-array'
				] ] ],
			'must be a json object (json_decode s this an an indexed array)' => [
				'p' => [ 'site' => 'enwiki', 'title' => 'Berlin', 'data' => '[ "xyz" ]' ],
				'e' => [ 'exception' => [
					'type' => ApiUsageException::class,
					'code' => 'not-recognized-string'
					] ] ],
			'must be a json object (json_decode s this an a string)' => [
				'p' => [ 'site' => 'enwiki', 'title' => 'Berlin', 'data' => '"string"' ],
				'e' => [ 'exception' => [
					'type' => ApiUsageException::class,
					'code' => 'not-recognized-array'
				] ] ],
			'inconsistent site in json' => [
				'p' => [
					'site' => 'enwiki',
					'title' => 'Berlin',
					'data' => '{"sitelinks":{"ptwiki":{"site":"svwiki","title":"TestPage!"}}}'
				],
				'e' => [ 'exception' => [
					'type' => ApiUsageException::class,
					'code' => 'inconsistent-site'
				] ] ],
			'inconsistent lang in json' => [
				'p' => [
					'site' => 'enwiki',
					'title' => 'Berlin',
					'data' => '{"labels":{"de":{"language":"pt","value":"TestPage!"}}}'
				],
				'e' => [ 'exception' => [
					'type' => ApiUsageException::class,
					'code' => 'inconsistent-language'
				] ] ],
			'inconsistent unknown site in json' => [
				'p' => [
					'site' => 'enwiki',
					'title' => 'Berlin',
					'data' => '{"sitelinks":{"BLUB":{"site":"BLUB","title":"TestPage!"}}}'
				],
				'e' => [ 'exception' => [
					'type' => ApiUsageException::class,
					'code' => 'not-recognized-site'
				] ] ],
			'inconsistent unknown languages' => [
				'p' => [
					'site' => 'enwiki',
					'title' => 'Berlin',
					'data' => '{"labels":{"BLUB":{"language":"BLUB","value":"ImaLabel"}}}'
				],
				'e' => [ 'exception' => [
					'type' => ApiUsageException::class,
					'code' => 'not-recognized-language'
				] ] ],
			// @todo the error codes in the overly long string tests make no sense
			// and should be corrected...
			'overly long label' => [
				'p' => [
					'site' => 'enwiki',
					'title' => 'Berlin',
					'data' => '{"labels":{"en":{"language":"en","value":"'
						. TermTestHelper::makeOverlyLongString() . '"}}}'
				],
				'e' => [ 'exception' => [ 'type' => ApiUsageException::class ] ] ],
			'overly long description' => [
				'p' => [
					'site' => 'enwiki',
					'title' => 'Berlin',
					'data' => '{"descriptions":{"en":{"language":"en","value":"'
						. TermTestHelper::makeOverlyLongString() . '"}}}'
				],
				'e' => [ 'exception' => [ 'type' => ApiUsageException::class ] ] ],
			'missing language in labels (T54731)' => [
				'p' => [
					'site' => 'enwiki',
					'title' => 'Berlin',
					'data' => '{"labels":{"de":{"site":"pt","title":"TestString"}}}'
				],
				'e' => [ 'exception' => [
					'type' => ApiUsageException::class,
					'code' => 'missing-language',
					'message' => '\'language\' was not found in term serialization for de'
				] ]
			],
			'removing invalid claim fails' => [
				'p' => [
					'site' => 'enwiki',
					'title' => 'Berlin',
					'data' => '{"claims":[{"remove":""}]}'
				],
				'e' => [ 'exception' => [
					'type' => ApiUsageException::class,
					'code' => 'invalid-claim',
					'message' => 'Cannot remove a claim with no GUID'
				] ]
			],
			'invalid entity ID in data value' => [
				'p' => [
					'id' => '%Berlin%',
					'data' => '{ "claims": [ {
						"mainsnak": { "snaktype": "novalue", "property": "P0" },
						"type": "statement"
					} ] }'
				],
				'e' => [ 'exception' => [
					'type' => ApiUsageException::class,
					'code' => 'invalid-claim',
					'message' => '\'P0\' is not a valid entity ID'
				] ]
			],
			'invalid statement GUID' => [
				'p' => [
					'id' => '%Berlin%',
					'data' => '{ "claims": [ {
						"id": "Q0$GUID",
						"mainsnak": { "snaktype": "novalue", "property": "%P56%" },
						"type": "statement"
					} ] }'
				],
				'e' => [ 'exception' => [
					'type' => ApiUsageException::class,
					'code' => 'modification-failed',
					'message' => 'Statement GUID can not be parsed',
				] ]
			],
			'removing valid claim with no guid fails' => [
				'p' => [
					'site' => 'enwiki',
					'title' => 'Berlin',
					'data' => '{
						"claims": [ {
							"remove": "",
							"mainsnak": {
								"snaktype": "value",
								"property": "%P56%",
								"datavalue": { "value": "imastring", "type": "string" }
							},
							"type": "statement",
							"rank": "normal"
						} ]
					}'
				],
				'e' => [ 'exception' => [
					'type' => ApiUsageException::class,
					'code' => 'invalid-claim',
				] ]
			],
			'bad badge id' => [
				'p' => [
					'site' => 'enwiki',
					'title' => 'Berlin',
					'data' => '{"sitelinks":{"dewiki":{"site":"dewiki","title":"TestPage!",'
						. '"badges":["abc","%Q149%"]}}}'
				],
				'e' => [ 'exception' => [
					'type' => ApiUsageException::class,
					'code' => 'invalid-entity-id'
				] ]
			],
			'badge id is not an item id' => [
				'p' => [
					'site' => 'enwiki',
					'title' => 'Berlin',
					'data' => '{"sitelinks":{"dewiki":{"site":"dewiki","title":"TestPage!",'
						. '"badges":["P2","%Q149%"]}}}'
				],
				'e' => [ 'exception' => [
					'type' => ApiUsageException::class,
					'code' => 'invalid-entity-id'
				] ]
			],
			'badge id is not specified' => [
				'p' => [
					'site' => 'enwiki',
					'title' => 'Berlin',
					'data' => '{"sitelinks":{"dewiki":{"site":"dewiki","title":"TestPage!",'
						. '"badges":["%Q149%","%Q32%"]}}}'
				],
				'e' => [ 'exception' => [
					'type' => ApiUsageException::class,
					'code' => 'not-badge'
				] ]
			],
			'badge item does not exist' => [
				'p' => [
					'site' => 'enwiki',
					'title' => 'Berlin',
					'data' => '{"sitelinks":{"dewiki":{"site":"dewiki","title":"TestPage!",'
						. '"badges":["Q99999","%Q149%"]}}}'
				],
				'e' => [ 'exception' => [
					'type' => ApiUsageException::class,
					'code' => 'no-such-entity'
				] ]
			],
			'no sitelink - cannot change badges' => [
				'p' => [
					'site' => 'enwiki',
					'title' => 'Berlin',
					'data' => '{"sitelinks":{"svwiki":{"site":"svwiki",'
						. '"badges":["%Q42%","%Q149%"]}}}'
				],
				'e' => [ 'exception' => [
					'type' => ApiUsageException::class,
					'code' => 'modification-failed',
					'message' => wfMessage( 'wikibase-validator-no-such-sitelink', 'svwiki' )->inLanguage( 'en' )->text(),
				] ]
			],
			'bad id in serialization' => [
				'p' => [ 'id' => '%Berlin%', 'data' => '{"id":"Q13244"}' ],
				'e' => [ 'exception' => [
					'type' => ApiUsageException::class,
					'code' => 'param-invalid',
					'message' => 'Invalid field used in call: "id", must match id parameter'
				] ]
			],
			'bad type in serialization' => [
				'p' => [ 'id' => '%Berlin%', 'data' => '{"id":"%Berlin%","type":"foobar"}' ],
				'e' => [ 'exception' => [
					'type' => ApiUsageException::class,
					'code' => 'param-invalid',
					'message' => 'Invalid field used in call: "type", '
						. 'must match type associated with id'
				] ]
			],
			'bad main snak replacement' => [
				'p' => [ 'id' => '%Berlin%', 'data' => json_encode( [
						'claims' => [
							[
								'id' => '%BerlinP56%',
								'mainsnak' => [
									'snaktype' => 'value',
									'property' => '%P72%',
									'datavalue' => [
										'value' => 'anotherstring',
										'type' => 'string'
									],
								],
								'type' => 'statement',
								'rank' => 'normal' ],
						],
					] ) ],
				'e' => [ 'exception' => [
					'type' => ApiUsageException::class,
					'code' => 'modification-failed',
					'message' => 'uses property %P56%, can\'t change to %P72%' ] ] ],
			'invalid main snak' => [
				'p' => [ 'id' => '%Berlin%', 'data' => json_encode( [
					'claims' => [
						[
							'id' => '%BerlinP56%',
							'mainsnak' => [
								'snaktype' => 'value',
								'property' => '%P56%',
								'datavalue' => [ 'value' => '   ', 'type' => 'string' ],
							],
							'type' => 'statement',
							'rank' => 'normal' ],
					],
				] ) ],
				'e' => [ 'exception' => [
					'type' => ApiUsageException::class,
					'code' => 'modification-failed' ] ] ],
			'properties cannot have sitelinks' => [
				'p' => [
					'id' => '%P56%',
					'data' => '{"sitelinks":{"dewiki":{"site":"dewiki","title":"TestPage!"}}}',
				],
				'e' => [ 'exception' => [
					'type' => ApiUsageException::class,
					'code' => 'not-supported',
					'message' => 'The requested feature is not supported by the given entity'
				] ] ],
			'property with invalid datatype' => [
				'p' => [
					'new' => 'property',
					'data' => '{"datatype":"invalid"}',
				],
				'e' => [ 'exception' => [
					'type' => ApiUsageException::class,
					'code' => 'param-illegal'
				] ] ],
			'create mediainfo with automatic id' => [
				'p' => [ 'new' => 'mediainfo', 'data' => '{}' ],
				'e' => [ 'exception' => [
					'type' => ApiUsageException::class,
					'message' => 'Cannot automatically assign ID: mediainfo entities do not support automatic IDs',
					'code' => 'no-automatic-entity-id',
				] ],
				'requires' => 'mediainfo' // skip if MediaInfo is not configured
			],
			'create mediainfo with malformed id' => [
				'p' => [ 'id' => 'M123X', 'data' => '{}' ],
				'e' => [ 'exception' => [
					'type' => ApiUsageException::class,
					'code' => 'invalid-entity-id',
					'message' => 'Invalid entity ID.'
				] ],
				'requires' => 'mediainfo' // skip if MediaInfo is not configured
			],
			'create mediainfo with bad id' => [
				'p' => [ 'id' => 'M12734569', 'data' => '{}' ],
				'e' => [ 'exception' => [
					'type' => ApiUsageException::class,
					'code' => 'no-such-entity',
					'message-key' => 'no-such-entity'
				] ],
				'requires' => 'mediainfo' // skip if MediaInfo is not configured
			],
			'remove key misplaced in data' => [
				'p' => [
					'id' => '%Berlin%',
					'data' => json_encode( [
						'remove' => '',
						'claims' => [ [
							'type' => 'statement',
							'mainsnak' => [
								'snaktype' => 'novalue',
								'property' => '%P56%',
							],
							'id' => '%BerlinP56%',
						] ],
					] )
				],
				'e' => [ 'exception' => [
					'type' => ApiUsageException::class,
					'code' => 'not-recognized',
					'message-key' => 'wikibase-api-illegal-entity-remove',
				] ],
			],
		];
	}

	/**
	 * @dataProvider provideExceptionData
	 */
	public function testEditEntityExceptions( $params, $expected, $needed = null ) {
		$this->skipIfEntityTypeNotKnown( $needed );

		$this->injectIds( $params );
		$this->injectIds( $expected );

		// -- set any defaults ------------------------------------
		$params['action'] = 'wbeditentity';
		$this->doTestQueryExceptions( $params, $expected['exception'] );
	}

	public function testPropertyLabelConflict() {
		$params = [
			'action' => 'wbeditentity',
			'data' => '{
				"datatype": "string",
				"labels": { "de": { "language": "de", "value": "LabelConflict" } }
			}',
			'new' => 'property',
		];
		$this->doApiRequestWithToken( $params );

		$expectedException = [
			'type' => ApiUsageException::class,
			'code' => 'failed-save',
		];
		// Repeating the same request with the same label should fail.
		$this->doTestQueryExceptions( $params, $expectedException );
	}

	public function testItemLabelWithoutDescriptionNotConflicting() {
		$params = [
			'action' => 'wbeditentity',
			'data' => '{ "labels": { "de": { "language": "de", "value": "NotConflicting" } } }',
			'new' => 'item',
		];
		$this->doApiRequestWithToken( $params );

		// Repeating the same request with the same label should not fail.
		list( $result, , ) = $this->doApiRequestWithToken( $params );
		$this->assertArrayHasKey( 'success', $result );
	}

	public function testItemLabelDescriptionConflict() {
		$this->markTestSkippedOnMySql();

		$params = [
			'action' => 'wbeditentity',
			'new' => 'item',
			'data' => '{
				"labels": { "de": { "language": "de", "value": "LabelDescriptionConflict" } },
				"descriptions": { "de": { "language": "de", "value": "LabelDescriptionConflict" } }
			}',
		];
		$this->doApiRequestWithToken( $params );

		$expectedException = [
			'type' => ApiUsageException::class,
			'code' => 'modification-failed',
		];
		// Repeating the same request with the same label and description should fail.
		$this->doTestQueryExceptions( $params, $expectedException );
	}

	public function testClearFromBadRevId() {
		$params = [
			'action' => 'wbeditentity',
			'id' => '%Berlin%',
			'data' => '{}',
			// 'baserevid' => '', // baserevid is set below
			'clear' => '' ];
		$this->injectIds( $params );

		$setupParams = [
			'action' => 'wbeditentity',
			'id' => $params['id'],
			'clear' => '',
			'data' => '{"descriptions":{"en":{"language":"en","value":"ClearFromBadRevidDesc1"}}}',
		];

		list( $result, , ) = $this->doApiRequestWithToken( $setupParams );
		$params['baserevid'] = $result['entity']['lastrevid'];
		$setupParams['data'] = '{"descriptions":{"en":{"language":"en","value":"ClearFromBadRevidDesc2"}}}';
		$this->doApiRequestWithToken( $setupParams );

		$expectedException = [ 'type' => ApiUsageException::class, 'code' => 'editconflict' ];
		$this->doTestQueryExceptions( $params, $expectedException );
	}

	/**
	 * @see http://bugs.mysql.com/bug.php?id=10327
	 * @see TermSqlIndexTest::markTestSkippedOnMySql
	 */
	private function markTestSkippedOnMySql() {
		if ( $this->db->getType() === 'mysql' ) {
			$this->markTestSkipped( 'MySQL doesn\'t support self-joins on temporary tables' );
		}
	}

}
