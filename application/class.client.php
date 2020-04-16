<?php
    namespace ClientManager;

    require_once 'class.client.manager.php';
    require_once 'class.client.session.php';
    require_once 'class.client.auth.helper.php';
    require_once 'class.client.avatar.php';

    /**
     * Класс объекта клиента
     */
    class Client {
        public int $ID;
        public ?string $Phone;
        public ?string $Password;
        public string $Token;
        public ?string $Name;
        public Avatar $Avatar;

        /**
         * Конструктор объекта клиента
         * @param array $data Массив
         */
        public function __construct(array $data) {
            if(empty($data)) return;
            foreach($data as $key => $value) $this->{$key} = $value;

            $this->Avatar = new Avatar($data['ID']);
        }
    }
?>