<?php
    namespace CitiesManager;

    use \DatabaseManager\Database as Database;

    /**
     * Класс менеджера городов
     */
    class CitiesManager {
        protected Database $DB;

        /**
         * Конструктор менеджера клиентов
         * @param Database $DB БД
         */
        public function __construct(Database $DB) {
            $this->DB = $DB;
        }
        /**
         * Метод для получения списка регионов
         * @return array Список регионов
         */
        public function GetRegionList() : array {
            $list = [];
            $result = $this->DB->call_procedure('getRegion', [], true);
            if($result != null) foreach($result as $item) if(!empty($item['Region'])) $list[] = $item['Region'];
            return $list;
        }
        /**
         * Метод для получения списка городов региона
         * @param string $region Регион
         * @return array Список городов
         */
        public function GetRegionCities(string $region) : array {
            $list = [];
            $result = $this->DB->call_procedure('getCities', [$region], true);
            if($result != null) foreach($result as $item) $list[] = $item;
            return $list;
        }
        /**
         * Метод для получения неуникального списка городов
         * @return array Неуникальный список городов
         */
        public function GetAllCities() : array {
           return $this->DB->fetch_query("SELECT * FROM cities", true);
        }
        /**
         * Метод для удаления города
         * @param int $ID ID города
         */
        public function DeleteCity(int $ID) {
            $this->DB->fetch_query("DELETE FROM cities WHERE ID='$ID'");
        }
    }
?>