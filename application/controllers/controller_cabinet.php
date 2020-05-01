<?php
    /**
     * Контроллер Личного Кабинета
     */
    class Controller_Cabinet extends Controller
    {
        /**
         * Конструктор контроллера Личного Кабинета
         */
        public function __construct()
        {
            global $session_client, $clientMgr, $auth_helper, $orderMgr;

            $this->View = new View();
            $this->SessionClient = $session_client;
            $this->ClientManager = $clientMgr;
            $this->AuthHelper = $auth_helper;
            $this->Root = Route::GetRoot();
            $this->OrderManager = $orderMgr;

            if(!$this->SessionClient->IsAuthorized) Route::Navigate('auth/login');
        }
        /**
         * Экшн коренной страницы
         */
        public function action_index()
        {
            $this->View->Generate('cabinet_view.php', 'Личный кабинет', 'template_view.php', [
                'Client' => $this->SessionClient->Client,
                'Orders' => $this->OrderManager->GetClientOrders($this->SessionClient->Client)
            ]);
        }
        /**
         * Экшн для смены пароля
         */
        public function action_ChangePassword()
        {
            switch($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    Route::Navigate('cabinet');
                    break;
                case 'POST':
                    $Password = $this->AuthHelper->POSTSafeField('password');
                    $this->SessionClient->ChangePassword($Password);
                    Route::Navigate('cabinet');
                    break;
            }
        }
        /**
         * Экшн для смены имени
         */
        public function action_ChangeName()
        {
            switch($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    Route::Navigate('cabinet');
                    break;
                case 'POST':
                    $Name = $this->AuthHelper->POSTSafeField('name');
                    $this->SessionClient->ChangeName($Name);
                    Route::Navigate('cabinet');
                    break;
            }
        }
    }
?>
