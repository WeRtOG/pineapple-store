<?php

	class Controller_Catalog extends Controller
	{
		function __construct()
		{
			$this->Model = new Model_Catalog();
			$this->View = new View();
		}
		function action_index()
		{
			$data = $this->Model->GetData();
			$this->View->Generate('catalog_view.php', 'Товары', 'template_view.php', $data);
		}

	}

?>