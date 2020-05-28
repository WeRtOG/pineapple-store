<section class="cards">
    <?php foreach($data['Sizes'] as $size) { ?>
    <section class="card">
        <h1 class="name"><?=$size->Size?></h1>
        <div class="actions">
            <form action="<?=$this->Root?>/admin/editsize"  method="POST">
                <input type="hidden" name="id" value="<?=$size->ID?>"/>
                <input type="hidden" name="name" value="<?=$size->Size?>"/>
                <input data-translate="title" type="submit" title="Редактировать" class="edit" value="edit"/>
            </form>
            <form data-translate="confirm" action="<?=$this->Root?>/admin/deletesize" data-confirm="Вы уверены, что хотите удалить этот размер?" method="POST">
                <input type="hidden" name="id" value="<?=$size->ID?>"/>
                <input data-translate="title" type="submit" title="Удалить" value="delete_forever"/>
            </form>
        </div>
    </section>
    <?php } ?>
    <form action="<?=$this->Root?>/admin/addsize" method="POST" class="card add">
        <input data-translate="placeholder" data-translate="placeholder" type="size" name="size" placeholder="Размер" />
        <input data-translate="value" type="submit" value="Добавить" />
    </form>
</section>