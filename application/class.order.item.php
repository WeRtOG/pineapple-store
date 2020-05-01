<?php
    namespace OrderManager;

    use ProductManager\Product as Product;

    /**
     * Класс элемента заказа
     */
    class OrderItem {
        public Product $Product;
        public string $Amount;
        public ?string $Size;
        public ?string $ColorName;
        /**
         * Конструктор элемента заказа
         * @param array Массив данных
         */
        public function __construct(array $data) {
            if(empty($data)) return;
            foreach($data as $key => $value) $this->{$key} = $value;
        }
    }
?>