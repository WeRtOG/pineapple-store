<?php

	class Controller_404 extends Controller
	{
		
		function action_index()
		{
			$this->View->Generate('404_view.php', '404', 'template_view.php');
		}

	}

?>