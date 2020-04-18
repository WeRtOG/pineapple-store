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
			if(empty($page) || !is_int($page) || $page < 1) $page = 1;
			$data = $this->Model->GetData($page);
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