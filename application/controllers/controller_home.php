<?php

	class Controller_Home extends Controller
	{
		
		function action_index()
		{
			$this->View->Generate('home_view.php', 'Главная', 'template_view.php');
		}

	}

?>
