<section class="sizes">
    <?php foreach($data['Sizes'] as $size) { ?>
    <section class="size">
        <h1 class="name"><?=$size->Size?></h1>
        <div class="actions">
            <form action="<?=$this->Root?>/admin/editsize" class="edit" method="POST">
                <input type="hidden" name="id" value="<?=$size->ID?>"/>
                <input type="hidden" name="name" value="<?=$size->Size?>"/>
                <input type="submit" value="edit"/>
            </form>
            <form action="<?=$this->Root?>/admin/deletesize" data-confirm="Вы уверены, что хотите удалить этот размер?" method="POST">
                <input type="hidden" name="id" value="<?=$size->ID?>"/>
                <input type="submit" value="delete_forever"/>
            </form>
        </div>
    </section>
    <?php } ?>
    <form action="<?=$this->Root?>/admin/addsize" method="POST" class="size add">
        <input type="size" name="size" placeholder="Размер" />
        <input type="submit" value="Добавить" />
    </form>
</section>