<?php

/*
Класс-маршрутизатор для определения запрашиваемой страницы.
> цепляет классы контроллеров и моделей;
> создает экземпляры контролеров страниц и вызывает действия этих контроллеров.
*/
class Route
{
	static function GetRoot() {
		$rt = dirname(dirname(dirname(__FILE__)));
		$rt = str_replace(str_replace('/', '\\', $_SERVER['DOCUMENT_ROOT']), '', $rt);
		$rt = str_replace('\\', '/', $rt);
		return $rt;
	}
	static function GetRoute() {
		$rt = Route::GetRoot();
		$rt = str_replace($rt, '', $_SERVER['REQUEST_URI']);
		return $rt;
	}
	static function Start()
	{
		// контроллер и действие по умолчанию
		$controller_name = 'home';
		$action_name = 'index';
		$action_id = 0;
		$rt = Route::GetRoute();
		$routes = explode('/', $rt);

		// получаем имя контроллера
		if ( !empty($routes[1]) )
		{	
			$controller_name = $routes[1];
		}
		
		// получаем имя экшена
		if ( !empty($routes[2]) )
		{
			$action_name = $routes[2];
		}

		// получаем ID параметр
		if ( !empty($routes[3]) )
		{
			$action_id = $routes[3];
		}

		// добавляем префиксы
		$model_name = 'model_'.$controller_name;
		$controller_name = 'controller_'.$controller_name;
		$action_name = 'action_'.$action_name;

		/*
		echo "Model: $model_name <br>";
		echo "Controller: $controller_name <br>";
		echo "Action: $action_name <br>";
		*/

		// подцепляем файл с классом модели (файла модели может и не быть)

		$model_file = strtolower($model_name).'.php';
		$model_path = "application/models/".$model_file;
		if(file_exists($model_path))
		{
			include "application/models/".$model_file;
		}

		// подцепляем файл с классом контроллера
		$controller_file = strtolower($controller_name).'.php';
		$controller_path = "application/controllers/".$controller_file;
		if(file_exists($controller_path))
		{
			include "application/controllers/".$controller_file;
		}
		else
		{
			/*
			правильно было бы кинуть здесь исключение,
			но для упрощения сразу сделаем редирект на страницу 404
			*/
			Route::ErrorPage404();
		}
		
		// создаем контроллер
		$controller = new $controller_name;
		$action = $action_name;
		
		if(method_exists($controller, $action))
		{
			// вызываем действие контроллера
			$controller->$action($action_id);
		}
		else
		{
			$action = 'action_404';
			if(method_exists($controller, $action)) {
				$controller->$action($action_id);
			} else {
				// здесь также разумнее было бы кинуть исключение
				Route::ErrorPage404();
			}
		}
	
	}

	function ErrorPage404()
	{
        
        header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		$rt = Route::GetRoot();
		header("Location: $rt/404");
    }
    
}
