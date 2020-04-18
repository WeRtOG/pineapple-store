<?php
    namespace ProductManager;
    
    /**
     * Класс объекта цвета товара
     */
    class Color {
        public int $ID;
        public string $HEX;
        public string $Name;

        /**
         * Конструктор объекта цвета товара
         * @param array $data Массив
         */
        public function __construct(array $data) {
            if(empty($data)) return;
            foreach($data as $key => $value) $this->{$key} = $value;
        }
    }
?>