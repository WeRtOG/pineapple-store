<?php
    namespace ClientManager;

    use \DatabaseManager\Database as Database;

    /**
     * Класс хелперов для авторизации
     */
    class AuthHelper {
        public object $DB;

        /**
         * Конструктор объекта хелпера авторизации
         * @param object $db БД
         */
        public function __construct(object $db) {
            $this->DB = $db;
        }
        /**
         * Метод для безопасного получения POST-переменной
         * @param string $name Имя
         */
        public function POSTSafeField(string $name) {
            if(array_key_exists($name, $_POST)) {
                return $this->DB->escape(strip_tags($_POST[$name]));
            } else {
                return '';
            }
        }
        /**
         * Метод для безопасного получения GET-переменной
         * @param string $name Имя
         */
        public function GETSafeField($name) {
            if(array_key_exists($name, $_GET)) {
                return $this->DB->escape(strip_tags($_GET[$name]));
            } else {
                return '';
            }
        }
    }
?>