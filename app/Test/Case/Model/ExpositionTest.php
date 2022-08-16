<?php
App::uses('Exposition', 'Model');

/**
 * Exposition Test Case
 *
 */
class ExpositionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.exposition',
		'app.product',
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
		$this->Exposition = ClassRegistry::init('Exposition');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Exposition);

		parent::tearDown();
	}

}
