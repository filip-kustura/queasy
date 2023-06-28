<?php

require_once __DIR__ . '/../model/session.class.php';

class HomeController {
	public function index() {
		$ss = Session::getInstance();

		require_once __DIR__ . '/../view/home_index.php';
	}
}; 

?>
