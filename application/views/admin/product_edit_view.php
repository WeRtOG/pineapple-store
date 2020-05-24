<div class="product-edit">
    <div class="photos">
        <h2>Горизонтальное фото (для карусели): </h2>
        <div class="horizontal-photo">
            <label for="hr-photo-change" style="background-image: url(<?=$data['Product']->Images->HorizontalImage->Path?>)"></label>
            <input type="file" data-id="<?=$data['Product']->ID?>" id="hr-photo-change" />
        </div>
        <h2>Основные фотографии:</h2>
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
            <input type="name" placeholder="Название" name="name" value="<?=$data['Product']->Name?>" />
            <input type="hidden" value="<?=$data['Product']->Year?>" />
            <input type="number" placeholder="Цена" name="price" value="<?=$data['Product']->Price?>" />
            <select name="category">
                <option value="0" disabled>Выберите категорию</option>
                <?php foreach($data['Categories'] as $categories) { ?>
                <option value="<?=$categories->ID?>"<?=$data['Product']->Category->ID == $categories->ID ? ' selected' : ''?>><?=$categories->Name?></option>
                <?php } ?>
            </select>
            <select name="brand">
                <option value="0" disabled>Выберите бренд</option>
                <?php foreach($data['Brands'] as $brand) { ?>
                <option value="<?=$brand->ID?>"<?=$data['Product']->Brand->ID == $brand->ID ? ' selected' : ''?>><?=$brand->Name?></option>
                <?php } ?>
            </select>
            <select name="season">
                <option value="0" disabled>Выберите сезон</option>
                <?php foreach($data['Seasons'] as $season) { ?>
                <option value="<?=$season->ID?>"<?=$data['Product']->Season->ID == $season->ID ? ' selected' : ''?>><?=$season->Name?></option>
                <?php } ?>
            </select>
            <select name="colors[]" multiple>
                <option value="0" disabled>Выберите цвета</option>
                <?php foreach($data['Colors'] as $color) { ?>
                <option value="<?=$color->ID?>"<?=in_array($color, $data['Product']->Colors) ? ' selected' : ''?>><?=$color->Name?></option>
                <?php } ?>
            </select>
            <select name="sizes[]" multiple>
                <option value="0" disabled>Выберите размеры</option>
                <?php foreach($data['Sizes'] as $size) { ?>
                <option value="<?=$size->ID?>"<?=in_array($size, $data['Product']->Sizes) ? ' selected' : ''?>><?=$size->Size?></option>
                <?php } ?>
            </select>
            <textarea name="description" placeholder="Описание"><?=$data['Product']->Description?></textarea>
            <input type="submit" value="Сохранить изменения">
        </div>
    </div>
</div>