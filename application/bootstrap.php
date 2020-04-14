<?php

	// подключаем файлы ядра
	require_once 'core/model.php';
	require_once 'core/view.php';
	require_once 'core/controller.php';

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
	require_once 'class.client.php';

	$db = new mysqli('localhost', 'admin', '4TE5CF67C5', 'pineapple_shoes'); // подключаемся к БД
	
	$clientMgr = new ClientManager\ClientManager($db);
	$session_client = new ClientManager\SessionClient('pineapple-user', $clientMgr); // инициализируем клиента

	require_once 'core/route.php';
	Route::Start(); // запускаем маршрутизатор
?>