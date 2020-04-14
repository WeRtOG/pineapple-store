<?php
    namespace ClientManager;

    /**
     * Класс менеджера клиентов
     */
    class ClientManager {
        protected object $DB;

        /**
         * Конструктор менеджера клиентов
         * @param object $DB БД
         */
        public function __construct(object $DB) {
            $this->DB = $DB;
        }
        /**
         * Метод для получения клиента по токену
         * @param string $Token Токен
         */
        public function GetClient(string $Token) {
            $q = $this->DB->query("CALL getClient('$Token')");
            if($q) {
                if($q->num_rows == 0) return null;
                $d = $q->fetch_assoc();

                $client = new Client($d);
                $client->Token = $Token;

                $q->free();
                $this->DB->next_result();

                return $client;
            } else {
                return null;
            }
        }
        /**
         * Метод для проверки о существовании клиента
         * @param string $Token Токен
         */
        public function IsClientExists(?string $Token) {
            $q = $this->DB->query("SELECT isClientExists('$Token') AS isClientExists");
            if($q) {
                if($q->num_rows == 0) return false;
                $d = $q->fetch_assoc();

                $q->free();
                $this->DB->next_result();

                return $d['isClientExists'] == 'true';
            } else {
                return false;
            }
        }
        /**
         * Метод для генерации токена
         */
        public function GenerateToken() {
            $q = $this->DB->query("SELECT createToken() AS token");
            if($q) {
                if($q->num_rows == 0) return null;
                $d = $q->fetch_assoc();

                $q->free();
                $this->DB->next_result();

                return $d['token'];
            } else {
                return null;
            }
        }
    }
?>