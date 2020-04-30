<section class="cards">
    <?php foreach($data['Colors'] as $color) { ?>
    <section class="card">
        <h1 class="name"><?=$color->Name?></h1>
        <div class="actions">
            <form action="<?=$this->Root?>/admin/editcolor" method="POST">
                <input type="hidden" name="id" value="<?=$color->ID?>"/>
                <input type="color" name="color" value="#<?=$color->HEX?>" />
                <input type="hidden" name="name" value="<?=$color->Name?>"/>
                <input type="submit" title="Редактировать название" class="edit" value="edit"/>
            </form>
            <form action="<?=$this->Root?>/admin/deletecolor" data-confirm="Вы уверены, что хотите удалить этот цвет? Это может затронуть некоторые товары" method="POST">
                <input type="hidden" name="id" value="<?=$color->ID?>"/>
                <input type="submit" title="Удалить" value="delete_forever"/>
            </form>
        </div>
    </section>
    <?php } ?>
    <form action="<?=$this->Root?>/admin/addcolor" method="POST" class="card add">
        <input type="color-name" name="color-name" placeholder="Название цвета" />
        <input type="color" name="color" />
        <input type="submit" value="Добавить" />
    </form>
</section>