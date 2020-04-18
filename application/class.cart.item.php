<?php
    namespace ClientCart;

    use ProductManager\Product as Product;

    /**
     * Класс элемента корзины
     */
    class CartItem {
        public Product $Product;
        public string $Ammount;
        /**
         * Конструктор элемента корзины
         * @param int $client_id ID клиента
         */
        public function __construct(array $data) {
            if(empty($data)) return;
            foreach($data as $key => $value) $this->{$key} = $value;
        }
    }
?>