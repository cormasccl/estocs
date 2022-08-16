<?php
App::uses('ProductsCollection', 'Model');

/**
 * ProductsCollection Test Case
 *
 */
class ProductsCollectionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.products_collection',
		'app.collection',
		'app.product',
		'app.exposition',
		'app.plant_type',
		'app.irrigation',
		'app.programming_groups',
		'app.temperature',
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
		$this->ProductsCollection = ClassRegistry::init('ProductsCollection');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProductsCollection);

		parent::tearDown();
	}

}
