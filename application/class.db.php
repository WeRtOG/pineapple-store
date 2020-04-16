<?php
    namespace DatabaseManager;

    /**
     * Класс взаимодействия с БД
     */
    class Database {
        protected object $DB;

        /**
         * Конструктор класса взаимодействия с БД
         * @param string $server Сервер
         * @param string $login Логин
         * @param string $password Пароль
         * @param string $db БД
         */
        public function __construct(string $server, string $login, string $password, string $db) {
            $this->DB = new \mysqli($server, $login, $password, $db);
        }
        /**
         * Метод для выполнения SQL-запроса
         * @param string $query Запрос
         */
        public function fetch_query(string $query) {
            $q = $this->DB->query($query);
            if($q) {
                if($q->num_rows > 0) {
                    $d = $q->fetch_assoc();

                    if($q->num_rows == 1) {
                        $q->free();
                        $this->DB->next_result();
                        return $d;
                    } else if($q->num_rows > 1) {
                        $result = [];
                        do {
                            $result[] = $d;
                            $q->free();
                            $this->DB->next_result();
                        }
                        while($d = $q->fetch_assoc());
                        return $result;
                    }
                } else {
                    return null;
                }
            } else {
                echo $this->DB->error;
                return null;
            }
        }
        /**
         * Метод для вызова хранимой процедуры
         * @param string $name Имя процедуры
         * @param array $parameters Массив значений параметров
         */
        public function call_procedure(string $name, array $parameters = []) {
            $parameters_string = count($parameters) > 0 ? "'" . implode("', '", $parameters) . "'" : "";
            return $this->fetch_query("CALL $name($parameters_string)");
        }
        /**
         * Метод для вызова хранимой функции
         * @param string $name Имя процедуры
         * @param array $parameters Массив значений параметров
         */
        public function call_function(string $name, array $parameters = []) {
            $parameters_string = count($parameters) > 0 ? "'" . implode("', '", $parameters) . "'" : "";
            return $this->fetch_query("SELECT $name($parameters_string) AS $name")[$name];
        }
        /**
         * Метод для получения безопасной строки (защита от SQL-инъекций)
         * @param $string Строка
         */
        public function escape(string $string) {
            return $this->DB->real_escape_string($string);
        }
    }
?>