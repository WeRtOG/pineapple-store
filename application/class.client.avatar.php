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

            if(file_exists($this->Image->FilePath)) {
                $this->IsDefault = false;
            } else {
                $Path = '/images/client.svg';
                $this->Image = new Image($Path);
            }
            $this->Path = $Path;
        }
    }
?>