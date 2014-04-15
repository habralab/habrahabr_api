<?php

    namespace tmtm\Habrahabr_api\HttpAdapter;

    use tmtm\Habrahabr_api\Exception\ExtenstionNotLoadedException;
    use tmtm\Habrahabr_api\Exception\NetworkException;

    /**
     * HTTP-адаптер, использующий библиотеку cURL
     *
     * @author kafeman <kafemanw@gmail.com>
     * @since  0.0.5
     */
    class CurlAdapter implements HttpAdapterInterface
    {
        use traitAdapter;

        /**
         * Экземпляр cURL
         *
         * Переменнная объявлена как protected, чтобы можно было унаследовать
         * этот класс для для проведения различных Unit-тестов.
         *
         * @var resource
         */
        protected $curl;

        /**
         * Проверяет наличие функций для работы с cURL и
         * инициализирует библиотеку
         */
        public function __construct()
        {
            if( !function_exists( 'curl_init' ) )
            {
                throw new ExtenstionNotLoadedException( 'The cURL PHP extension was not loaded' );
            }

            $this->curl = curl_init();
        }

        /**
         * Завершает работу с cURL
         */
        public function __destruct()
        {
            curl_close($this->curl);
        }

        /**
         * Выполняет GET-запрос
         *
         * @param string $url Запрашиваемый ресурс без endpoint'а
         *
         * @return array|false Результат запроса
         */
        public function get($url)
        {
            return $this->request($url, 'GET');
        }

        /**
         * Выполняет POST-запрос
         *
         * @param string $url    Запрашиваемый ресурс без endpoint'а
         * @param array  $values Параметры, передаваемые в теле запроса
         *
         * @return array|false Результат запроса
         */
        public function post($url, array $values = [])
        {
            return $this->request($url, 'POST', $values);
        }

        /**
         * Выполняет DELETE-запрос
         *
         * @param string $url Запрашиваемый ресурс без endpoint'а
         *
         * @return array|false Результат запроса
         */
        public function delete($url, array $values = [])
        {
            return $this->request($url, 'DELETE', $values);
        }

        /**
         * Выполняет PUT-запрос
         *
         * @param string $url    Запрашиваемый ресурс без endpoint'а
         * @param array  $values Параметры, передаваемые в теле запроса
         *
         * @return array|false Результат запроса
         */
        public function put($url, array $values = [])
        {
            return $this->request($url, 'PUT', $values);
        }

        /**
         * Выполняет HTTP-запрос
         *
         * @param string $url    Запрашиваемый ресурс без endpoint'а
         * @param string $method HTTP-метод, например, GET
         * @param array  $values Параметры, передаваемые в теле запроса
         *
         * @return array|false Результат запроса
         */
        protected function request($url, $method, array $values = [])
        {
            $url = $this->getEndpoint() . $url;
            curl_setopt($this->curl, CURLOPT_URL, $url);
            curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, $method);
            curl_setopt($this->curl, CURLOPT_CONNECTTIMEOUT, $this->connectionTimeout);

            curl_setopt($this->curl, CURLOPT_HTTPHEADER, array(
                'client: ' . $this->client,
                'token: '  . $this->token
            ));

            if( $method == 'PUT' || $method == 'POST' )
            {
                curl_setopt( $this->curl, CURLOPT_POSTFIELDS, http_build_query( $values ) );
            }

            $result = curl_exec($this->curl);

            if( curl_errno( $this->curl ) )
            {
                throw new NetworkException( curl_error( $this->curl ) );
            }

            return $result ? json_decode($result, true) : false;
        }
    }
