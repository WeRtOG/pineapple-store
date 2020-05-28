<section class="cards">
    <?php foreach($data['Brands'] as $brand) { ?>
    <section class="card">
        <h1 class="name"><?=$brand->Name?></h1>
        <div class="actions">
            <form action="<?=$this->Root?>/admin/editbrand" method="POST">
                <input type="hidden" name="id" value="<?=$brand->ID?>"/>
                <input type="hidden" name="name" value="<?=$brand->Name?>"/>
                <input data-translate="title" title="Редактировать" type="submit" class="edit" value="edit"/>
            </form>
            <form data-translate="confirm" action="<?=$this->Root?>/admin/deletebrand" data-confirm="Вы уверены, что хотите удалить этот бренд? Удаление бренда может затронуть некоторые товары" method="POST">
                <input type="hidden" name="id" value="<?=$brand->ID?>"/>
                <input data-translate="title" title="Удалить" type="submit" value="delete_forever"/>
            </form>
        </div>
    </section>
    <?php } ?>
    <form action="<?=$this->Root?>/admin/addbrand" method="POST" class="card add">
        <input data-translate="placeholder" type="brand" name="brand" placeholder="Название бренда" />
        <input data-translate="value" type="submit" value="Добавить" />
    </form>
</section>