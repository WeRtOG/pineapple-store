<?php
	/**
	 * Контроллер админки
	 */
	class Controller_Admin extends Controller
	{
		private \Admin\Auth $Auth;

		/**
		 * Конструктор контроллера админки
		 */
		public function __construct()
		{
			global $adminAuth, $auth_helper;

			$this->Auth = $adminAuth;
			$this->View = new View();
			$this->Model = new Model_Admin();
			$this->AuthHelper = $auth_helper;
		}
		/**
		 * Метод проверки доступа и отображения формы входа в случае если пользователь не авторизован
		 */
		private function ShowLoginFormIfNeeded() {
			if(!$this->Auth->IsAuthorized) {
				switch($_SERVER['REQUEST_METHOD']) {
					case 'GET':
						$this->View->Generate('admin/login_view.php', 'Вход', 'admin/auth_template_view.php');
						break;
					case 'POST':
						$login = $this->AuthHelper->POSTSafeField('login');
						$password = $this->AuthHelper->POSTSafeField('password');
	
						$result = $this->Auth->DoLogin($login, $password);
						switch($result) {
							case ERROR_INVALID_PWD:
								$this->View->Generate('admin/login_view.php', 'Вход', 'admin/auth_template_view.php', [
									'error' => 'Неверный пароль.'
								]);
								break;
							case ACTION_SUCCESS:
								Route::Navigate('admin');
								break;
						}
						break;
				}
				exit();
			}
		}
		/**
         * Экшн коренной страницы
         */
		public function action_index()
		{
			$this->ShowLoginFormIfNeeded();
			Route::Navigate('admin/brands');
		}
		/**
         * Экшн страницы брендов
         */
		public function action_brands()
		{
			$this->ShowLoginFormIfNeeded();
			$this->View->Generate('admin/brands_view.php', 'Бренды', 'admin/template_view.php', $this->Model->GetBrands());
		}
		/**
         * Экшн страницы категорий
		 * @param $parentID ID родительской категории
         */
		public function action_categories($parentID = -1)
		{
			$parentID = (int)$parentID;
			if(empty($parentID) || !is_int($parentID)) $parentID = -1;
			$this->ShowLoginFormIfNeeded();
			$this->View->Generate('admin/categories_view.php', 'Категории', 'admin/template_view.php', $this->Model->GetCategories($parentID));
		}
		/**
         * Экшн страницы товаров
		 * @param $page Страница
         */
		public function action_products($page = 1)
		{
			$page = (int)$page;
			if(empty($page) || !is_int($page) || $page < 1) $page = 1;
			$this->ShowLoginFormIfNeeded();
			$this->View->Generate('admin/products_view.php', 'Товары', 'admin/template_view.php', $this->Model->GetProducts($page));
		}
		/**
         * Экшн страницы сезонов
         */
		public function action_seasons()
		{
			$this->ShowLoginFormIfNeeded();
			$this->View->Generate('admin/seasons_view.php', 'Сезоны', 'admin/template_view.php', $this->Model->GetSeasons());
		}
		/**
         * Экшн страницы размеров
         */
		public function action_sizes()
		{
			$this->ShowLoginFormIfNeeded();
			$this->View->Generate('admin/sizes_view.php', 'Размеры', 'admin/template_view.php', $this->Model->GetSizes());
		}
		/**
         * Экшн страницы цветов
         */
		public function action_colors()
		{
			$this->ShowLoginFormIfNeeded();
			$this->View->Generate('admin/colors_view.php', 'Цвета', 'admin/template_view.php', $this->Model->GetColors());
		}
		/**
         * Экшн страницы клиентов
		 * @param $page Страница
         */
		public function action_clients($page = 1)
		{
			$page = (int)$page;
			if(empty($page) || !is_int($page) || $page < 1) $page = 1;
			$this->ShowLoginFormIfNeeded();
			$this->View->Generate('admin/clients_view.php', 'Клиенты', 'admin/template_view.php', $this->Model->GetClients($page));
		}
		/**
         * Экшн страницы заказов
		 * @param $page Страница
         */
		public function action_orders($page = 1)
		{
			$page = (int)$page;
			if(empty($page) || !is_int($page) || $page < 1) $page = 1;
			$this->ShowLoginFormIfNeeded();
			$this->View->Generate('admin/orders_view.php', 'Заказы', 'admin/template_view.php', $this->Model->GetOrders($page));
		}
		/**
		 * Экшн добавления бренда
		 */
		public function action_addbrand()
		{
			$this->ShowLoginFormIfNeeded();
			switch($_SERVER['REQUEST_METHOD']) {
				case 'GET':
					Route::Navigate('admin/brands');
					break;
				case 'POST':
					$brand = $this->AuthHelper->POSTSafeField('brand');
					$this->Model->AddBrand($brand);
					Route::Navigate('admin/brands');
					break;
			}
		}
		/**
		 * Экшн удаления бренда
		 */
		public function action_deletebrand()
		{
			$this->ShowLoginFormIfNeeded();
			switch($_SERVER['REQUEST_METHOD']) {
				case 'GET':
					Route::Navigate('admin/brands');
					break;
				case 'POST':
					$ID = $this->AuthHelper->POSTSafeField('id');
					$this->Model->DeleteBrand($ID);
					Route::Navigate('admin/brands');
					break;
			}
		}
		/**
		 * Экшн редактирования бренда
		 */
		public function action_editbrand()
		{
			$this->ShowLoginFormIfNeeded();
			switch($_SERVER['REQUEST_METHOD']) {
				case 'GET':
					Route::Navigate('admin/brands');
					break;
				case 'POST':
					$ID = $this->AuthHelper->POSTSafeField('id');
					$name = $this->AuthHelper->POSTSafeField('name');
					$this->Model->EditBrand($ID, $name);
					Route::Navigate('admin/brands');
					break;
			}
		}
		/**
		 * Экшн добавления категории
		 */
		public function action_addcategory()
		{
			$this->ShowLoginFormIfNeeded();
			switch($_SERVER['REQUEST_METHOD']) {
				case 'GET':
					Route::Navigate('admin/categories');
					break;
				case 'POST':
					$category = $this->AuthHelper->POSTSafeField('category');
					$parentID = (int)$this->AuthHelper->POSTSafeField('parentID');
					$this->Model->AddCategory($category, $parentID);
					
					if($parentID != -1) {
						Route::Navigate('admin/categories/' . $parentID);
					} else {
						Route::Navigate('admin/categories');
					}
					
					break;
			}
		}
		/**
		 * Экшн удаления категории
		 */
		public function action_deletecategory()
		{
			$this->ShowLoginFormIfNeeded();
			switch($_SERVER['REQUEST_METHOD']) {
				case 'GET':
					Route::Navigate('admin/categories');
					break;
				case 'POST':
					$ID = $this->AuthHelper->POSTSafeField('id');
					$parentID = (int)$this->AuthHelper->POSTSafeField('parentID');
					$this->Model->DeleteCategory($ID);

					if($parentID != -1) {
						Route::Navigate('admin/categories/' . $parentID);
					} else {
						Route::Navigate('admin/categories');
					}

					break;
			}
		}
		/**
		 * Экшн редактирования категории
		 */
		public function action_editcategory()
		{
			$this->ShowLoginFormIfNeeded();
			switch($_SERVER['REQUEST_METHOD']) {
				case 'GET':
					Route::Navigate('admin/categories');
					break;
				case 'POST':
					$ID = $this->AuthHelper->POSTSafeField('id');
					$name = $this->AuthHelper->POSTSafeField('name');
					$parentID = (int)$this->AuthHelper->POSTSafeField('parentID');

					$this->Model->EditCategory($ID, $name);
					
					if($parentID != -1) {
						Route::Navigate('admin/categories/' . $parentID);
					} else {
						Route::Navigate('admin/categories');
					}
					
					break;
			}
		}
		/**
		 * Экшн добавления размера
		 */
		public function action_addsize()
		{
			$this->ShowLoginFormIfNeeded();
			switch($_SERVER['REQUEST_METHOD']) {
				case 'GET':
					Route::Navigate('admin/sizes');
					break;
				case 'POST':
					$size = $this->AuthHelper->POSTSafeField('size');
					$this->Model->AddSize($size);
					Route::Navigate('admin/sizes');
					break;
			}
		}
		/**
		 * Экшн удаления размера
		 */
		public function action_deletesize()
		{
			$this->ShowLoginFormIfNeeded();
			switch($_SERVER['REQUEST_METHOD']) {
				case 'GET':
					Route::Navigate('admin/sizes');
					break;
				case 'POST':
					$ID = $this->AuthHelper->POSTSafeField('id');
					$this->Model->DeleteSize($ID);
					Route::Navigate('admin/sizes');
					break;
			}
		}
		/**
		 * Экшн редактирования размера
		 */
		public function action_editsize()
		{
			$this->ShowLoginFormIfNeeded();
			switch($_SERVER['REQUEST_METHOD']) {
				case 'GET':
					Route::Navigate('admin/sizes');
					break;
				case 'POST':
					$ID = $this->AuthHelper->POSTSafeField('id');
					$name = $this->AuthHelper->POSTSafeField('name');
					$this->Model->EditSize($ID, $name);
					Route::Navigate('admin/sizes');
					break;
			}
		}
		/**
		 * Экшн добавления сезона
		 */
		public function action_addseason()
		{
			$this->ShowLoginFormIfNeeded();
			switch($_SERVER['REQUEST_METHOD']) {
				case 'GET':
					Route::Navigate('admin/seasons');
					break;
				case 'POST':
					$season = $this->AuthHelper->POSTSafeField('season');
					$dateFrom = $this->AuthHelper->POSTSafeField('dateFrom');
					$dateTo = $this->AuthHelper->POSTSafeField('dateTo');
					$this->Model->AddSeason($season, $dateFrom, $dateTo);
					Route::Navigate('admin/seasons');
					break;
			}
		}
		/**
		 * Экшн удаления сезона
		 */
		public function action_deleteseason()
		{
			$this->ShowLoginFormIfNeeded();
			switch($_SERVER['REQUEST_METHOD']) {
				case 'GET':
					Route::Navigate('admin/seasons');
					break;
				case 'POST':
					$ID = $this->AuthHelper->POSTSafeField('id');
					$this->Model->DeleteSeason($ID);
					Route::Navigate('admin/seasons');
					break;
			}
		}
		/**
		 * Экшн редактирования сезона
		 */
		public function action_editseason()
		{
			$this->ShowLoginFormIfNeeded();
			switch($_SERVER['REQUEST_METHOD']) {
				case 'GET':
					Route::Navigate('admin/seasons');
					break;
				case 'POST':
					$ID = $this->AuthHelper->POSTSafeField('id');
					$name = $this->AuthHelper->POSTSafeField('name');
					$dateFrom = $this->AuthHelper->POSTSafeField('dateFrom');
					$dateTo = $this->AuthHelper->POSTSafeField('dateTo');
					$this->Model->EditSeason($ID, $name, $dateFrom, $dateTo);
					Route::Navigate('admin/seasons');
					break;
			}
		}
		/**
		 * Экшн добавления цвета
		 */
		public function action_addcolor()
		{
			$this->ShowLoginFormIfNeeded();
			switch($_SERVER['REQUEST_METHOD']) {
				case 'GET':
					Route::Navigate('admin/colors');
					break;
				case 'POST':
					$colorName = $this->AuthHelper->POSTSafeField('color-name');
					$color = $this->AuthHelper->POSTSafeField('color');
					$this->Model->AddColor($colorName, $color);
					Route::Navigate('admin/colors');
					break;
			}
		}
		/**
		 * Экшн удаления цвета
		 */
		public function action_deletecolor()
		{
			$this->ShowLoginFormIfNeeded();
			switch($_SERVER['REQUEST_METHOD']) {
				case 'GET':
					Route::Navigate('admin/colors');
					break;
				case 'POST':
					$ID = $this->AuthHelper->POSTSafeField('id');
					$this->Model->DeleteColor($ID);
					Route::Navigate('admin/colors');
					break;
			}
		}
		/**
		 * Экшн редактирования цвета
		 */
		public function action_editcolor()
		{
			$this->ShowLoginFormIfNeeded();
			switch($_SERVER['REQUEST_METHOD']) {
				case 'GET':
					Route::Navigate('admin/colors');
					break;
				case 'POST':
					$ID = $this->AuthHelper->POSTSafeField('id');
					$name = $this->AuthHelper->POSTSafeField('name');
					$color = $this->AuthHelper->POSTSafeField('color');
					$this->Model->EditColor($ID, $name, $color);
					Route::Navigate('admin/colors');
					break;
			}
		}
		/**
		 * Экшн удаления товара
		 */
		public function action_deleteproduct()
		{
			$this->ShowLoginFormIfNeeded();
			switch($_SERVER['REQUEST_METHOD']) {
				case 'GET':
					Route::Navigate('admin/products');
					break;
				case 'POST':
					$ID = $this->AuthHelper->POSTSafeField('id');
					$Page = $this->AuthHelper->POSTSafeField('page');
					$this->Model->DeleteProduct($ID);
					Route::Navigate('admin/products/' . $Page);
					break;
			}
		}
		/**
		 * Экшн редактирования товара
		 * @param $ID ID товара
		 */
		public function action_editproduct($ID = 0)
		{
			$ID = (int)$ID;
			$this->ShowLoginFormIfNeeded();
			$data = $this->Model->GetProduct($ID);
			switch($_SERVER['REQUEST_METHOD']) {
				case 'GET':
					if(!empty($data['Product'])) {
						$this->View->Generate('admin/product_edit_view.php', $data['Product']->Title, 'admin/template_view.php', $data);
					} else {
						Route::Navigate('admin/products');
					}
					break;
				case 'POST':
					if(!empty($data['Product'])) {
						$name = $this->AuthHelper->POSTSafeField('name');
						$year = (int)$this->AuthHelper->POSTSafeField('year');
						$price = (int)$this->AuthHelper->POSTSafeField('price');
						$category = (int)$this->AuthHelper->POSTSafeField('category');
						$brand = (int)$this->AuthHelper->POSTSafeField('brand');
						$season = (int)$this->AuthHelper->POSTSafeField('season');
						$colors = array_key_exists('colors', $_POST) ? $_POST['colors'] : [];
						$sizes = array_key_exists('sizes', $_POST) ? $_POST['sizes'] : [];
						$description = $_POST['description'];

						$this->Model->UpdateProduct($name, $year, $price, $category, $brand, $season, $colors, $sizes, $description, $ID);
						Route::Navigate('admin/editproduct/' . $ID . '/?');
					} else {
						Route::Navigate('admin/products');
					}
					break;
			}
		}
		/**
		 * Экшн добавления товара
		 */
		public function action_addproduct()
		{
			$this->ShowLoginFormIfNeeded();
			
			$data = $this->Model->AddProductModel();

			switch($_SERVER['REQUEST_METHOD']) {
				case 'GET':
					$this->View->Generate('admin/product_add_view.php', 'Добавление товара', 'admin/template_view.php', $data);
					break;
				case 'POST':
					$name = $this->AuthHelper->POSTSafeField('name');
					$year = (int)$this->AuthHelper->POSTSafeField('year');
					$price = (int)$this->AuthHelper->POSTSafeField('price');
					$category = (int)$this->AuthHelper->POSTSafeField('category');
					$brand = (int)$this->AuthHelper->POSTSafeField('brand');
					$season = (int)$this->AuthHelper->POSTSafeField('season');
					$colors = array_key_exists('colors', $_POST) ? $_POST['colors'] : [];
					$sizes = array_key_exists('sizes', $_POST) ? $_POST['sizes'] : [];
					$description = $_POST['description'];

					$ID = $this->Model->AddProduct($name, $year, $price, $category, $brand, $season, $colors, $sizes, $description);
					Route::Navigate('admin/editproduct/' . $ID . '/?');
					break;
			}
		}
		/**
		 * Метод смены статуса заказа
		 */
		public function action_ChangeOrderStatus()
		{
			$this->ShowLoginFormIfNeeded();
			switch($_SERVER['REQUEST_METHOD']) {
				case 'GET':
					Route::Navigate('admin/orders');
					break;
				case 'POST':
					$ID = $this->AuthHelper->POSTSafeField('id');
					$Page = $this->AuthHelper->POSTSafeField('page');
					$Status = (int)$this->AuthHelper->POSTSafeField('status');
					$this->Model->ChangeOrderStatus($ID, $Status);
					Route::Navigate('admin/orders/' . $page);
					break;
			}
		}
		/**
		 * Экшн выхода
		 */
		public function action_logout()
		{
			$this->Auth->DoLogout();
			Route::Navigate('admin');
		}
	}
?>