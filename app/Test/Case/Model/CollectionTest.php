<?php
App::uses('Collection', 'Model');

/**
 * Collection Test Case
 *
 */
class CollectionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.collection',
		'app.article_catalogue',
		'app.catalogue_article',
		'app.catalogue',
		'app.catalogue_classification',
		'app.user',
		'app.group',
		'app.agent',
		'app.department',
		'app.cash_order',
		'app.status',
		'app.cash_order_detail',
		'app.services_unit',
		'app.article',
		'app.product',
		'app.exposition',
		'app.plant_type',
		'app.irrigation',
		'app.programming_group',
		'app.temperature',
		'app.products_collection',
		'app.flower_colour',
		'app.products_flower_colour',
		'app.sheet_colour',
		'app.products_sheet_colour',
		'app.utilization',
		'app.products_utilization',
		'app.article_photo',
		'app.growing',
		'app.lists_article',
		'app.flowering'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Collection = ClassRegistry::init('Collection');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Collection);

		parent::tearDown();
	}

}
