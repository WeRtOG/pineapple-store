<?php

	// Подключаем файлы ядра
	require_once 'core/model.php';
	require_once 'core/view.php';
	require_once 'core/controller.php';
	require_once 'core/route.php';

	// Основные константы
	define('ACTION_SUCCESS', 1);
	define('ERROR_FIELD_EMPTY_DATA', 20);
	define('ERROR_USER_NOT_FOUND', 21);
	define('ERROR_USER_ALREADY_EXISTS', 22);
	define('ERROR_INVALID_PWD', 23);
	define('ERROR_MYSQL', 24);
	

	/*
		Здесь обычно подключаются дополнительные модули, реализующие различный функционал:
		> аутентификацию
		> кеширование
		> работу с формами
		> абстракции для доступа к данным
		> ORM
		> Unit тестирование
		> Benchmarking
		> Работу с изображениями
		> Backup
		> и др.
	*/
	require_once 'class.image.php';
	require_once 'class.client.php';
	require_once 'class.api.php';
	require_once 'class.db.php';

	$db = new DatabaseManager\Database('localhost', 'admin', '4TE5CF67C5', 'pineapple_shoes'); // Подключаемся к БД
	
	$clientMgr = new ClientManager\ClientManager($db); // Инициализируем менеджер клиентов
	$session_client = new ClientManager\SessionClient('pineapple-user', $clientMgr, $db); // Инициализируем клиента
	$auth_helper = new ClientManager\AuthHelper($db); // Инициализируем хелпер для авторизации

	Route::Start(); // Запускаем маршрутизатор
?>