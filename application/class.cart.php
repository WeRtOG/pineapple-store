<?php
    namespace ClientCart;

    use \DatabaseManager\Database as Database;
    use \ClientManager\Client as Client;

    /**
     * Класс корзины пользователя
     */
    class Cart {
        public Client $Client;
        public Database $DB;

        /**
         * Конструктор класса корзины пользователя
         * @param Client $Client Пользователь (клиент)
         * @param Database $DB БД
         */
        public function __construct(Client $Client, Database $DB) {
            $this->Client = $Client;
            $this->DB = $DB;
        }
        /**
         * Метод для получения кол-ва элементов в корзине
         * @return int Кол-во
         */
        public function GetItemsCount() {
            return 0;
        }
    }
?>