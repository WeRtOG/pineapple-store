<?php
    namespace ImageManager;
    
    require_once 'class.image.manager.php';

    /**
     * Класс объекта изображения
     */
    class Image {
        public string $Path;
        public string $AbsolutePath;
        public int $ModificationTime;

        /**
         * Конструктор объекта изображения
         * @param string $Path Путь к файлу
         */
        public function __construct(string $Path) {
            $root = \Route::GetRoot();

            $this->AbsolutePath = $Path;
            $this->FilePath = $_SERVER['DOCUMENT_ROOT'] . $root . $Path;
            $this->LastEditedTime = file_exists($this->FilePath) ? filemtime($this->FilePath) : null;
            $this->Path = $root . $Path . '?v=' . $this->LastEditedTime;
        }
    }
?>