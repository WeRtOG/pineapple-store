<?php
	/**
	 * Модель страницы каталога
	 */
	class Model_Catalog extends Model
	{
		public function __construct() {
			global $productMgr;
			$this->ProductManager = $productMgr;
		}
		/**
		 * Модель основной страницы с товарами
		 * @param $page Страница
		 */
		public function GetData(int $page = 1)
		{	
			return [
				'Page' => $page,
				'PageCount' => $this->ProductManager->GetProductsPagesCount(),
				'CarouselItems' => $this->ProductManager->GetTopSale(),
				'SeasonalOfferItems' => [
					[
						'ID' => 1,
						'Title' => 'NIKE FLYKNIT',
						'Image' => 'revolt_164_6wVEHfI_unsplash.png',
						'Price' => 8000,
						'WomanShoes' => false
					],
					[
						'ID' => 5,
						'Title' => 'VANS OLD SCHOOL',
						'Image' => 'ryan_plomp_PGTO_A0eLt4_unsplas.png',
						'Price' => 8000,
						'WomanShoes' => false
					],
					[
						'ID' => 6,
						'Title' => 'NIKE AIR FORCE',
						'Image' => 'hermes_rivera_wz_eb7K2Ip8_unsp.png',
						'Price' => 8000,
						'WomanShoes' => false
					],
					[
						'ID' => 7,
						'Title' => 'NIKE AIR JORDAN',
						'Image' => 'paul_gaudriault_a_QH9MAAVNI_un.png',
						'Price' => 8000,
						'WomanShoes' => false
					]
				],
				'AllItems' => $this->ProductManager->GetProducts($page)
			];
		}
		/**
		 * Модель страницы информации о товаре
		 * @param $productID ID товара
		 */
		public function ProductInfo(int $productID) {
			return [
				'Product' => $this->ProductManager->GetProduct($productID)
			];
		}
	}
?>