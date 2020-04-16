<?php
    namespace ClientManager;

    use \DatabaseManager\Database as Database;
    use \ImageManager\ImageManager as ImageManager;

    /**
     * Класс клиента сессии
     */
    class SessionClient {
        protected string $SessionName;
        protected ClientManager $Manager;
        protected Database $DB;
        public ?Client $Client;
        public bool $IsAuthorized = false;

        /**
         * Конструктор класса клиента сессии
         * @param string $SessionName Имя сессии
         * @param ClientManager $Manager Менеджер клиентов
         * @param Database $DB БД
         */
        public function __construct(string $SessionName, ClientManager $Manager, Database $DB) {
            $this->SessionName = $SessionName;
            $this->Manager = $Manager;
            $this->DB = $DB;
            $this->StartSession();
        }
        /**
         * Метод для запуска сессии
         */
        public function StartSession() {
            $SessionToken = '';

            session_start();
            
            if(array_key_exists($this->SessionName, $_SESSION)) {
                $SessionToken = $_SESSION[$this->SessionName];
            }
            
            if(!$this->Manager->IsClientExists($SessionToken)) {
                $SessionToken = $this->Manager->GenerateToken();
                $_SESSION[$this->SessionName] = $SessionToken;
            }

            $this->Client = $this->Manager->GetClient($SessionToken);
            if(!empty($this->Client->Phone) && !empty($this->Client->Password)) $this -> IsAuthorized = true;
        }
        /**
         * Метод для авторизации клиента
         * @param string $Phone Телефон
         * @param string $Password Пароль
         */
        public function Authorize(string $Phone, string $Password) {
            foreach(func_get_args() as $argument) if(empty($argument)) return ERROR_FIELD_EMPTY_DATA;

            if($this->Manager->CheckPhone($Phone)) {
                $Password = sha1(strrev(md5($Password)));
                
                $result = $this->DB->call_function('isAuthorization', [$Phone, $Password]);
                
                if($result != null) {
                    if($result != 'false') {
                        $_SESSION[$this->SessionName] = $result;
                        return ACTION_SUCCESS;
                    } else {
                        return ERROR_INVALID_PWD;
                    }
                } else {
                    return ERROR_INVALID_PWD;
                }
            } else {
                return ERROR_USER_NOT_FOUND;
            }
        }
        /**
         * Метод для загрузки аватара
         * @param array Файл
         */
        public function UploadAvatar(array $file) {
            $type = explode('/', $file['type'])[0];
            if($type == 'image') {
                $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                if(in_array($extension, ['png', 'jpg', 'jpeg', 'gif'])) {
                    $date = new \DateTime();
                    $from = dirname(__DIR__) . '\\uploads\\cache\\' . $date->getTimestamp() . '-' . rand() . "." . $extension;
                    $to = dirname(__DIR__) . '\\uploads\\user\\avatar\\' . $this->Client->ID . '.webp';
                    
                    move_uploaded_file($file['tmp_name'], $from);

                    $result = ImageManager::OptimizeImage($from, $to);

                    unlink($from);
                    return $result;
                } else {
                    return false;
                }
            } else {
                return false;
            }

        }
        /**
         * Метод для выхода из аккаунта
         */
        public function Logout() {
            $_SESSION[$this->SessionName] = '';
        }
    }
?>