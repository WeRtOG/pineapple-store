<?php
    namespace ClientManager;

    require_once 'class.client.manager.php';
    require_once 'class.client.session.php';

    /**
     * Класс объекта клиента
     */
    class Client {
        public int $ID;
        public ?string $Phone;
        public ?string $Password;
        public string $Token;
        public ?string $Name;

        /**
         * Конструктор объекта клиента
         */
        public function __construct($data) {
            if(empty($data)) return;
            foreach($data as $key => $value) $this->{$key} = $value;
        }
    }
?>