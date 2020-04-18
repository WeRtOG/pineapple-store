<?php
    namespace File;

    /**
     * Класс для работы с файлами
     */
    class IO {
        public static string $CacheFolder = UPLOADS_FOLDER . '\\cache';
        /**
         * Метод для получения расширения файла
         * @param string $filename Имя файла
         * @return string Расширение
         */
        public static function GetExtension(string $filename) : string {
            return strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        }
        /**
         * Метод для получения временного файла
         * @param string $tmp Временный файл (в системе)
         * @param string $extension Расширение
         * @return string Временный файл (в проекте)
         */
        public static function GetTempFile(string $tmp, string $extension) : string {
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