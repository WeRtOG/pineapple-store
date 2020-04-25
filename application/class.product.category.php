<?php
    namespace ProductManager;
    
    /**
     * Класс объекта категории товаров
     */
    class Category {
        public int $ID;
        public int $IDCategory;
        public string $Name;
        public array $SubCategories = [];
        
        /**
         * Конструктор объекта категории товаров
         * @param array $data Массив
         */
        public function __construct(array $data) {
            if(empty($data)) return;
            foreach($data as $key => $value) $this->{$key} = $value;
        }
    }
?>