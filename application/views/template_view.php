<!DOCTYPE html>
<html lang="<?=$_COOKIE['lang']?>">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?=$page_title?> | Pineapple Shoes</title>
		<link rel="stylesheet" href="/cdn/lib/picZoomer/jquery.picZoomer.css?v=0">
		<?php
			global $session_client;

			// Получаем имя контроллера
			$controller_name = 'home';
			$routes = explode('/', $this->Route);
			if(!empty($routes[1])) $controller_name = $routes[1];

			// Загружаем CSS
			$this -> LoadCSS($this->Root . '/css/main.css');
		?>
		<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;900&family=Open+Sans:wght@300;400;500;600;700;800&display=swap&family=Roboto:wght@100;300;400;500;700;900" rel="stylesheet">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<script>var http_root = '<?=$this->Root?>'</script>

		<link rel="shortcut icon" href="<?=$this->Root?>/images/pineapple-icon.png" type="image/x-icon">
		<!-- Google / Search Engine Tags -->
		<meta itemprop="name" content="<?=$page_title?>">
		<meta itemprop="description" content="Pineapple Shoes">
		<meta itemprop="image" content="<?='https://uksoftevolution.com'.$this->Root?>/images/pineapple-icon.png">

		<!-- Facebook Meta Tags -->
		<meta property="og:type" content="website">
		<meta property="og:title" content="<?=$page_title?>">
		<meta property="og:description" content="Pineapple Shoes">
		<meta property="og:image" content="<?='https://uksoftevolution.com'.$this->Root?>/images/pineapple-icon.png">
	</head>
	<body>
		<header>
			<img src="<?=$this->Root . '/images'?>/pineapple.svg"/>
			<div class="menu">
				<a data-translate="content" href="<?=$this->Root?>/home"<?=$controller_name == 'home' ? 'class="active"' : ''?>>Главная</a>
				<a data-translate="content" href="<?=$this->Root?>/catalog"<?=$controller_name == 'catalog' ? 'class="active"' : ''?>>Товары</a>
				<?php if(!$session_client->IsAuthorized) { ?>
				<a data-translate="content" href="<?=$this->Root?>/auth" class="auth<?=$controller_name == 'auth' ? ' active' : ''?>">Вход и регистрация</a>
				<?php } else { ?>
				<a href="<?=$this->Root?>/cabinet" class="auth<?=$controller_name == 'cabinet' ? ' active' : ''?>"><span data-translate="content">Привет</span>, <?=explode(' ', $session_client->Client->Name)[0]?>!</a>
				<?php } ?>
				<div class="lang-select">
					<a class="lang change-lang-ru<?=$_COOKIE['lang'] != 'ua' ? ' active' : ''?>">RU</a>
					<a class="lang change-lang-ua<?=$_COOKIE['lang'] == 'ua' ? ' active' : ''?>">UA</a>
				</div>
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
				<a title="Наш Telegram" href="https://t.me/DmitriyPsh" target="_blank">
					<img src="<?=$this->Root?>/images/social-telegram.svg?v=1"/>
				</a>
				<a title="Наш Instagram" href="https://instagram.com/pineapple.krossФ" target="_blank">
					<img src="<?=$this->Root?>/images/social-instagram.svg?v=1"/>
				</a>
				<p class="copyright">
					© Uk. Soft - Evolution 2014-<?=date("Y")?>
				</p>
			</div>
		</footer>
		<div class="loading-screen<?=$_COOKIE['lang'] != 'ua' ? ' hidden collapsed' : ''?>">
			Завантаження...
		</div>
		<script src="/cdn/jquery.js"></script>
		<script src="/cdn/transit.js"></script>
		<script src="/cdn/anix.js?v=6"></script>
		<?php
			$this -> LoadJS($this->Root . '/js/api.js');
			$this -> LoadJS($this->Root . '/js/methods.js');
			$this -> LoadJS($this->Root . '/js/events.js');
			$this -> LoadJS($this->Root . '/js/main.js');
			$this -> LoadJS($this->Root . '/js/translate.js');
		?>
		<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
		<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
		<script src="/cdn/lib/picZoomer/jquery.picZoomer.js?v=2"></script>
	</body>
</html>