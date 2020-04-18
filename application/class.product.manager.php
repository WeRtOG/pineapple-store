<?php
    namespace ProductManager;

    use \DatabaseManager\Database as Database;

    /**
     * Класс менеджера товаров
     */
    class ProductManager {
        protected Database $DB;
        /**
         * Конструктор менеджера клиентов
         * @param Database $DB БД
         */
        public function __construct(Database $DB) {
            $this->DB = $DB;
        }
        /**
         * Метод для получения категории по ID
         * @param int $ID ID категории
         * @return Category Категория
         */
        public function GetCategory(int $ID) : ?Category {
            $result = $this->DB->call_procedure('getCategory', [$ID]);
            return $result != null ? new Category($result) : null;
        }
        /**
         * Метод для получения бренда по ID
         * @param int $ID ID бренда
         * @return Brand Бренд
         */
        public function GetBrand(int $ID) : ?Brand {
            $result = $this->DB->call_procedure('getBrand', [$ID]);
            return $result != null ? new Brand($result) : null;
        }
        /**
         * Метод для получения сезона по ID
         * @param int $ID ID сезона
         * @return Season Сезон
         */
        public function GetSeason(int $ID) : ?Season {
            $result = $this->DB->call_procedure('getSeason', [$ID]);
            return $result != null ? new Season($result) : null;
        }
        /**
         * Метод для получения размеров товара по его по ID
         * @param int $ID ID товара
         * @return array Массив размеров
         */
        public function GetProductSizes(int $ID) : array {
            $sizes = [];
            $result = $this->DB->call_procedure('getSizesProduct', [$ID], true);
            
            if($result != null) {
                foreach($result as $item) $sizes[] = new Size($item);
            } else {
                $sizes[] = new Size([
                    'Size' => '1'
                ]);
            }

            return $sizes;
        }
        /**
         * Метод для получения цветов товара по его по ID
         * @param int $ID ID товара
         * @return array Массив цветов
         */
        public function GetProductColors(int $ID) : array {
            $colors = [];
            $result = $this->DB->call_procedure('getColorsProduct', [$ID], true);
            
            if($result != null) {
                foreach($result as $item) $colors[] = new Color($item);
            } else {
                $colors[] = new Color([
                    'HEX' => '000000',
                    'Name' => 'Чёрный'
                ]);
            }
            
            return $colors;
        }
        /**
         * Метод для получения товара из массива
         * @param array $array Массив
         * @return Product Товар
         */
        public function GetProductFromArray(array $array) : ?Product {
            return new Product([
                'ID' => $array['ID'],
                'Name' => $array['Name'],
                'Category' => $this->GetCategory($array['IDCategory']),
                'Brand' => $this->GetBrand($array['IDBrand']),
                'Season' => $this->GetSeason($array['SeasonID']),
                'Colors' => $this->GetProductColors($array['ID']),
                'Sizes' => $this->GetProductSizes($array['ID']),
                'Year' => $array['Year'],
                'Description' => $array['Description'],
                'Price' => $array['Price'],
                'CountSale' => $array['CountSale']
            ]);
        }
        /**
         * Метод для получения Топа Продаж
         * @return array Массив товаров
         */
        public function GetTopSale() : array {
            $top = [];
            $result = $this->DB->call_procedure('topSale');
            foreach($result as $item) $top[] = $this->GetProductFromArray($item);
            return $top;
        }
        /**
         * Метод для получения списка товаров
         * @param int $page Страница
         * @param int $countPerPage Кол-во элементов на страницу
         * @return array Массив товаров
         */
        public function GetProducts(int $page = 1, int $countPerPage = 20) : array {
            $products = [];
            $result = $this->DB->call_procedure('getListProduct', [$page, $countPerPage], true);
            if($result != null) foreach($result as $item) $products[] = $this->GetProductFromArray($item);
            return $products;
        }
        /**
         * Метод для получения товара по его ID
         * @param int $ID ID товара
         * @return Product Товар
         */
        public function GetProduct(int $ID) : ?Product {
            $result = $this->DB->call_procedure('getProductID', [$ID]);
            return $result != null ? $this->GetProductFromArray($result) : null;
        }
        /**
         * Метод для получения кол-ва страниц товаров
         * @param int $countPerPage Кол-во элементов на страницу
         * @return int Кол-во страниц
         */
        public function GetProductsPagesCount(int $countPerPage = 20) : int {
            $result = $this->DB->call_function('getCountPages', [$countPerPage]);
            return is_int((int)$result) ? $result : 0;
        }
    }
?>