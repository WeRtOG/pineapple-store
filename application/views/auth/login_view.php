<section class="auth-form-wrapper anix" data-continue="true" data-fx="zoom">
    <form class="auth-form" action="<?=$this->Root?>/auth/login" method="post">
        <h1>Вход</h1>
        <input required type="tel" name="phone" placeholder="+380XXXXXXXXX" pattern="+[0-9]{12}"/>
        <input required minlength="6" type="password" name="password" placeholder="••••••••••••"/>
        <input type="submit" value="Войти">
        <?php if(!empty($data['error'])) { ?>
        <div class="error">
            <?=$data['error']?>
        </div>
        <?php } ?>
        <div class="hint">
            <h3>Нет учётной записи?</h3>
            <a href="<?=$this->Root?>/auth/register">
                Создать аккаунт
            </a>
        </div>
    </form>
</section>