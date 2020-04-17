<?php
	/**
	 * Контроллер страницы корзины
	 */
	class Controller_Cart extends Controller
	{
		/**
         * Экшн коренной страницы
         */
		public function action_index()
		{
			$this->View->Generate('cart_view.php', 'Корзина', 'template_view.php');
		}
	}
?>