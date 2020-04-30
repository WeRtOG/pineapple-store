<section class="cards">
    <?php foreach($data['Seasons'] as $season) { ?>
    <section class="card">
        <h1 class="name"><?=$season->Name?></h1>
        <div class="actions">
            <form action="<?=$this->Root?>/admin/editseason" method="POST">
                <input type="hidden" name="id" value="<?=$season->ID?>"/>
                <input type="date" name="dateFrom" value="<?=$season->DateFrom->format('Y-m-d')?>" />
                <input type="date" name="dateTo" value="<?=$season->DateTo->format('Y-m-d')?>" />
                <input type="hidden" name="name" value="<?=$season->Name?>"/>
                <input type="submit" title="Редактировать название" class="edit" value="edit"/>
            </form>
            <form action="<?=$this->Root?>/admin/deleteseason" data-confirm="Вы уверены, что хотите удалить этот сезон? Это может затронуть некоторые товары" method="POST">
                <input type="hidden" name="id" value="<?=$season->ID?>"/>
                <input type="submit" title="Удалить" value="delete_forever"/>
            </form>
        </div>
    </section>
    <?php } ?>
    <form action="<?=$this->Root?>/admin/addseason" method="POST" class="card add">
        <input type="season" name="season" placeholder="Название сезона" />
        <input type="date" name="dateFrom" />
        <input type="date" name="dateTo" />
        <input type="submit" value="Добавить" />
    </form>
</section>