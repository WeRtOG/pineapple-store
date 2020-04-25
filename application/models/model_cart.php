<?php
	/**
	 * Модель корзины
	 */
	class Model_Cart extends Model
	{
		public function __construct() {
			global $productMgr, $cart;

			$this->ProductManager = $productMgr;
			$this->Cart = $cart;
		}
		/**
		 * Модель корзины
		 */
		public function GetData()
		{	
            return [
                'Items' => $this->Cart->Items,
                'TotalPrice' => $this->Cart->TotalPrice
            ];
        }
    }
?>