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
         * Метод для создания категории
         * @param string $Name Название категории
         * @param int $ParentID ID родительской категории
         * @return bool Результат операции
         */
        public function CreateCategory(string $Name, int $ParentID = 0) : bool {
            if($ParentID == 0) {
                $this->DB->call_procedure('addCategory', [$Name]);
            } else {
                $this->DB->call_procedure('addSubcategory', [$ParentID, $Name]);
            }

            return true;
        }
        /**
         * Метод для редактирования категории
         * @param int $ID ID категории
         * @param string $NewName Новое название
         * @return bool Результат операции
         */
        public function EditCategory(int $ID, string $NewName) : bool {
            $this->DB->call_procedure('updateCategory', [$ID, $NewName]);
            return true;
        }
        /**
         * Метод для удаления категории
         * @param int $ID ID категории
         * @return bool Результат операции
         */
        public function DeleteCategory(int $ID) : bool {
            $this->DB->call_procedure('deleteCategory', [$ID]);
            return true;
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
         * Метод для добавления бренда
         * @param string $brand Название бренда
         * @return bool Результат операции
         */
        public function AddBrand(string $brand) : bool {
            $result = $this->DB->call_procedure('addBrand', [$brand]);
            return true;
        }
        /**
         * Метод для удаления бренда
         * @param int $id ID Бренда
         * @return bool Результат операции
         */
        public function DeleteBrand(int $id) : bool {
            $result = $this->DB->call_procedure('deleteBrand', [$id]);
            return true;
        }
        /**
         * Метод для редактирования бренда
         * @param int $id ID Бренда
         * @param string $name Новое имя бренда
         * @return bool Результат операции
         */
        public function EditBrand(int $id, string $name) : bool {
            $result = $this->DB->call_procedure('updateBrand', [$id, $name]);
            return true;
        }
        /**
         * Метод для добавления размера
         * @param string $size Размер
         * @return bool Результат операции
         */
        public function AddSize(string $size) : bool {
            $result = $this->DB->call_procedure('addSize', [$size]);
            return true;
        }
        /**
         * Метод для удаления размера
         * @param int $id ID Размера
         * @return bool Результат операции
         */
        public function DeleteSize(int $id) : bool {
            $result = $this->DB->call_procedure('deleteSize', [$id]);
            return true;
        }
        /**
         * Метод для редактирования размера
         * @param int $id ID Размера
         * @param string $name Новое имя размера
         * @return bool Результат операции
         */
        public function EditSize(int $id, string $name) : bool {
            $result = $this->DB->call_procedure('updateSize', [$name, $id]);
            return true;
        }
        /**
         * Метод для получения сезона по ID
         * @param int $ID ID сезона
         * @return Season Сезон
         */
        public function GetSeason(int $ID) : ?Season {
            $result = $this->DB->call_procedure('getSeason', [$ID]);
            return $result != null ? new Season([
                'ID' => $result['ID'],
                'Name' => $result['Name'],
                'DateFrom' => new \DateTime($result['DateFrom']),
                'DateTo' => new \DateTime($result['DateTo'])
            ]) : null;
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
                    'ID' => '-1',
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
                    'ID' => '-1',
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
                'Category' => new Category([
                    'ID' => $array['IDCategory'],
                    'Name' => $array['Category']
                ]),
                'Brand' => new Brand([
                    'ID' => $array['IDBrand'],
                    'Name' => $array['Brand']
                ]),
                'Season' => new Season([
                    'ID' => $array['SeasonID'],
                    'Name' => $array['Season']
                ]),
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
            $result = $this->DB->call_procedure('topSale', [], true);
            if(!empty($result)) foreach($result as $item) $top[] = $this->GetProductFromArray($item);
            return $top;
        }
        /**
         * Метод для получения сезонных товаров
         * @return array Массив товаров
         */
        public function GetSeasonalOffer() : array {
            $so = [];
            $result = $this->DB->call_procedure('getSeasonNow', [], true);
            if(!empty($result)) foreach($result as $item) $so[] = $this->GetProductFromArray($item);
            return $so;
        }
        /**
         * Метод для получения списка товаров
         * @param int $page Страница
         * @param string $filter Тип фильтра
         * @param string $filterID ID фильтра
         * @param int $countPerPage Кол-во элементов на страницу
         * @return array Массив товаров
         */
        public function GetProducts(int $page = 1, string $filter = null, int $filterID = null, int $countPerPage = 20) : array {
            $products = [];
            
            $result = null;
            switch($filter) {
                case 'brand':
                    $result = $this->DB->call_procedure('getListProductBrand', [$countPerPage, $page, $filterID], true);
                    break;
                case 'category':
                    $result = $this->DB->call_procedure('getListProductCategory', [$countPerPage, $page, $filterID], true);
                    break;
                case 'size':
                    $result = $this->DB->call_procedure('getListProductSize', [$countPerPage, $page, $filterID], true);
                    break;
                default:
                    $result = $this->DB->call_procedure('getListProduct', [$page, $countPerPage], true);
                    break;
                
            }
            
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
         * @param string $filter Тип фильтра
         * @param int $filterID ID филтра
         * @param int $countPerPage Кол-во элементов на страницу
         * @return int Кол-во страниц
         */
        public function GetProductsPagesCount(string $filter, int $filterID, int $countPerPage = 20) : int {
            $result = null;

            switch($filter) {
                case 'brand':
                    $result = $this->DB->call_function('getCountPagesBrand', [$countPerPage, $filterID]);
                    break;
                case 'category':
                    $result = $this->DB->call_function('getCountPagesCategory', [$countPerPage, $filterID]);
                    break;
                case 'size':
                    $result = $this->DB->call_function('getCountPagesSize', [$countPerPage, $filterID]);
                    break;
                default:
                    $result = $this->DB->call_function('getCountPages', [$countPerPage]);
                    break;
            }
            
            
            return is_int((int)$result) ? $result : 0;
        }
        /**
         * Метод для получения списка брендов
         * @return array Список брендов
         */
        public function GetBrands() : array {
            $brands = [];
            
            $list = $this->DB->call_procedure('getBrands', [], true);
            if($list != null) {
                foreach($list as $item) $brands[] = new Brand($item);
            }

            return $brands;
        }
        /**
         * Метод для получения списка размеров
         * @return array Список размеров
         */
        public function GetSizes() : array {
            $sizes = [];
            
            $list = $this->DB->call_procedure('getSizes', [], true);
            if($list != null) {
                foreach($list as $item) $sizes[] = new Size($item);
            }

            return $sizes;
        }
        /**
         * Метод для получения списка категорий
         * @return array Список категорий
         */
        public function GetCategories() : ?array {
            $categories = [];
            $delete = [];

            $result = $this->DB->call_procedure('getCategories', [], true);
            
            if($result != null) {
                foreach($result as $item) {
                    $current = new Category($item);
                    
                    if(!empty($current->IDCategory)) {
                        foreach($categories as $category) {
                            if($category->ID == $current->IDCategory) {
                                $category->SubCategories[] = $current;
                                $delete[] = $current->ID;
                            }
                        }
                    }
                    $categories[] = $current;
                }
                foreach($delete as $d)
                    foreach($categories as $k => $s) 
                        if($s->ID == $d) unset($categories[$k]);
            }

            return $categories;
        }
    }
?>