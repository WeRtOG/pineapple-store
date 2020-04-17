<?php
    namespace ImageManager;

    /**
     * Класс менеджера клиентов
     */
    class ImageManager {
        public static string $CacheFolder = UPLOADS_FOLDER . '\\cache';
        public static string $AvatarFolder = UPLOADS_FOLDER . '\\user\\avatar';
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
        /**
         * Метод для получения расширения файла
         * @param string $filename Имя файла
         * @return string Расширение
         */
        public static function GetExtension(string $filename) {
            return strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        }
        /**
         * Метод для получения временного файла
         * @param string $tmp Временный файл (в системе)
         * @param string $extension Расширение
         * @return string Временный файл (в проекте)
         */
        public static function GetTempFile(string $tmp, string $extension) {
            $date = new \DateTime();
            $new_tmp = self::$CacheFolder . $date->getTimestamp() . '-' . rand() . "." . $extension;
            move_uploaded_file($tmp, $new_tmp);
            return $new_tmp;
        }
        /**
         * Метод для удаления временного файла
         * @param string $filename Имя файла
         */
        public static function DeleteTempFile(string $filename) {
            unlink($filename);
        }
    }
?>