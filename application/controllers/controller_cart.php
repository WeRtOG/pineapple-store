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
			global $auth_helper, $orderMgr, $session_client;

			$this->Model = new Model_Cart();
			$this->View = new View();
			$this->AuthHelper = $auth_helper;
			$this->OrderManager = $orderMgr;
			$this->SessionClient = $session_client;
		}
		/**
         * Экшн коренной страницы
         */
		public function action_index()
		{
			$data = $this->Model->GetData();
			$this->View->Generate('cart_view.php', 'Корзина', 'template_view.php', $data);
		}
		/**
		 * Экшн оформления заказа
		 */
		public function action_order()
		{
			if(!$this->SessionClient->IsAuthorized) Route::Navigate('auth/register'); 
			$data = $this->Model->GetData();

			if($data['TotalPrice'] > 0) {
				switch($_SERVER['REQUEST_METHOD']) {
					case 'GET':
						$this->View->Generate('cart_order_view.php', 'Оформление заказа', 'template_view.php', $data);
						break;
					case 'POST':
						$city = (int)$this->AuthHelper->POSTSafeField('city');
						$warehouse = (int)$this->AuthHelper->POSTSafeField('warehouse');
						
						$this->OrderManager->NewOrder($this->SessionClient->Client->ID, $city, $warehouse, $data['TotalPrice']);
						$this->View->Generate('cart_order_success_view.php', 'Заказ успешно оформлен!', 'template_view.php', $data);
						echo '<meta http-equiv="refresh" content="5;URL=' . $this->View->Root . '/cabinet" />';
						break;
				}
			} else {
				Route::Navigate('cart'); 
			}
		}
	}
?>