<?php
	/**
	 * Модель страницы каталога
	 */
	class Model_Catalog extends Model
	{
		public function __construct() {
			global $productMgr, $cart;

			$this->ProductManager = $productMgr;
			$this->Cart = $cart;
		}
		/**
		 * Модель основной страницы с товарами
		 * @param $page Страница
		 */
		public function GetData(int $page = 1)
		{	
			$allItems = $this->ProductManager->GetProducts($page);
			foreach($allItems as $i => $item) {
				if($this->Cart->ProductExists($item)) {
					$allItems[$i]->InCart = true;
				}
			}

			$seasonal = $this->ProductManager->GetSeasonalOffer();
			foreach($seasonal as $i => $item) {
				if($this->Cart->ProductExists($item)) {
					$seasonal[$i]->InCart = true;
				}
			}

			return [
				'Page' => $page,
				'PageCount' => $this->ProductManager->GetProductsPagesCount(),
				'CarouselItems' => $this->ProductManager->GetTopSale(),
				'SeasonalOfferItems' => $seasonal,
				'AllItems' => $allItems
			];
		}
		/**
		 * Модель страницы информации о товаре
		 * @param $productID ID товара
		 */
		public function ProductInfo(int $productID) {
			$product = $this->ProductManager->GetProduct($productID);
			$product->InCart = $this->Cart->ProductExists($product);
			return [
				'Product' => $product
			];
		}
	}
?>