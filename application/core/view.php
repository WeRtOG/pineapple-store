<?php
	/**
	 * Класс представления
	 */
	class View
	{
		/**
		 * Конструктор класса представления
		 */
		public function __construct()
		{
			$this->Root = Route::GetRoot();
			$this->Route = Route::GetRoute();
		}
		/**
		 * Метод для загрузки CSS
		 * @param string $path Относительный путь к файлу
		 */
		public function LoadCSS(string $path)
		{
			echo '<link rel="stylesheet" href="'.$path.'?v='.filemtime($_SERVER['DOCUMENT_ROOT'] . '/' . $path).'">' . PHP_EOL . '	';
		}
		/**
		 * Метод для загрузки JS
		 * @param string $path Относительный путь к файлу
		 */
		public function LoadJS(string $path)
		{
			echo '<script src="'.$path.'?v='.filemtime($_SERVER['DOCUMENT_ROOT'] . '/' . $path).'"></script>' . PHP_EOL;
		}
		
		/**
		 * Метод для генерации представления
		 * @param string $content_file Представления отображающие контент страниц
		 * @param string $template_file Общий для всех страниц шаблон
		 * @param string $data Массив, содержащий элементы контента страницы. Обычно заполняется в модели
		*/
		public function Generate(string $content_view, string $page_title, string $template_view, ?array $data = null)
		{
			/*
				Динамически подключаем общий шаблон (вид),
				внутри которого будет встраиваться вид
				для отображения контента конкретной страницы.
			*/
			include 'application/views/'.$template_view;
		}
	}
?>