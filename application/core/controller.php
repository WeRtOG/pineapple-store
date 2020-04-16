<?php
	/**
	 * Класс контроллера
	 */
	class Controller {
		
		public Model $Model;
		public View $View;
		
		/**
		 * Конструктор контроллера по-умолчанию
		 */
		public function __construct()
		{
			$this->View = new View();
		}
		
		/**
		 * Экшн коренной страницы по-умолчанию
		 */
		public function action_index()
		{
			// To Do	
		}
	}
?>