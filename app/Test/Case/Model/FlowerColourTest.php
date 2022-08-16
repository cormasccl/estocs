<?php
App::uses('FlowerColour', 'Model');

/**
 * FlowerColour Test Case
 *
 */
class FlowerColourTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.flower_colour',
		'app.product',
		'app.exposition',
		'app.plant_type',
		'app.irrigation',
		'app.programming_groups',
		'app.article',
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
		$this->FlowerColour = ClassRegistry::init('FlowerColour');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->FlowerColour);

		parent::tearDown();
	}

}
