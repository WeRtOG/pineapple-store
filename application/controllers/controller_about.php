<?php
	/**
	 * Контроллер страницы "О нас"
	 */
	class Controller_About extends Controller
	{
		/**
         * Экшн коренной страницы
         */
		public function action_index()
		{
			$this->View->Generate('about_view.php', 'О нас', 'template_view.php');
		}
	}
?>