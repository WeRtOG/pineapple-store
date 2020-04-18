<?php
    namespace ProductManager;

    use \ImageManager\Image as Image;

    /**
     * Класс аватара клиента
     */
    class ProductImages {
        public Image $HorizontalImage;
        public array $ImagesList = [];
        /**
         * Конструктор класса изображений
         * @param int $productID ID товара
         */
        public function __construct(int $productID) {
            $ProductFolderAbsolute = '/product/' . $productID;
            $ProductFolder = UPLOADS_FOLDER . $ProductFolderAbsolute;
            $ProductImagesFolderAbsolute = $ProductFolderAbsolute . '/images';
            $ProductImagesFolder = $ProductFolder . '/images';
            
            if (!file_exists($ProductFolder)) mkdir($ProductFolder, 0777, true);
            if (!file_exists($ProductImagesFolder)) mkdir($ProductImagesFolder, 0777, true);

            $HorizontalImageAbsolutePath = '/uploads/' . $ProductFolderAbsolute . '/horizontal.webp';
            $HorizontalImagePath = $ProductFolder . '/horizontal.webp';
            $this->HorizontalImage = new Image(file_exists($HorizontalImagePath) ? $HorizontalImageAbsolutePath : '/images/product-default-horizontal.svg');

            $AllImages = glob($ProductImagesFolder . "/*.webp");
            $AllImagesCount = count($AllImages);

            if($AllImagesCount == 0) {
                $this->ImagesList[] = new Image('/images/product-default.svg');
            } else {
                foreach($AllImages as $i => $Image) {
                    $Image = \str_replace(UPLOADS_FOLDER, '', $Image);
                    $this->ImagesList[] = new Image('/uploads/' . $Image);
                }
            }
        }
    }
?>