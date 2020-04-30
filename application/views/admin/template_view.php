<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?=$page_title?> | Pineapple Shoes Admin</title>
        <?php
            $controller_action = 'brands';
            $routes = explode('/', $this->Route);
            if(!empty($routes[2])) $controller_action = $routes[2];

			$this -> LoadCSS($this->Root . '/css/admin-main.css');
		?>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script>var http_root = '<?=$this->Root?>'</script>
    </head>
    <body>
        <section class="main">
            <section class="sidebar anix">
                <a href="<?=$this->Root?>/admin/brands" <?=$controller_action == 'brands' ? 'class="active"' : ''?>>
                    <span class="material-icons">label</span>
                    <span class="text">Бренды</span>
                </a>
                <a href="<?=$this->Root?>/admin/categories" <?=$controller_action == 'categories' ? 'class="active"' : ''?>>
                    <span class="material-icons">category</span>
                    <span class="text">Категории</span>
                </a>
                <a href="<?=$this->Root?>/admin/products" <?=$controller_action == 'products' || $controller_action == 'editproduct' ? 'class="active"' : ''?>>
                    <span class="material-icons">storefront</span>
                    <span class="text">Товары</span>
                </a>
                <a href="<?=$this->Root?>/admin/seasons" <?=$controller_action == 'seasons' ? 'class="active"' : ''?>>
                    <span class="material-icons">beach_access</span>
                    <span class="text">Сезоны</span>
                </a>
                <a href="<?=$this->Root?>/admin/sizes" <?=$controller_action == 'sizes' ? 'class="active"' : ''?>>
                    <span class="material-icons">square_foot</span>
                    <span class="text">Размеры</span>
                </a>
                <a href="<?=$this->Root?>/admin/colors" <?=$controller_action == 'colors' ? 'class="active"' : ''?>>
                    <span class="material-icons">invert_colors</span>
                    <span class="text">Цвета</span>
                </a>
                <a href="<?=$this->Root?>/admin/clients" <?=$controller_action == 'clients' ? 'class="active"' : ''?>>
                    <span class="material-icons">people_outline</span>
                    <span class="text">Клиенты</span>
                </a>
                <a href="<?=$this->Root?>/admin/logout">
                    <span class="material-icons">exit_to_app</span>
                    <span class="text">Выйти</span>
                </a>
            </section>
            <section class="content anix">
                <?php include 'application/views/'.$content_view; ?>
            </section>
        </section>
        <script src="/cdn/jquery.js"></script>
		<script src="/cdn/transit.js"></script>
		<script src="/cdn/anix.js?v=6"></script>
        <?php
            $this -> LoadJS($this->Root . '/js/admin.api.js');
			$this -> LoadJS($this->Root . '/js/admin.methods.js');
			$this -> LoadJS($this->Root . '/js/admin.events.js');
			$this -> LoadJS($this->Root . '/js/admin.main.js');
        ?>
    </body>
</html>