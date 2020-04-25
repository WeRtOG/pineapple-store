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
		public function GetData(int $page = 1, string $filter = null, int $filterID = null)
		{	
			$pagesCount = $this->ProductManager->GetProductsPagesCount($filter, $filterID);
			
			$allItems = $this->ProductManager->GetProducts($page, $filter, $filterID);
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
				'PageCount' => $pagesCount,
				'CarouselItems' => $this->ProductManager->GetTopSale(),
				'SeasonalOfferItems' => $seasonal,
				'AllItems' => $allItems,
				'Brands' => $this->ProductManager->GetBrands(),
				'Categories' => $this->ProductManager->GetCategories(),
				'Sizes' => $this->ProductManager->GetSizes(),
				'Filter' => $filter,
				'FilterID' => $filterID,
				'Filtered' => ($filter != '' && $filterID != 0)
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