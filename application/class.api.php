<?php
    /**
     * Класс вспомогательных методов для API
     */
    class API {
        public static function Answer($data) {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($data, JSON_PRETTY_PRINT);
        }
    }
?>