<?php
	/**
	 * Контроллер 404-страницы
	 */
	class Controller_404 extends Controller
	{
		/**
         * Экшн коренной страницы
         */
		public function action_index()
		{
			$this->View->Generate('404_view.php', '404', 'template_view.php');
		}
	}
?>