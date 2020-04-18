<?php
    namespace ProductManager;
    
    /**
     * Класс объекта категории товаров
     */
    class Category {
        public int $ID;
        public int $ParentID;
        public string $Name;
        
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