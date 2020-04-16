<?php
    /**
     * Контроллер авторизации
     */
    class Controller_Auth extends Controller
    {
        /**
         * Конструктор контроллера авторизации
         */
        public function __construct()
        {
            global $session_client, $clientMgr, $auth_helper;

            $this->View = new View();
            $this->SessionClient = $session_client;
            $this->ClientManager = $clientMgr;
            $this->AuthHelper = $auth_helper;
            $this->Root = Route::GetRoot();

            if($this->SessionClient->IsAuthorized) Route::Navigate('cabinet');
        }
        /**
         * Экшн коренной страницы
         */
        public function action_index()
        {
            Route::Navigate('auth/login');
        }
        /**
         * Экшн страницы входа
         */
        public function action_login() 
        {
            switch($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $this->View->Generate('auth/login_view.php', 'Вход', 'template_view.php');
                    break;
                case 'POST':
                    $phone = $this->AuthHelper->POSTSafeField('phone');
                    $password = $this->AuthHelper->POSTSafeField('password');

                    $result = $this->SessionClient->Authorize($phone, $password);

                    switch($result) {
                        case ERROR_USER_NOT_FOUND:
                            $this->View->Generate('auth/login_view.php', 'Вход', 'template_view.php', [
                                'error' => 'Пользователя с таким телефоном не существует.'
                            ]);
                            break;
                        case ERROR_INVALID_PWD:
                            $this->View->Generate('auth/login_view.php', 'Вход', 'template_view.php', [
                                'error' => 'Неверный пароль.'
                            ]);
                            break;
                        case ACTION_SUCCESS:
                            Route::Navigate('cabinet');
                            break;
                    }
                    break;
            }
        }
        /**
         * Экшн страницы регистрации
         */
        public function action_register()
        {
            switch($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $this->View->Generate('auth/register_view.php', 'Регистрация', 'template_view.php');
                    break;
                case 'POST':
                    $phone = $this->AuthHelper->POSTSafeField('phone');
                    $name = $this->AuthHelper->POSTSafeField('name');
                    $password = $this->AuthHelper->POSTSafeField('password');

                    $result = $this->ClientManager->Register($phone, $name, $password, $this->SessionClient->Client->Token);

                    switch($result) {
                        case ERROR_FIELD_EMPTY_DATA:
                            $this->View->Generate('auth/register_view.php', 'Регистрация', 'template_view.php', [
                                'error' => 'Не все поля заполнены.'
                            ]);
                            break;
                        case ERROR_USER_ALREADY_EXISTS:
                            $this->View->Generate('auth/register_view.php', 'Регистрация', 'template_view.php', [
                                'error' => 'Пользователь с такими данными уже существует.'
                            ]);
                            break;
                        case ACTION_SUCCESS:
                            Route::Navigate('cabinet');
                            break;
                    }
                    break;
            }
        }
        /**
         * Экшн выхода из аккаунта
         */
        public function action_logout()
        {
            $this->SessionClient->Logout();
            Route::Navigate('auth/login');
        }
    }
?>
