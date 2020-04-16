<section class="auth-form-wrapper anix" data-continue="true" data-fx="zoom" data-speed="300">
    <br><br><br>
    <form class="auth-form" action="<?=$this->Root?>/auth/register" method="post">
        <h1>Регистрация</h1>
        <input required type="name" name="name" placeholder="Имя"/>
        <input required type="tel" name="phone" placeholder="+380XXXXXXXXX" pattern="\+[0-9]{12}"/>
        <input required minlength="6" type="password" name="password" placeholder="••••••••••••"/>
        <input type="submit" value="Зарегистрироваться">
        <?php if(!empty($data['error'])) {
        ?>
        <div class="error">
            <?=$data['error']?>
        </div>
        <?php
        }
        ?>
        <div class="hint">
            <h3>Уже есть аккаунт?</h3>
            <a href="<?=$this->Root?>/auth/login">
                Войти
            </a>
        </div>
    </form>
</section>