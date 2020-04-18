<?php
    namespace ClientManager;

    use \ImageManager\Image as Image;

    /**
     * Класс аватара клиента
     */
    class Avatar {
        public bool $IsDefault = true;
        public Image $Image;

        /**
         * Конструктор класса аватара клиента
         * @param int $client_id ID клиента
         */
        public function __construct(int $client_id) {
            $Path = '/uploads/user/avatar/' . $client_id . '.webp';

            $this->Image = new Image($Path);
            $exists = file_exists($this->Image->FilePath);
            $this->Image = $exists ? $this->Image : new Image($Path);
            $this->IsDefault = !$exists;
            
            $this->Path = $Path;
        }
    }
?>