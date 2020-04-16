<?php
	/**
	 * Контроллер главной страницы
	 */
	class Controller_Home extends Controller
	{
		/**
         * Экшн коренной страницы
         */
		public function action_index()
		{
			$this->View->Generate('home_view.php', 'Главная', 'template_view.php');
		}
	}

?>
