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
         * @return string Фильтрованная строка
         */
        public function POSTSafeField(string $name) : string {
            if(array_key_exists($name, $_POST)) {
                return $this->DB->escape(strip_tags($_POST[$name]));
            } else {
                return '';
            }
        }
        /**
         * Метод для безопасного получения GET-переменной
         * @param string $name Имя
         * @return string Фильтрованная строка
         */
        public function GETSafeField(string $name) : string {
            if(array_key_exists($name, $_GET)) {
                return $this->DB->escape(strip_tags($_GET[$name]));
            } else {
                return '';
            }
        }
        /**
         * Метод для шифрования пароля
         * @param string $password Нешифрованный пароль
         * @return string Шифрованный пароль
         */
        public static function EncryptPassword(string $password) : string {
            return sha1(strrev(md5($password)));
        }
    }
?>