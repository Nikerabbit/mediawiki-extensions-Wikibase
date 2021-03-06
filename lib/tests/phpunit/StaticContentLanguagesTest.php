<?php

namespace Wikibase\Lib\Tests;

use PHPUnit_Framework_TestCase;
use Wikibase\Lib\StaticContentLanguages;

/**
 * @covers Wikibase\Lib\StaticContentLanguages
 *
 * @group Wikibase
 *
 * @license GPL-2.0+
 * @author Adrian Heine <adrian.heine@wikimedia.de>
 */
class StaticContentLanguagesTest extends PHPUnit_Framework_TestCase {

	/**
	 * @dataProvider provideTestGetLanguages
	 */
	public function testGetLanguages( $expected ) {
		$contentLanguages = new StaticContentLanguages( $expected );
		$result = $contentLanguages->getLanguages();

		$this->assertInternalType( 'array', $result );

		$this->assertSame( $expected, $result );
	}

	public function provideTestGetLanguages() {
		return [
			[ [] ],
			[ [ 'one' ] ],
			[ [ 'one', 'two' ] ],
		];
	}

	/**
	 * @dataProvider provideTestHasLanguage
	 */
	public function testHasLanguage( $in, $lang, $expected ) {
		$contentLanguages = new StaticContentLanguages( $in );
		$result = $contentLanguages->hasLanguage( $lang );

		$this->assertSame( $expected, $result );
	}

	public function provideTestHasLanguage() {
		return [
			[ [], 'one', false ],
			[ [ 'one' ], 'two', false ],
			[ [ 'one' ], 'one', true ],
			[ [ 'one', 'two' ], 'two', true ],
			[ [ 'one', 'two' ], 'three', false ],
		];
	}

}
