<?php
	/**
	 * Контроллер страницы товаров
	 */
	class Controller_Catalog extends Controller
	{
		/**
		 * Конструктор контроллера страницы товаров
		 */
		public function __construct()
		{
			$this->Model = new Model_Catalog();
			$this->View = new View();
		}
		/**
         * Экшн коренной страницы
         */
		public function action_index()
		{
			$data = $this->Model->GetData();
			$this->View->Generate('catalog_view.php', 'Товары', 'template_view.php', $data);
		}
	}

?>