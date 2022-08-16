<?php
App::uses('PlantType', 'Model');

/**
 * PlantType Test Case
 *
 */
class PlantTypeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.plant_type'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PlantType = ClassRegistry::init('PlantType');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PlantType);

		parent::tearDown();
	}

}
