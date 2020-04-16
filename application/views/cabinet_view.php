<?php
    $avatar = $data['Client']->Avatar;
?>
<section class="cabinet anix" data-continue="true">
    <section class="sidebar">
        <div class="user-info">
            <label for="AvatarUpload" class="avatar<?=$avatar->IsDefault ? ' default' : ''?>" style="background-image: url(<?=$avatar->Image->Path?>)"></label>
            <h2><?=$data['Client']->Name?></h2>
            <input type="file" accept="image/*" id="AvatarUpload"/>
        </div>
        <div class="actions">
            <h3 class="changename">Изменить имя</h3>
            <h3 class="changepassword">Изменить пароль</h3>
            <a class="logout" href="<?=$this->Root?>/auth/logout">
                <span>Выйти</span>
                <span class="material-icons">
                    exit_to_app
                </span>
            </a>
        </div>
    </section>
    <section class="content">

    </section>
</section>
<section class="modal-wrapper changename hidden">
    <section class="modal">
        <button class="close">
            <span class="material-icons">
                close
            </span>
        </button>
        <form action="<?=$this->Root?>/cabinet/ChangeName" method="POST">
            <input required type="name" name="name" placeholder="Новое имя"/>
            <input type="submit" value="Изменить"/>
        </form>
    </section>
</section>
<section class="modal-wrapper changepassword hidden">
    <section class="modal">
        <button class="close">
            <span class="material-icons">
                close
            </span>
        </button>
        <form action="<?=$this->Root?>/cabinet/ChangePassword" method="POST">
            <input required minlength="6" name="password" type="password" placeholder="Новый пароль"/>
            <input type="submit" value="Изменить"/>
        </form>
    </section>
</section>