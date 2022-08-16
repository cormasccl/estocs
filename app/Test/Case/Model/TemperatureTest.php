<?php
App::uses('Temperature', 'Model');

/**
 * Temperature Test Case
 *
 */
class TemperatureTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.temperature',
		'app.product',
		'app.exposition',
		'app.plant_type',
		'app.irrigation',
		'app.programming_groups',
		'app.article',
		'app.flower_colour',
		'app.products_flower_colour',
		'app.sheet_colour',
		'app.products_sheet_colour',
		'app.utilization',
		'app.products_utilization'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Temperature = ClassRegistry::init('Temperature');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Temperature);

		parent::tearDown();
	}

}
