<?php
    namespace ClientCart;

    require_once 'class.cart.item.php';

    use \DatabaseManager\Database as Database;
    use \ClientManager\Client as Client;
    use \ProductManager\ProductManager as ProductManager;
    use \ProductManager\Product as Product;

    /**
     * Класс корзины пользователя
     */
    class Cart {
        protected Client $Client;
        protected Database $DB;
        protected ProductManager $ProductManager;
        public array $Items = [];

        /**
         * Конструктор класса корзины пользователя
         * @param Client $Client Пользователь (клиент)
         * @param Database $DB БД
         */
        public function __construct(Client $Client, Database $DB, ProductManager $ProductManager) {
            $this->Client = $Client;
            $this->DB = $DB;
            $this->ProductManager = $ProductManager;

            $result = $this->DB->call_procedure('getClientCart', [$Client->ID], true);
            if($result != null) {
                foreach($result as $item) $this->Items[] = new CartItem([
                    'Product' => $this->ProductManager->GetProduct($item['IDProduct']),
                    'Amount' => $item['Amount']
                ]);
            }
        }
        /**
         * Метод для получения кол-ва элементов в корзине
         * @return int Кол-во
         */
        public function GetItemsCount() : int {
            return count($this->Items);
        }
        /**
         * Метод для добавления товара в корзину
         * @param $productID int ID товара
         * @return bool Результат операции
         */
        public function AddItem(int $productID) : bool {
            $this->DB->call_procedure('addProductCart', [$productID, $this->Client->ID]);
            return true;
        }
        /**
         * Метод для удаления товара из корзины
         * @param int $productID ID товара
         * @return bool Результат операции
         */
        public function RemoveItem(int $productID) : bool {
            $this->DB->call_procedure('deleteProductCart', [$productID, $this->Client->ID]);
            return true;
        }
        /**
         * Метод для проверки существует ли товар в корзине
         * @param Product $product Товар
         * @return bool Результат операции
         */
        public function ProductExists(Product $product) : bool {
            foreach($this->Items as $cartItem) {
                if($cartItem->Product->ID == $product->ID) return true;
            }
            return false;
        }
    }
?>