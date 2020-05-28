<?php
    namespace Translate;
    
    use \Statickidz\GoogleTranslate;
    /**
     * Класс переводчика
     */
    class Translator {
        public GoogleTranslate $Translate;

        /**
         * Конструктор переводчика
         */
        public function __construct() {
            $this->Translator = new GoogleTranslate();
        }
        /**
         * Метод для перевода текста
         * @param string $text Текст
         * @param string $source Исходный язык
         * @param string $target Конечный язык
         * @return string Результат перевода
         */
        public function TranslateText(string $text = 'Текст не выбран', string $source = 'ru', string $target = 'uk') {
            $result = '';
            try {
                $hash = md5(json_encode($source) . json_encode($target) . json_encode($text));
                $hash_file = PROJECT_FOLDER . '\\application\\translate_cache\\' . $hash;
                if(file_exists($hash_file)) {
                    $result = file_get_contents($hash_file);
                } else {
                    $result = $this->Translator->Translate($source, $target, $text);
                    file_put_contents($hash_file, $result);
                }
                
                usleep(500);
            }
            catch (\Exception $e) {
                
            }
            return $this->mb_ucfirst($result);
        }
         /**
         * Метод для перевода большого текста
         * @param string $text Текст
         * @param string $source Исходный язык
         * @param string $target Конечный язык
         * @return string Результат перевода
         */
        public function TranslateBigText($text, $source = 'ru', $target = 'uk') {
            $result = "";
    
            $text = strip_tags($text);
            $tx_array = explode("\n", wordwrap($text, 3000));
    
            foreach ($tx_array as $tx) $result .= $this->TranslateText($tx, $source, $target)." ";
            return $result;
        }
        /**
         * Метод для того, чтобы сделать первую букву большой
         * @param string $string Строка
         * @param string $enc Кодировка
         * @return string Результат
         */
        private function mb_ucfirst(string $string, string $enc = 'UTF-8')
        {
            return mb_strtoupper(mb_substr($string, 0, 1, $enc), $enc) . 
                mb_substr($string, 1, mb_strlen($string, $enc), $enc);
        }
    }
?>