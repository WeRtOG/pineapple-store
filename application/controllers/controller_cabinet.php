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
            global $session_client, $clientMgr, $auth_helper;

            $this->View = new View();
            $this->SessionClient = $session_client;
            $this->ClientManager = $clientMgr;
            $this->AuthHelper = $auth_helper;
            $this->Root = Route::GetRoot();

            if(!$this->SessionClient->IsAuthorized) Route::Navigate('auth/login');
        }
        /**
         * Экшн коренной страницы
         */
        public function action_index()
        {
            $this->View->Generate('cabinet_view.php', 'Личный кабинет', 'template_view.php', [
                'Client' => $this->SessionClient->Client
            ]);
        }
    }
?>
