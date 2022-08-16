<?php
App::uses('GroupsController', 'Controller');

/**
 * GroupsController Test Case
 *
 */
class GroupsControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.group',
		'app.user',
		'app.list',
		'app.agent',
		'app.cash_order'
	);

}
