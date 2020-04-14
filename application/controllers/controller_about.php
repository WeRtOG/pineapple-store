<?php

	class Controller_About extends Controller
	{
		
		function action_index()
		{
			$this->View->Generate('about_view.php', 'О нас', 'template_view.php');
		}

	}

?>