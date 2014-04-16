<?php

    namespace tmtm\Habrahabr_api\HttpAdapter;

    use tmtm\Habrahabr_api\Exception\ExtenstionNotLoadedException;
    use tmtm\Habrahabr_api\Exception\NetworkException;

    /**
     * Адаптер-заглушка, используемый для проведения различных тестов
     *
     * Никакие настоящие сетевые запросы не производятся!
     *
     * @author kafeman <kafemanw@gmail.com>
     * @since  0.0.7
     */
    class MockAdapter implements HttpAdapterInterface
    {
        use traitAdapter;

        protected $routes;

        public function get($url)
        {
            return $this->request($url, 'GET');
        }

        public function post($url, array $values = [])
        {
            return $this->request($url, 'POST', $values);
        }

        public function delete($url, array $values = [])
        {
            return $this->request($url, 'DELETE', $values);
        }

        public function put($url, array $values = [])
        {
            return $this->request($url, 'PUT', $values);
        }

        public function addGetHandler($url, $data)
        {
            $this->addHandler($url, $data, 'GET');
        }

        public function addPostHandler($url, $data)
        {
            $this->addHandler($url, $data, 'POST');
        }

        public function addDeleteHandler($url, $data)
        {
            $this->addHandler($url, $data, 'DELETE');
        }

        public function addPutHandler($url, $data)
        {
            $this->addHandler($url, $data, 'PUT');
        }

        public function addHandler($url, $data, $method)
        {
            $key = $method . $url;
            $this->routes[$key] = $data;
        }

        protected function request($url, $method, array $values = [])
        {
            $key = $method . $url;

            if (array_key_exists($key, $this->routes))
            {
                return $this->routes[$key];
            }
            else
            {
                // 404 Not Found
                return false;
            }
        }
    }
