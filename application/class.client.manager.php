<?php
    namespace ClientManager;

    use \DatabaseManager\Database as Database;

    /**
     * Класс менеджера клиентов
     */
    class ClientManager {
        protected Database $DB;

        /**
         * Конструктор менеджера клиентов
         * @param Database $DB БД
         */
        public function __construct(Database $DB) {
            $this->DB = $DB;
        }
        /**
         * Метод для получения клиента по токену
         * @param string $Token Токен
         * @return Client Клиент
         */
        public function GetClient(string $Token) : Client {
            $data = $this->DB->call_procedure('getClient', [$Token]);
            $client = new Client($data);
            return $client;
        }
        /**
         * Метод для регистрации клиента
         * @param string $Phone Телефон
         * @param string $Name Имя
         * @param string $Password Пароль
         * @param string $Token Токен
         * @return int Результат операции
         */
        public function Register(string $Phone, string $Name, string $Password, string $Token) : int {
            foreach(func_get_args() as $argument) if(empty($argument)) return ERROR_FIELD_EMPTY_DATA;

            if(!$this->CheckPhone($Phone)) {
                $Password = AuthHelper::EncryptPassword($Password);

                $this->DB->call_procedure('Registration', [$Token, $Phone, $Password, $Name]);
                return ACTION_SUCCESS;
            } else {
                return ERROR_USER_ALREADY_EXISTS;
            }
        }
        /**
         * Метод для проверки наличия номера
         * @param string $Phone Номер телефона
         * @return bool Результат проверки
         */
        public function CheckPhone(string $Phone) : bool {
            return $this->DB->call_function('checkPhone', [$Phone]) == 'true';
        }
        /**
         * Метод для проверки о существовании клиента
         * @param string $Token Токен
         * @return bool Результат проверки
         */
        public function IsClientExists(?string $Token) : bool {
            return $this->DB->call_function('isClientExists', [$Token]) == 'true';
        }
        /**
         * Метод для генерации токена
         * @return string Токен
         */
        public function GenerateToken() : string {
            return $this->DB->call_function('createToken');
        }
    }
?>