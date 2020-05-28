<section class="auth-form-wrapper">
    <form method="POST" class="auth-form anix">
        <img src="/images/logo-color.svg?v=0" width="100px" />
        <input type="login" name="login" placeholder="Логин" />
        <input type="password" name="password" placeholder="Пароль"/>
        <input data-translate="value" type="submit" value="Войти">
        <?php if(!empty($data['error'])) { ?>
        <div data-translate="content" class="error"><?=$data['error']?></div>
        <?php } ?>
    </form>
</section>