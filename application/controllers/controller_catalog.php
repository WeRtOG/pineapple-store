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
		 * @param $page Номер страницы
         */
		public function action_index(int $page = 1)
		{
			$filter = '';
			$filterID = 0;

			if(empty($page) || !is_int($page) || $page < 1) $page = 1;

			if(array_key_exists('filter', $_GET)) $filter = $_GET['filter'];
			if(array_key_exists('id', $_GET)) $filterID = (int)$_GET['id'];
			if(!is_int($filterID)) $filterID = 0;

			$data = $this->Model->GetData($page, $filter, $filterID);
			$this->View->Generate('catalog_view.php', 'Товары', 'template_view.php', $data);
		}
		/**
         * Экшн постраничного вывода товаров (дублирует коренную)
		 * @param $page Номер страницы
         */
		public function action_page(int $page = 1)
		{
			$this->action_index($page);
		}
		/**
		 * Экшн отображения информации о конкретном товаре
		 * @param int $productID ID товара
		 */
		public function action_product(int $productID) 
		{
			$data = $this->Model->ProductInfo($productID);
			$title = !empty($data['Product']) ? $data['Product']->Title : 'Товар не найден';
			$this->View->Generate('product_view.php', $title, 'template_view.php', $data);
		}
	}

?>