<section class="cards">
    <?php foreach($data['Clients'] as $client) { ?>
    <section class="card client">
        <div class="avatar<?=$client->Avatar->IsDefault ? ' default' : ''?>" style="background-image: url(<?=$client->Avatar->Image->Path?>)"></div>
        <h1 class="name"><?=$client->Name?><span> (<?=$client->Phone?>)</span></h1>
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
                echo '<a href="' . $this->Root . '/admin/clients/1/' . $q_string . '"><button class="page sw">&laquo;</button></a>';
            }
            for($i = $start; $i <= $end; $i++) {
            ?>
            <a href="<?=$this->Root?>/admin/clients/<?=$i?>/<?=$q_string?>"><button class="page<?=$page == $i ? ' current' : ''?>"><?=$i?></button></a>
            <?php
            }
            if($all_pages > $end) {
                echo '<a href="' . $this->Root . '/admin/clients/' . $all_pages . '/' . $q_string . '"><button class="page sw">&raquo;</button></a>';
            }
        ?>
    </section>
    <?php } ?>
</section>