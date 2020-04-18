<div class="product-info anix">
<?php if(!empty($data['Product'])) { ?>
    <div class="zoom-contatiner">
        <div class="piclist">
            <?php foreach($data['Product']->Images->ImagesList as $i => $image) { ?>
            <div class="pic<?=$i == 0 ? ' active' : ''?>" style="background-image: url(<?=$image->Path?>);"></div>
            <?php } ?>
        </div>
        <div class="picZoomer">
            <div class="rt" style="background-image: url(<?=$data['Product']->Images->ImagesList[0]->Path?>);">
            </div>
        </div>
    </div>
    <div class="info">
        <h1><?=$data['Product']->Title?></h1>
        <h2 class="category"><?=$data['Product']->Category->Name?></h2>
        <h3>Выберите размер:</h3>
        <div class="size-select">
            <?php foreach($data['Product']->Sizes as $i => $size) { ?>
            <input type="radio" name="SizeSelect" id="SizeSelect-<?=$i?>"<?=$i == 0 ? ' checked' : ''?>>
            <label for="SizeSelect-<?=$i?>"><?=$size->Size?></label>
            <?php } ?>
        </div>
        <h3>Выберите цвет:</h3>
        <div class="color-select">
            <?php foreach($data['Product']->Colors as $i => $color) { ?>
            <input type="radio" name="ColorSelect" id="ColorSelect-<?=$i?>"<?=$i == 0 ? ' checked' : ''?>>
            <label for="ColorSelect-<?=$i?>" style="background-color: #<?=$color->HEX?>" title="<?=$color->Name?>"></label>
            <?php } ?>
        </div>
        <div class="description">
            <p><?=$data['Product']->Description?></p>
        </div>
    </div>
    <div class="add-to-cart">
        <h1><?=number_format($data['Product']->Price, 0, ',', ' ')?> ₴</h1>
        <button>
            <p>
                <span class="material-icons">
                    add_shopping_cart
                </span>
                <span>В корзину</span>
            </p>
        </button>
    </div>
    <?php } else { ?>
    <h1 class="not-found"><span>Товар не найден.</span></h1>
    <?php } ?>
</div>