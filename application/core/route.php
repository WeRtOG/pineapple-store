<?php
	/**
	 * Класс-маршрутизатор для определения запрашиваемой страницы.
	 * * цепляет классы контроллеров и моделей;
	 * * создает экземпляры контролеров страниц и вызывает действия этих контроллеров.
	 */
	class Route
	{
		/**
		 * Метод для получения коренного пути относительно домена
		 */
		static function GetRoot()
		{
			$rt = dirname(dirname(dirname(__FILE__)));
			$rt = str_replace(str_replace('/', '\\', $_SERVER['DOCUMENT_ROOT']), '', $rt);
			$rt = str_replace('\\', '/', $rt);
			return $rt;
		}
		/**
		 * Метод для получения роутинга относительно текущего приложения
		 */
		static function GetRoute()
		{
			$rt = Route::GetRoot();
			$rt = str_replace($rt, '', $_SERVER['REQUEST_URI']);
			return $rt;
		}
		/**
		 * Метод для навигации к нужной странице относительно корня текущего приложения
		 * @param string $page Страница 
		 */
		static function Navigate(string $page)
		{
			header('Location: ' . Route::GetRoot() . '/' . $page);
		}
		/**
		 * Метод для запуска роутинга
		 */
		static function Start()
		{
			// Контроллер, действие и ID по умолчанию
			$controller_name = 'home';
			$action_name = 'index';
			$action_id = 0;

			// Получаем роутинг
			$rt = Route::GetRoute();
			$routes = explode('/', $rt);

			// Получаем имя контроллера
			if(!empty($routes[1]))
			{	
				$controller_name = $routes[1];
			}
			
			// Получаем имя экшена
			if(!empty($routes[2]))
			{
				$action_name = $routes[2];
			}

			// Получаем ID
			if(!empty($routes[3]))
			{
				$action_id = $routes[3];
			}

			// Добавляем префиксы
			$model_name = 'model_'.$controller_name;
			$controller_name = 'controller_'.$controller_name;
			$action_name = 'action_'.$action_name;

			/*
			echo "Model: $model_name <br>";
			echo "Controller: $controller_name <br>";
			echo "Action: $action_name <br>";
			*/

			// Подцепляем файл с классом модели (файла модели может и не быть)

			$model_file = strtolower($model_name).'.php';
			$model_path = "application/models/".$model_file;
			if(file_exists($model_path))
			{
				include "application/models/".$model_file;
			}

			// Подцепляем файл с классом контроллера
			$controller_file = strtolower($controller_name).'.php';
			$controller_path = "application/controllers/".$controller_file;
			if(file_exists($controller_path))
			{
				include "application/controllers/".$controller_file;
			}
			else
			{
				Route::ErrorPage404();
			}
			
			// Создаем контроллер
			$controller = new $controller_name;
			$action = $action_name;
			
			if(method_exists($controller, $action))
			{
				// Вызываем действие контроллера
				$controller->$action($action_id);
			}
			else
			{
				$action = 'action_404';
				if(method_exists($controller, $action)) {
					$controller->$action($action_id);
				} else {
					Route::ErrorPage404();
				}
			}
		
		}
		/**
		 * Функция для навигации к 404 ошибке
		 */
		static function ErrorPage404()
		{
			header('HTTP/1.1 404 Not Found');
			header("Status: 404 Not Found");
			Route::Navigate('4040');
		}
	}
?>