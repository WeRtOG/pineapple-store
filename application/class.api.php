<?php
    /**
     * Класс вспомогательных методов для API
     */
    class API {
        /**
         * Метод для ответа на запрос к апи
         * @param array $data Массив данных
         */
        public static function Answer(array $data) {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($data, JSON_PRETTY_PRINT);
        }
    }
?>