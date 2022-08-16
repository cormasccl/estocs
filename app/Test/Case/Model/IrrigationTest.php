<?php
App::uses('Irrigation', 'Model');

/**
 * Irrigation Test Case
 *
 */
class IrrigationTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.irrigation',
		'app.product',
		'app.exposition',
		'app.plant_type',
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
		$this->Irrigation = ClassRegistry::init('Irrigation');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Irrigation);

		parent::tearDown();
	}

}
