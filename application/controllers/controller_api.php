<?php
    /**
     * Контроллер API
     */
	class Controller_API extends Controller
	{
        /**
         * Конструктор контроллера API
         */
        public function __construct()
        {
            global $session_client, $clientMgr, $auth_helper;

            $this->SessionClient = $session_client;
            $this->ClientManager = $clientMgr;
            $this->AuthHelper = $auth_helper;
            $this->Root = Route::GetRoot();
        }
        /**
         * Экшн коренной страницы
         */
		public function action_index()
		{
            $this -> action_404();
        }
        /**
         * Экшн загрузки аватара
         */
        public function action_UploadAvatar()
        {
            if($this->SessionClient->IsAuthorized) {
                switch($_SERVER['REQUEST_METHOD']) {
                    case 'GET':
                        $this->action_400();
                        break;
                    case 'POST':
                        if(!empty($_FILES['image'])) {
                            $result = $this->SessionClient->UploadAvatar($_FILES['image']);
                            if($result) {
                                API::Answer([
                                    'ok' => true,
                                    'code' => 200,
                                ]);
                            } else {
                                $this->action_400();
                            }
                        } else {
                            $this->action_400();
                        }
                        
                        break;
                }
            } else {
                $this->action_403();
            }
        }
        /**
         * Экшн 400 ошибки
         */
        public function action_400()
        {
            API::Answer([
                'ok' => false,
                'code' => 400,
                'error' => 'Bad request.'
            ]);
        }
        /**
         * Экшн 403 ошибки
         */
        public function action_403()
        {
            API::Answer([
                'ok' => false,
                'code' => 403,
                'error' => 'Unauthorized.'
            ]);
        }
        /**
         * Экшн 404 ошибки
         */
        public function action_404() 
        {
            API::Answer([
                'ok' => false,
                'code' => 404,
                'error' => 'Method is not found.'
            ]);
        }
	}
?>