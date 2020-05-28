<?php
    namespace OrderManager;

    use \DatabaseManager\Database as Database;
    use \ClientManager\Client as Client;
    use \ClientManager\ClientManager as ClientManager;
    use \ProductManager\ProductManager as ProductManager;
    use \ProductManager\Product as Product;

    /**
     * Класс менеджера заказов
     */
    class OrderManager {
        protected Database $DB;
        protected ProductManager $ProductManager;
        protected ClientManager $ClientManager;
        /**
         * Конструктор менеджера заказов
         * @param Database $DB БД
         * @param ProductManager $ProductManager Менеджер товаров
         * @param ClientManger $ClientManager Менеджер клиентов
         */
        public function __construct(Database $DB, ProductManager $ProductManager, ClientManager $ClientManager) {
            $this->DB = $DB;
            $this->ProductManager = $ProductManager;
            $this->ClientManager = $ClientManager;
        }
        /**
         * Метод для создания нового заказа
         * @param int $clientID ID клиента
         * @param int $city ID города
         * @param int $warehouse Номер отделения Новой Почты
         * @param int $totalPrice Общая стоимость
         * @return int ID заказа
         */
        public function NewOrder(int $clientID, int $city, int $warehouse, int $totalPrice, int $paytype) : int {
            $paytypes = [
                'Оплата картой',
                'Наложенный платёж'
            ];
            $paytype_name = $paytypes[$paytype];
            $result = $this->DB->call_function('addOrderClient', [$clientID, 1, $city, $warehouse, $totalPrice, $paytype_name]);
            return $result != null ? $result : -1;
        }
        /**
         * Метод для получения объекта заказа из массива
         * @param array $item Массив
         * @return Order Объект заказа
         */
        public function OrderFromArray(array $item) : Order {
            $status = $this->DB->call_procedure('getStatus', [$item['IDStatus']]);
            return new Order([
                'ID' => $item['ID'],
                'Client' => $this->ClientManager->GetClientByID($item['IDClient']),
                'Status' => new Status($status),
                'Date' => new \DateTime($item['Date']),
                'Warehouse' => $item['Warehouse'],
                'TotalPrice' => (float)$item['TotalPrice'],
                'Items' => $this->GetOrderItems($item['ID']),
                'CityName' => $item['CityName'],
                'PaymentType' => empty($item['PaymentType']) ? 'Неизвестен' : $item['PaymentType']
            ]);
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
                    $orders[] = $this->OrderFromArray($item);
                }
            }

            return $orders;
        }
        /**
         * Метод для получения списка заказов (для админки)
         * @param int $page Страница
         * @param int $countPerPage Кол-во элементов на страницу
         * @return array Список заказов
         */
        public function GetOrders(int $page = 1, int $countPerPage = 20) : array {
            $orders = [];
            $result = $this->DB->call_procedure('getOrder', [$countPerPage, $page], true);

            if($result != null) {
                foreach($result as $item) {
                    $orders[] = $this->OrderFromArray($item);
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
        /**
         * Метод для получения кол-ва страниц заказов (для админки)
         * @param int $countPerPage Кол-во элементов на страницу
         * @return int Кол-во страниц
         */
        public function GetOrdersPagesCount(int $countPerPage = 20) : int {
            $result = $this->DB->call_function('getCountPagesOrder', [$countPerPage]);
            return is_int((int)$result) ? $result : 0;
        }
        /**
         * Метод для получения списка статусов
         * @return array Список статусов
         */
        public function GetStatuses() : array {
            $statuses = [];
            $result = $this->DB->call_procedure('getStatuses', [], true);

            if($result != null) {
                foreach($result as $item) {
                    $statuses[] = new Status($item);
                }
            }

            return $statuses;
        }
        /**
         * Метод для изменения статуса заказа
         * @param int $ID ID заказа
         * @param int $Status Статус заказа
         * @return bool Результат операции
         */
        public function ChangeOrderStatus(int $ID, int $Status) : bool {
            $this->DB->call_procedure('updateStatusOrder', [$Status, $ID]);
            return true;
        }
    }
?>