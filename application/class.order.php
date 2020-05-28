<?php
    namespace OrderManager;

    require_once 'class.order.item.php';
    require_once 'class.order.manager.php';
    require_once 'class.order.status.php';

    use ClientManager\Client as Client;
    
    /**
     * Класс объекта заказа
     */
    class Order {
        public int $ID;
        public Client $Client;
        public Status $Status;
        public \DateTime $Date;
        public string $Warehouse;
        public float $TotalPrice;
        public string $CityName;
        public string $PaymentType = 'Неизвестно';

        /**
         * Конструктор объекта заказа
         * @param array $data Массив
         */
        public function __construct(array $data) {
            if(empty($data)) return;
            foreach($data as $key => $value) $this->{$key} = $value;
        }
    }
?>