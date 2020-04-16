<?php
    $avatar = $data['Client']->Avatar;
?>
<section class="cabinet">
    <section class="sidebar">
        <div class="user-info">
            <label for="AvatarUpload" class="avatar<?=$avatar->IsDefault ? ' default' : ''?>" style="background-image: url(<?=$avatar->Image->Path?>)"></label>
            <h2><?=$data['Client']->Name?></h2>
            <input type="file" accept="image/*" id="AvatarUpload"/>
        </div>
        <div class="actions">
            <a class="logout" href="<?=$this->Root?>/auth/logout">Выйти</a>
        </div>
    </section>
    <section class="content">

    </section>
</section>