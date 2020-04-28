<?php
    namespace NovaPoshta;

    /**
     * Класс для работы с API Новой Почты
     */
    class API {
        private string $APIKey;
        public function __construct(string $APIKey) {
            $this->APIKey = $APIKey;
        }
        private function MakeRequest(array $parameters) : object {
            $parameters['methodProperties']['Language'] = 'ru';
            $parameters['apiKey'] = $this->APIKey;

            $json = json_encode($parameters);
            
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => "https://api.novaposhta.ua/v2.0/json/",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $json,
                CURLOPT_HTTPHEADER => array("content-type: application/json",),
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0
            ]);
            $response = curl_exec($curl);
            return json_decode($response);
        }
        /**
         * Метод для получения списка отделений
         */
        public function GetWarehouses() : object {
            return $this->MakeRequest([
                'modelName' => 'AddressGeneral',
                'calledMethod' => 'getWarehouses'
            ]);
        }
        /**
         * Метод для получения списка отделений города
         */
        public function GetCityWarehouses(string $city) : object {
            return $this->MakeRequest([
                'modelName' => 'AddressGeneral',
                'calledMethod' => 'getWarehouses',
                'methodProperties' => [
                    'CityName' => $city
                ]
            ]);
        }
    }
?>