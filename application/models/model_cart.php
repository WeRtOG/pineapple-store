<?php
	/**
	 * Модель корзины
	 */
	class Model_Cart extends Model
	{
		/**
		 * Конструктор модели корзины
		 */
		public function __construct() {
			global $productMgr, $cart;
			$this->ProductManager = $productMgr;
			$this->Cart = $cart;
		}
		/**
		 * Основной метод получения данных для корзины
		 * @return array Результат
		 */
		public function GetData() : array
		{	
            return [
                'Items' => $this->Cart->Items,
                'TotalPrice' => $this->Cart->TotalPrice
            ];
        }
    }
?>