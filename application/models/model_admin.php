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
			global $productMgr;
            $this->ProductManager = $productMgr;
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
         * Метод для создания бренда
         * @param string $brand Бренд
         */
        public function AddBrand(string $brand)
        {
            $this->ProductManager->AddBrand($brand);
        }
        /**
         * Метод для удаления бренда
         * @param int $id ID бренда
         */
        public function DeleteBrand(int $id)
        {
            $this->ProductManager->DeleteBrand($id);
        }
        /**
         * Метод для редактирования бренда
         * @param int $id ID бренда
         * @param string $name Новое имя бренда
         */
        public function EditBrand(int $id, string $name)
        {
            if(empty($name)) return;
            $this->ProductManager->EditBrand($id, $name);
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
         * @param int $id ID размера
         */
        public function DeleteSize(int $id)
        {
            $this->ProductManager->DeleteSize($id);
        }
        /**
         * Метод для редактирования размера
         * @param int $id ID размера
         * @param string $name Имя размера
         */
        public function EditSize(int $id, string $name)
        {
            if(empty($name)) return;
            $this->ProductManager->EditSize($id, $name);
        }
    }
?>