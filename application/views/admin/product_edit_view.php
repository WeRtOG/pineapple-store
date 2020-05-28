<div class="product-edit">
    <div class="photos">
        <h2 data-translate="content">Горизонтальное фото (для карусели): </h2>
        <div class="horizontal-photo">
            <label for="hr-photo-change" style="background-image: url(<?=$data['Product']->Images->HorizontalImage->Path?>)"></label>
            <input type="file" data-id="<?=$data['Product']->ID?>" id="hr-photo-change" />
        </div>
        <h2 data-translate="content">Основные фотографии:</h2>
        <div class="photos-list">
            <div class="main-photos">
                <?php foreach($data['Product']->Images->ImagesList as $image) { ?>
                <?php if($image->AbsolutePath != '/images/product-default.svg') { ?>
                <div class="photo" data-id="<?=$data['Product']->ID?>" data-filename="<?=$image->Filename?>" style="background-image: url(<?=$image->Path?>)"></div>
                <?php } ?>
                <?php } ?>
            </div>
            <label for="add-photo" class="add-photo"></label>
            <input type="file" data-id="<?=$data['Product']->ID?>" id="add-photo" />
        </div>
    </div>
    <div class="main-info">
        <form method="POST" class="main-info-content">
<<<<<<< HEAD
            <input data-translate="placeholder" type="name" placeholder="Название" name="name" value="<?=$data['Product']->Name?>" />
            <input type="hidden" value="<?=$data['Product']->Year?>" />
            <input data-translate="placeholder" type="number" placeholder="Цена" name="price" value="<?=$data['Product']->Price?>" />
=======
            <input type="name" placeholder="Название" name="name" value="<?=$data['Product']->Name?>" />
            <input type="hidden" value="<?=$data['Product']->Year?>" />
            <input type="number" placeholder="Цена" name="price" value="<?=$data['Product']->Price?>" />
>>>>>>> 6169aaac5d1801f27f10644b5a017c941a367f9c
            <select name="category">
                <option data-translate="content" value="0" disabled>Выберите категорию</option>
                <?php foreach($data['Categories'] as $categories) { ?>
                <option data-translate="content" value="<?=$categories->ID?>"<?=$data['Product']->Category->ID == $categories->ID ? ' selected' : ''?>><?=$categories->Name?></option>
                <?php } ?>
            </select>
            <select name="brand">
                <option data-translate="content" value="0" disabled>Выберите бренд</option>
                <?php foreach($data['Brands'] as $brand) { ?>
                <option value="<?=$brand->ID?>"<?=$data['Product']->Brand->ID == $brand->ID ? ' selected' : ''?>><?=$brand->Name?></option>
                <?php } ?>
            </select>
            <select name="season">
                <option data-translate="content" value="0" disabled>Выберите сезон</option>
                <?php foreach($data['Seasons'] as $season) { ?>
                <option data-translate="content" value="<?=$season->ID?>"<?=$data['Product']->Season->ID == $season->ID ? ' selected' : ''?>><?=$season->Name?></option>
                <?php } ?>
            </select>
            <select name="colors[]" multiple>
                <option data-translate="content" value="0" disabled>Выберите цвета</option>
                <?php foreach($data['Colors'] as $color) { ?>
                <option data-translate="content" value="<?=$color->ID?>"<?=in_array($color, $data['Product']->Colors) ? ' selected' : ''?>><?=$color->Name?></option>
                <?php } ?>
            </select>
            <select name="sizes[]" multiple>
                <option data-translate="content" value="0" disabled>Выберите размеры</option>
                <?php foreach($data['Sizes'] as $size) { ?>
                <option value="<?=$size->ID?>"<?=in_array($size, $data['Product']->Sizes) ? ' selected' : ''?>><?=$size->Size?></option>
                <?php } ?>
            </select>
            <textarea data-translate="placeholder" name="description" placeholder="Описание"><?=$data['Product']->Description?></textarea>
            <input data-translate="value" type="submit" value="Сохранить изменения">
        </div>
    </div>
</div>