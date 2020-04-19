<?php
    namespace ProductManager;

    /**
     * Класс объекта сезона
     */
    class Season {
        public int $ID;
        public string $Name;
        public \DateTime $DateFrom;
        public \DateTime $DateTo;

        /**
         * Конструктор объекта товара
         * @param array $data Массив
         */
        public function __construct(array $data) {
            if(empty($data)) return;
            foreach($data as $key => $value) $this->{$key} = $value;
        }
    }
?>