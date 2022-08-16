<?php
App::uses('ProgrammingGroup', 'Model');

/**
 * ProgrammingGroup Test Case
 *
 */
class ProgrammingGroupTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.programming_group'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ProgrammingGroup = ClassRegistry::init('ProgrammingGroup');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProgrammingGroup);

		parent::tearDown();
	}

}
