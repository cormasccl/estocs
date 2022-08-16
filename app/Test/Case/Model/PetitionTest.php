<?php
App::uses('Petition', 'Model');

/**
 * Petition Test Case
 *
 */
class PetitionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.petition'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Petition = ClassRegistry::init('Petition');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Petition);

		parent::tearDown();
	}

}
