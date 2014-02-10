<?php

class Base {

	var $DB;

	public function __construct()  {

		global $DB;
		$this->DB = $DB;

	}
}

?>
