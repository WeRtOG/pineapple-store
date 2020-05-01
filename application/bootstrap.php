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
	define('ERROR_UNAUTHORIZED', 25);
	define('UPLOADS_FOLDER', dirname(__DIR__) . '\\uploads');
	

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
	require_once 'class.file.io.php';
	require_once 'class.image.php';
	require_once 'class.client.php';
	require_once 'class.admin.php';
	require_once 'class.novaposhta.php';
	require_once 'class.api.php';
	require_once 'class.db.php';
	require_once 'class.product.php';
	require_once 'class.cart.php';
	require_once 'class.cities.manager.php';
	require_once 'class.order.php';

	$db = new DatabaseManager\Database('localhost', 'admin', '4TE5CF67C5', 'pineapple_shoes'); // Подключаемся к БД
	
	$clientMgr = new ClientManager\ClientManager($db); // Инициализируем менеджер клиентов
	$session_client = new ClientManager\SessionClient('pineapple-user', $clientMgr, $db); // Инициализируем клиента
	$adminAuth = new Admin\Auth('pineapple-admin');
	$auth_helper = new ClientManager\AuthHelper($db); // Инициализируем хелпер для авторизации
	$productMgr = new ProductManager\ProductManager($db); // Инициализируем менеджер товаров
	$cart = new ClientCart\Cart($session_client->Client, $db, $productMgr); // Инициализируем корзину
	$npAPI = new NovaPoshta\API('2dcaea4188edd931ab6a363dfd9b4809'); // Инициализируем API Новой Почты
	$citiesMgr = new CitiesManager\CitiesManager($db); // Инициализируем менеджер городов
	$orderMgr = new OrderManager\OrderManager($db, $productMgr, $clientMgr); // Инициализируем менеджер заказов


	/* Если снова пропадут товары
	for($i = 0; $i < 500; $i++) {
		$db->call_procedure('addProduct', [
			'Товар #' . $i,
			'Бла-бла-бла',
			4,
			15,
			7,
			2077,
			2999.99,
		]);
	}*/

	Route::Start(); // Запускаем маршрутизатор
?>