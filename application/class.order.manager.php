<?php
    namespace OrderManager;

    use \DatabaseManager\Database as Database;
    use \ClientManager\Client as Client;
    use \ProductManager\ProductManager as ProductManager;
    use \ProductManager\Product as Product;

    /**
     * Класс менеджера заказов
     */
    class OrderManager {
        protected Database $DB;
        protected ProductManager $ProductManager;
        /**
         * Конструктор менеджера заказов
         * @param Database $DB БД
         * @param ProductManager $ProductManager Менеджер товаров
         */
        public function __construct(Database $DB, ProductManager $ProductManager) {
            $this->DB = $DB;
            $this->ProductManager = $ProductManager;
        }
        /**
         * Метод для создания нового заказа
         * @param int $clientID ID клиента
         * @param int $city ID города
         * @param int $warehouse Номер отделения Новой Почты
         * @param int $totalPrice Общая стоимость
         * @return int ID заказа
         */
        public function NewOrder(int $clientID, int $city, int $warehouse, int $totalPrice) : int {
            $result = $this->DB->call_function('addOrderClient', [$clientID, 1, $city, $warehouse, $totalPrice]);
            return $result != null ? $result : -1;
        }
        /**
         * Метод для получения списка заказов клиента
         * @param Client $client Клиент
         * @return array Список заказов
         */
        public function GetClientOrders(Client $client) : array {
            $orders = [];
            $result = $this->DB->call_procedure('getListOrderClient', [$client->ID], true);

            if($result != null) {
                foreach($result as $item) {
                    $status = $this->DB->call_procedure('getStatus', [$item['IDStatus']]);
                    $orders[] = new Order([
                        'ID' => $item['ID'],
                        'Client' => $client,
                        'Status' => new Status($status),
                        'Date' => new \DateTime($item['Date']),
                        'Warehouse' => $item['Warehouse'],
                        'TotalPrice' => (float)$item['TotalPrice'],
                        'Items' => $this->GetOrderItems($item['ID']),
                        'CityName' => $item['CityName']
                    ]);
                }
            }

            return $orders;
        }
        /**
         * Метод для получения товара
         * @param int $orderID ID заказа
         * @return array Массив элементов
         */
        public function GetOrderItems(int $orderID) : array {
            $items = [];
            $result = $this->DB->call_procedure('getOrderProducts', [$orderID], true);
            if($result != null) {
                foreach($result as $item) {
                    $items[] = new OrderItem([
                        'Product' => $this->ProductManager->GetProduct($item['IDProduct']),
                        'Amount' => $item['AmountProduct'],
                        'Size' => $item['Size'],
                        'ColorName' => $item['ColorName']
                    ]);
                }
            }
            return $items;
        }
    }
?>