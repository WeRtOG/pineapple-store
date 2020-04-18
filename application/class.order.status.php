<?php
    namespace OrderManager;

    /**
     * Класс статуса заказа
     */
    class Status {
        public int $ID;
        public string $Status;

        /**
         * Конструктор статуса заказа
         * @param array $data Массив
         */
        public function __construct(array $data) {
            if(empty($data)) return;
            foreach($data as $key => $value) $this->{$key} = $value;
        }
    }
?>