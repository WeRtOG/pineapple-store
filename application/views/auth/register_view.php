<section class="auth-form-wrapper anix" data-continue="true" data-fx="zoom" data-speed="300">
    <br><br><br>
    <form class="auth-form" action="<?=$this->Root?>/auth/register" method="post">
        <h1 data-translate="content">Регистрация</h1>
        <input data-translate="placeholder" required type="name" name="name" data-translate="placeholder" placeholder="ФИО"/>
        <input required type="tel" name="phone" placeholder="+380XXXXXXXXX" pattern="\+[0-9]{12}"/>
        <input required minlength="6" type="password" name="password" placeholder="••••••••••••"/>
        <input type="submit" data-translate="value" value="Зарегистрироваться">
        <?php if(!empty($data['error'])) {
        ?>
        <div class="error" data-translate="content">
            <?=$data['error']?>
        </div>
        <?php
        }
        ?>
        <div class="hint">
            <h3 data-translate="content">Уже есть аккаунт?</h3>
            <a data-translate="content" href="<?=$this->Root?>/auth/login">
                Войти
            </a>
        </div>
    </form>
</section>