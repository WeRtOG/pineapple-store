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
            foreach($data as $key => $value) {
                if($key == 'DateFrom' || $key == 'DateTo') {
                    $this->{$key} = new \DateTime($value);
                } else {
                    $this->{$key} = $value;
                }
            }
        }
    }
?>