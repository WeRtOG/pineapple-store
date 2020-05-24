<div class="product-edit">
    <div class="main-info">
        <form method="POST" class="main-info-content">
            <input type="name" placeholder="Название" name="name" value="" />
            <input type="hidden" value="<?=date('Y')?>" />
            <input type="number" placeholder="Цена" name="price" value="" />
            <select name="category">
                <option value="0" disabled>Выберите категорию</option>
                <?php foreach($data['Categories'] as $categories) { ?>
                <option value="<?=$categories->ID?>"><?=$categories->Name?></option>
                <?php } ?>
            </select>
            <select name="brand">
                <option value="0" disabled>Выберите бренд</option>
                <?php foreach($data['Brands'] as $brand) { ?>
                <option value="<?=$brand->ID?>"><?=$brand->Name?></option>
                <?php } ?>
            </select>
            <select name="season">
                <option value="0" disabled>Выберите сезон</option>
                <?php foreach($data['Seasons'] as $season) { ?>
                <option value="<?=$season->ID?>"><?=$season->Name?></option>
                <?php } ?>
            </select>
            <select name="colors[]" multiple>
                <option value="0" disabled>Выберите цвета</option>
                <?php foreach($data['Colors'] as $color) { ?>
                <option value="<?=$color->ID?>"><?=$color->Name?></option>
                <?php } ?>
            </select>
            <select name="sizes[]" multiple>
                <option value="0" disabled>Выберите размеры</option>
                <?php foreach($data['Sizes'] as $size) { ?>
                <option value="<?=$size->ID?>"><?=$size->Size?></option>
                <?php } ?>
            </select>
            <textarea placeholder="Описание" name="description"></textarea>
            <input type="submit" value="Создать товар">
        </div>
    </div>
</div>