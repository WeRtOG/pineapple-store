<?php
    namespace ProductManager;

    /**
     * Класс объекта бренда
     */
    class Brand {
        public int $ID;
        public string $Name;

        /**
         * Конструктор объекта бренда
         * @param array $data Массив
         */
        public function __construct(array $data) {
            if(empty($data)) return;
            foreach($data as $key => $value) $this->{$key} = $value;
        }
    }
?>