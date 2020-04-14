<?php

class Controller {
	
	public $Model;
	public $View;
	
	function __construct()
	{
		$this->View = new View();
	}
	
	// действие (action), вызываемое по умолчанию
	function action_index()
	{
		// todo	
	}
}
