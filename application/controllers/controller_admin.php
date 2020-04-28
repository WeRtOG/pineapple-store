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
         */
		public function action_categories()
		{
			$this->ShowLoginFormIfNeeded();
			$this->View->Generate('admin/categories_view.php', 'Категории', 'admin/template_view.php');
		}
		/**
         * Экшн страницы товаров
         */
		public function action_products()
		{
			$this->ShowLoginFormIfNeeded();
			$this->View->Generate('admin/products_view.php', 'Товары', 'admin/template_view.php');
		}
		/**
         * Экшн страницы сезонов
         */
		public function action_seasons()
		{
			$this->ShowLoginFormIfNeeded();
			$this->View->Generate('admin/seasons_view.php', 'Сезоны', 'admin/template_view.php');
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
			$this->View->Generate('admin/colors_view.php', 'Цвета', 'admin/template_view.php');
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
					$id = $this->AuthHelper->POSTSafeField('id');
					$this->Model->DeleteBrand($id);
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
					$id = $this->AuthHelper->POSTSafeField('id');
					$name = $this->AuthHelper->POSTSafeField('name');
					$this->Model->EditBrand($id, $name);
					Route::Navigate('admin/brands');
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
					$id = $this->AuthHelper->POSTSafeField('id');
					$this->Model->DeleteSize($id);
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
					$id = $this->AuthHelper->POSTSafeField('id');
					$name = $this->AuthHelper->POSTSafeField('name');
					$this->Model->EditSize($id, $name);
					Route::Navigate('admin/sizes');
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