<?php
    namespace ClientManager;

    /**
     * Класс клиента сессии
     */
    class SessionClient {
        protected string $SessionName;
        protected ClientManager $Manager;
        public ?Client $Client;
        public bool $IsAuthorized = false;

        /**
         * Конструктор класса клиента сессии
         * @param string $SessionName Имя сессии
         * @param ClientManager $Manager Менеджер клиентов
         */
        public function __construct(string $SessionName, ClientManager $Manager) {
            $this->SessionName = $SessionName;
            $this->Manager = $Manager;
            $this->StartSession();
        }
        /**
         * Метод для запуска сессии
         */
        public function StartSession() {
            $SessionToken = '';

            session_start();
            
            if(array_key_exists($this->SessionName, $_SESSION)) {
                $SessionToken = $_SESSION[$this->SessionName];
            }
            
            if(!$this->Manager->IsClientExists($SessionToken)) {
                $SessionToken = $this->Manager->GenerateToken();
                $_SESSION[$this->SessionName] = $SessionToken;
            }

            $this->Client = $this->Manager->GetClient($SessionToken);
            if(!empty($this->Client->Phone) && !empty($this->Client->Password)) $this -> IsAuthorized = true;

            print_r($this->Client);
            exit();
        }
    }
?>