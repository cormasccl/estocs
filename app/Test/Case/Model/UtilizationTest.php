<?php
App::uses('Utilization', 'Model');

/**
 * Utilization Test Case
 *
 */
class UtilizationTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.utilization',
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
		'app.products_utilization'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Utilization = ClassRegistry::init('Utilization');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Utilization);

		parent::tearDown();
	}

}
