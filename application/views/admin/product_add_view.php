<div class="product-edit">
    <div class="main-info">
        <form method="POST" class="main-info-content">
            <input data-translate="placeholder" type="name" placeholder="Название" name="name" value="" />
            <input type="hidden" value="<?=date('Y')?>" />
            <input  data-translate="placeholder" type="number" placeholder="Цена" name="price" value="" />
            <select name="category">
                <option data-translate="content" value="0" disabled>Выберите категорию</option>
                <?php foreach($data['Categories'] as $categories) { ?>
                <option data-translate="content" value="<?=$categories->ID?>"><?=$categories->Name?></option>
                <?php } ?>
            </select>
            <select name="brand">
                <option data-translate="content" value="0" disabled>Выберите бренд</option>
                <?php foreach($data['Brands'] as $brand) { ?>
                <option value="<?=$brand->ID?>"><?=$brand->Name?></option>
                <?php } ?>
            </select>
            <select name="season">
                <option data-translate="content" value="0" disabled>Выберите сезон</option>
                <?php foreach($data['Seasons'] as $season) { ?>
                <option  data-translate="content" value="<?=$season->ID?>"><?=$season->Name?></option>
                <?php } ?>
            </select>
            <select name="colors[]" multiple>
                <option data-translate="content" value="0" disabled>Выберите цвета</option>
                <?php foreach($data['Colors'] as $color) { ?>
                <option data-translate="content" value="<?=$color->ID?>"><?=$color->Name?></option>
                <?php } ?>
            </select>
            <select name="sizes[]" multiple>
                <option data-translate="content" value="0" disabled>Выберите размеры</option>
                <?php foreach($data['Sizes'] as $size) { ?>
                <option value="<?=$size->ID?>"><?=$size->Size?></option>
                <?php } ?>
            </select>
            <textarea data-translate="placejolder" placeholder="Описание" name="description"></textarea>
            <input  data-translate="value" type="submit" value="Создать товар">
        </div>
    </div>
</div>