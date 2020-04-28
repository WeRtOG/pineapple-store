<section class="brands">
    <?php foreach($data['Brands'] as $brand) { ?>
    <section class="brand">
        <h1 class="name"><?=$brand->Name?></h1>
        <div class="actions">
            <form action="<?=$this->Root?>/admin/editbrand" class="edit" method="POST">
                <input type="hidden" name="id" value="<?=$brand->ID?>"/>
                <input type="hidden" name="name" value="<?=$brand->Name?>"/>
                <input type="submit" value="edit"/>
            </form>
            <form action="<?=$this->Root?>/admin/deletebrand" data-confirm="Вы уверены, что хотите удалить этот бренд? Удаление бренда может затронуть некоторые товары" method="POST">
                <input type="hidden" name="id" value="<?=$brand->ID?>"/>
                <input type="submit" value="delete_forever"/>
            </form>
        </div>
    </section>
    <?php } ?>
    <form action="<?=$this->Root?>/admin/addbrand" method="POST" class="brand add">
        <input type="brand" name="brand" placeholder="Название бренда" />
        <input type="submit" value="Добавить" />
    </form>
</section>