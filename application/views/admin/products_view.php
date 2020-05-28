<section class="cards">
    <a href="<?=$this->Root?>/admin/addproduct">
        <section class="card product add">
            <h1>
                <span class="material-icons">
                    add_circle_outline
                </span>
                <span data-translate="content">
                    Добавить товар
                </span>
            </h1>
        </section>
    </a>
    <?php foreach($data['Products'] as $product) { ?>
    <section class="card product">
        <div class="image" style="background-image: url(<?=$product->Images->ImagesList[0]->Path?>)"></div>
        <h1 class="name"><a href="<?=$this->Root?>/catalog/product/<?=$product->ID?>" target="_blank"><?=$product->Name?>&nbsp;<span data-translate="content">(<?=$product->Category->Name?>)</span></a></h1>
        <div class="actions">
            <form action="<?=$this->Root?>/admin/editproduct/<?=$product->ID?>/">
                <input data-translate="title" title="Редактировать" type="submit" value="edit"/>
            </form>
            <form data-translate="confirm" action="<?=$this->Root?>/admin/deleteproduct" data-confirm="Вы уверены, что хотите удалить этот товар?" method="POST">
                <input type="hidden" name="id" value="<?=$product->ID?>"/>
                <input type="hidden" name="page" value="<?=$data['Page']?>"/>
                <input data-translate="title" title="Удалить" type="submit" value="delete_forever"/>
            </form>
        </div>
    </section>
    <?php } ?>
    <?php if($data['PageCount'] > 1) { ?>
    <section class="page-select anix">
        <?
            // Получаем текующую страницу и кол-во страниц
            $page = $data['Page'];
            $all_pages = $data['PageCount'];

            // Рассчитываем кнопки
            $start = $page - 2;
            if($all_pages < 4)
                $buttons = $all_pages;
            else
                $buttons = 4;
            if($start < 1) {
                $start = 1;
            }
            if($buttons < 4 && $all_pages > 4)
                $buttons = $buttons + 2;
            $end = $buttons + $start;
            if($end > $all_pages) $end = $all_pages;

            $q_string = '';
            if(count($_GET) > 0) $q_string = '?' . http_build_query($_GET);

            // Выводим кнопки
            if($start != 1) {
                echo '<a href="' . $this->Root . '/admin/products/1/' . $q_string . '"><button class="page sw">&laquo;</button></a>';
            }
            for($i = $start; $i <= $end; $i++) {
            ?>
            <a href="<?=$this->Root?>/admin/products/<?=$i?>/<?=$q_string?>"><button class="page<?=$page == $i ? ' current' : ''?>"><?=$i?></button></a>
            <?php
            }
            if($all_pages > $end) {
                echo '<a href="' . $this->Root . '/admin/products/' . $all_pages . '/' . $q_string . '"><button class="page sw">&raquo;</button></a>';
            }
        ?>
    </section>
    <?php } ?>
</section>