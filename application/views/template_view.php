<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?=$page_title?></title>
	<?php
		$root = Route::GetRoot();
		$folder_images = $root . '/images';

		$controller_name = 'home';
		$route = Route::GetRoute();
		$routes = explode('/', $route);

		if(!empty($routes[1])) $controller_name = $routes[1];

		$this -> LoadCSS($root . '/css/main.css');
	?>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;900&family=Open+Sans:wght@300;400;500;600;700;800&display=swap&family=Roboto:wght@100;300;400;500;700;900" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
	<header>
		<img src="<?=$folder_images?>/pineapple.svg"/>
		<div class="menu">
			<a href="<?=$root?>/home"<?=$controller_name == 'home' ? 'class="active"' : ''?>>Главная</a>
			<a href="<?=$root?>/catalog"<?=$controller_name == 'catalog' ? 'class="active"' : ''?>>Товары</a>
			<a href="<?=$root?>/about"<?=$controller_name == 'about' ? 'class="active"' : ''?>>О нас</a>
			<a href="<?=$root?>/home" class="auth">Вход / Регистрация</a>
		</div>
	</header>
	<section class="main-content">
		<?php include 'application/views/'.$content_view; ?>
	</section>
	<script src="/cdn/jquery.js"></script>
	<script src="/cdn/transit.js"></script>
	<script src="/cdn/anix.js?v=6"></script>
	<?php
		$this -> LoadJS($root . '/js/main.js');
	?>
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
	<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
</body>
</html>