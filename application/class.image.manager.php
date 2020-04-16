<?php
    namespace ImageManager;

    /**
     * Класс менеджера клиентов
     */
    class ImageManager {
        /**
         * Метод для оптимизации изображения
         * * Принимает изображения в форматах JPEG, PNG, GIF
         * * Сохраняет изображение в формате WEBP
         * @param string $from Путь к входному файлу
         * @param string $to Путь к выходному файлу
         * @return bool Результат операции
         */
        public static function OptimizeImage(string $from, string $to) {
            $extension = strtolower(pathinfo($from, PATHINFO_EXTENSION));
            switch($extension) {
                case 'jpg':
                case 'jpeg':
                    $image = imagecreatefromjpeg($from);
                    break;
                case 'png':
                    $image = imagecreatefrompng($from);
                    break;
                case 'gif':
                    $image = imagecreatefromgif($from);
                    break;
                default:
                    return false;
                    break;
            }
            imagewebp($image, $to, 80);
            return true;
        }
    }
?>