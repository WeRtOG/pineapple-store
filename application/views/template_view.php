<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?=$page_title?> | Pineapple Shoes</title>
		<link rel="stylesheet" href="/cdn/lib/picZoomer/jquery.picZoomer.css?v=1">
		<?php
			global $session_client;

			$folder_images = $this->Root . '/images';
			$controller_name = 'home';
			$routes = explode('/', $this->Route);

			if(!empty($routes[1])) $controller_name = $routes[1];

			$this -> LoadCSS($this->Root . '/css/main.css');
		?>
		<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;900&family=Open+Sans:wght@300;400;500;600;700;800&display=swap&family=Roboto:wght@100;300;400;500;700;900" rel="stylesheet">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<script>var http_root = '<?=$this->Root?>'</script>
	</head>
	<body>
		<header>
			<img src="<?=$folder_images?>/pineapple.svg"/>
			<div class="menu">
				<a href="<?=$this->Root?>/home"<?=$controller_name == 'home' ? 'class="active"' : ''?>>Главная</a>
				<a href="<?=$this->Root?>/catalog"<?=$controller_name == 'catalog' ? 'class="active"' : ''?>>Товары</a>
				<?php if(!$session_client->IsAuthorized) { ?>
				<a href="<?=$this->Root?>/auth" class="auth<?=$controller_name == 'auth' ? ' active' : ''?>">Вход / Регистрация</a>
				<?php } else { ?>
				<a href="<?=$this->Root?>/cabinet" class="auth<?=$controller_name == 'cabinet' ? ' active' : ''?>">Привет, <?=explode(' ', $session_client->Client->Name)[0]?>!</a>
				<?php } ?>
			</div>
			<a class="cart<?=$controller_name == 'cart' ? ' active' : ''?>" href="<?=$this->Root?>/cart">
				<img src="<?=$this->Root?>/images/shopping_cart.svg"/>
				<div class="count hidden">0</div>
			</a>
		</header>
		<section class="main-content">
			<?php include 'application/views/'.$content_view; ?>
		</section>
		<footer class="anix">
			<div class="social-links">
				<a title="Наш Telegram" href="https://telegram.org" target="_blank">
					<img src="<?=$this->Root?>/images/social-telegram.svg?v=1"/>
				</a>
				<a title="Наш Instagram" href="https://instagram.com" target="_blank">
					<img src="<?=$this->Root?>/images/social-instagram.svg?v=1"/>
				</a>
				<p class="copyright">
					© Uk. Soft - Evolution 2014-<?=date("Y")?>
				</p>
			</div>
		</footer>
		<script src="/cdn/jquery.js"></script>
		<script src="/cdn/transit.js"></script>
		<script src="/cdn/anix.js?v=6"></script>
		<?php
			$this -> LoadJS($this->Root . '/js/class.api.js');
			$this -> LoadJS($this->Root . '/js/methods.js');
			$this -> LoadJS($this->Root . '/js/events.js');
			$this -> LoadJS($this->Root . '/js/main.js');
		?>
		<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
		<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
		<script src="/cdn/lib/picZoomer/jquery.picZoomer.js?v=1"></script>
	</body>
</html>