<section class="auth-form-wrapper anix" data-continue="true" data-fx="zoom" data-speed="300">
    <form class="auth-form" action="<?=$this->Root?>/auth/login" method="post">
        <h1 data-translate="content">Вход</h1>
        <input required type="tel" name="phone" placeholder="+380XXXXXXXXX" pattern="\+[0-9]{12}"/>
        <input required minlength="6" type="password" name="password" placeholder="••••••••••••"/>
        <input type="submit" data-translate="value" value="Войти">
        <?php if(!empty($data['error'])) { ?>
        <div class="error" data-translate="content">
            <?=$data['error']?>
        </div>
        <?php } ?>
        <div class="hint">
            <h3 data-translate="content">Нет учётной записи?</h3>
            <a data-translate="content" href="<?=$this->Root?>/auth/register">
                Создать аккаунт
            </a>
        </div>
    </form>
</section>