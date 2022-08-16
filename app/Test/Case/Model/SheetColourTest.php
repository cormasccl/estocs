<?php
App::uses('SheetColour', 'Model');

/**
 * SheetColour Test Case
 *
 */
class SheetColourTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.sheet_colour',
		'app.product',
		'app.exposition',
		'app.plant_type',
		'app.irrigation',
		'app.programming_groups',
		'app.article',
		'app.flower_colour',
		'app.products_flower_colour',
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
		$this->SheetColour = ClassRegistry::init('SheetColour');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SheetColour);

		parent::tearDown();
	}

}
