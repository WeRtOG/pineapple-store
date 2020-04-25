<?php
	/**
	 * Контроллер корзины
	 */
	class Controller_Cart extends Controller
	{
		/**
		 * Конструктор контроллера корзины
		 */
		public function __construct()
		{
			$this->Model = new Model_Cart();
			$this->View = new View();
		}
		/**
         * Экшн коренной страницы
         */
		public function action_index()
		{
			$data = $this->Model->GetData();
			$this->View->Generate('cart_view.php', 'Корзина', 'template_view.php', $data);
		}
	}
?>