<?php
    namespace Admin;

    /**
     * Класс авторизации админки
     */
    class Auth {
        private string $Username = 'admin';
        private string $Password = '2ePD8NkPGdgH59Wr';
        private string $SessionName;
        public bool $IsAuthorized = false;

        /**
         * Конструктор класса авторизации админки
         * @param string $SessionName Имя ключа сессии
         */
        public function __construct(string $SessionName) {
            $this->SessionName = $SessionName;

            if(array_key_exists($this->SessionName, $_SESSION)) {
                if($_SESSION[$this->SessionName] == $this->Username) {
                    $this->IsAuthorized = true;
                }
            }
        }
        /**
         * Метод для выполнения входа
         * @param string $Username Имя пользователя
         * @param string $Password Пароль
         * @return int Результат операции
         */
        public function DoLogin(string $Username, string $Password) : int {
            if($this->Username == $Username && $this->Password == $Password) {
                $_SESSION[$this->SessionName] = $this->Username;
                return ACTION_SUCCESS;
            } else {
                return ERROR_INVALID_PWD;
            }
        }
        /**
         * Метод для выполнения выхода
         */
        public function DoLogout() {
            $_SESSION[$this->SessionName] = '';
        }

    }
?>