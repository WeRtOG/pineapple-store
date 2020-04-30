<?php
	/**
	 * Модель админки
	 */
	class Model_Admin extends Model
	{
        /**
         * Конструктор модели админки
         */
		public function __construct() {
			global $productMgr, $clientMgr;
            $this->ProductManager = $productMgr;
            $this->ClientManager = $clientMgr;
        }
        /**
         * Метод для получения списка брендов
         * @return array Список брендов
         */
		public function GetBrands() : array
		{	
            return [
                'Brands' => $this->ProductManager->GetBrands()
            ];
        }
        /**
         * Метод для получения списка размеров
         * @return array Список размеров
         */
        public function GetSizes() : array
		{	
            return [
                'Sizes' => $this->ProductManager->GetSizes()
            ];
        }
        /**
         * Метод для получения списка сезонов
         * @return array Список сезонов
         */
        public function GetSeasons() : array
		{	
            return [
                'Seasons' => $this->ProductManager->GetSeasons()
            ];
        }
        /**
         * Метод для получения списка цветов
         * @return array Список цветов
         */
        public function GetColors() : array
		{	
            return [
                'Colors' => $this->ProductManager->GetColors()
            ];
        }
        /**
         * Модель редактирования товара
         * @param int $ID ID товара
         */
        public function GetProduct(int $ID)
        {
            return [
                'Product' => $this->ProductManager->GetProduct($ID),
                'Brands' => $this->ProductManager->GetBrands(),
                'Sizes' => $this->ProductManager->GetSizes(),
                'Seasons' => $this->ProductManager->GetSeasons(),
                'Colors' => $this->ProductManager->GetColors(),
                'Categories' => $this->ProductManager->GetAllCategories()
            ];
        }
        /**
         * Модель добавления товара
         */
        public function AddProductModel()
        {
            return [
                'Brands' => $this->ProductManager->GetBrands(),
                'Sizes' => $this->ProductManager->GetSizes(),
                'Seasons' => $this->ProductManager->GetSeasons(),
                'Colors' => $this->ProductManager->GetColors(),
                'Categories' => $this->ProductManager->GetAllCategories()
            ];
        }
        /**
         * Метод для получения списка клиентов
         * @param int $page Страница
         * @return array Список клиентов
         */
        public function GetClients(int $page = 1) : array
		{	
            return [
                'Page' => $page,
                'PageCount' => $this->ClientManager->GetClientsPageCount(),
                'Clients' => $this->ClientManager->GetClients($page)
            ];
        }
        /**
         * Метод для получения списка товаров
         * @param int $page Страница
         * @return array Список товаров
         */
        public function GetProducts(int $page = 1) : array
		{	
            return [
                'Page' => $page,
                'PageCount' => $this->ProductManager->GetProductsPagesCount(),
                'Products' => $this->ProductManager->GetProducts($page)
            ];
        }
        /**
         * Метод для создания бренда
         * @param string $brand Бренд
         */
        public function AddBrand(string $brand)
        {
            $this->ProductManager->AddBrand($brand);
        }
        /**
         * Метод для удаления бренда
         * @param int $ID ID бренда
         */
        public function DeleteBrand(int $ID)
        {
            $this->ProductManager->DeleteBrand($ID);
        }
        /**
         * Метод для редактирования бренда
         * @param int $ID ID бренда
         * @param string $name Новое имя бренда
         */
        public function EditBrand(int $ID, string $name)
        {
            if(empty($name)) return;
            $this->ProductManager->EditBrand($ID, $name);
        }
        /**
         * Метод для добавления размера
         * @param string $size Размер
         */
        public function AddSize(string $size)
        {
            $this->ProductManager->AddSize($size);
        }
        /**
         * Метод для удаления размера
         * @param int $ID ID размера
         */
        public function DeleteSize(int $ID)
        {
            $this->ProductManager->DeleteSize($ID);
        }
        /**
         * Метод для редактирования размера
         * @param int $ID ID размера
         * @param string $name Имя размера
         */
        public function EditSize(int $ID, string $name)
        {
            if(empty($name)) return;
            $this->ProductManager->EditSize($ID, $name);
        }
        /**
         * Метод для добавления сезона
         * @param string $season Сезон
         * @param string $dateFrom Дата начала сезона
         * @param string $dateTo Дата окончания сезона
         */
        public function AddSeason(string $season, string $dateFrom, string $dateTo)
        {
            $this->ProductManager->AddSeason($season, $dateFrom, $dateTo);
        }
        /**
         * Метод для удаления сезона
         * @param int $ID ID сезона
         */
        public function DeleteSeason(int $ID)
        {
            $this->ProductManager->DeleteSeason($ID);
        }
        /**
         * Метод для редактирования сезона
         * @param int $ID ID сезона
         * @param string $name Новое имя сезона
         * @param string $dateFrom Новая дата начала сезона
         * @param string $dateTo Новая дата окончания сезона
         */
        public function EditSeason(int $ID, string $name, string $dateFrom, string $dateTo)
        {
            if(empty($name)) return;
            $this->ProductManager->EditSeason($ID, $name, $dateFrom, $dateTo);
        }
        /**
         * Метод для добавления цвета
         * @param string $colorName Имя цвета
         * @param string $color Цвет
         * @param string $dateTo Дата окончания сезона
         */
        public function AddColor(string $colorName, string $color)
        {
            $color = str_replace('#', '', $color);
            $this->ProductManager->AddColor($colorName, $color);
        }
        /**
         * Метод для удаления цвета
         * @param int $ID ID цвета
         */
        public function DeleteColor(int $ID)
        {
            $this->ProductManager->DeleteColor($ID);
        }
        /**
         * Метод для редактирования цвета
         * @param int $ID ID цвета
         * @param string $name Новое имя цвета
         * @param string $color Новый Цвет
         */
        public function EditColor(int $ID, string $name, string $color)
        {
            if(empty($name)) return;
            $color = str_replace('#', '', $color);
            $this->ProductManager->EditColor($ID, $name, $color);
        }
        /**
         * Метод для удаления товара
         * @param int $ID ID товара
         */
        public function DeleteProduct(int $ID)
        {
            $this->ProductManager->DeleteProduct($ID);
        }
        /**
         * Метод для обновления информации о товаре
         * @param string $name Имя товара
         * @param int $year Год
         * @param int $price Цена
         * @param int $category Категория (id)
         * @param int $brand Бренд (id)
         * @param int $season Сезон (id)
         * @param array $colors Цвета
         * @param array $sizes Размеры
         * @param string $description Описание
         * @param int $ID ID товара
         */
        public function UpdateProduct(string $name, int $year, int $price, int $category, int $brand, int $season, array $colors, array $sizes, string $description, int $ID)
        {
            $this->ProductManager->UpdateProduct($name, $year, $price, $category, $brand, $season, $colors, $sizes, $description, $ID);
        }
        /**
         * Метод для добавления товара
         * @param string $name Имя товара
         * @param int $year Год
         * @param int $price Цена
         * @param int $category Категория (id)
         * @param int $brand Бренд (id)
         * @param int $season Сезон (id)
         * @param array $colors Цвета
         * @param array $sizes Размеры
         * @param string $description Описание
         * @return int ID товара
         */
        public function AddProduct(string $name, int $year, int $price, int $category, int $brand, int $season, array $colors, array $sizes, string $description) : int
        {
            return $this->ProductManager->AddProduct($name, $year, $price, $category, $brand, $season, $colors, $sizes, $description);
        }
    }
?>