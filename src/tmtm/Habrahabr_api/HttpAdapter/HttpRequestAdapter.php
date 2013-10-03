<?php

    namespace tmtm\Habrahabr_api\HttpAdapter;

    use HttpRequest;
    use HttpException;

    use tmtm\Habrahabr_api\Exception\ExtenstionNotLoadedException;

    /**
     * Адаптер построенный на php модуле Http
     *
     * @see http://www.php.net/manual/ru/book.http.php
     *
     * @package Habrahabr_api\HttpAdapter
     */
    class HttpRequestAdapter implements HttpAdapterInterface
    {
        use traitAdapter;

        public function __construct()
        {
            if( !class_exists('HttpRequest') )
            {
                throw new ExtenstionNotLoadedException('HttpRequest module not loaded');
            }
        }

        public function get( $url )
        {
            return $this->request( $url, HttpRequest::METH_GET );
        }

        public function post( $url, array $values = [] )
        {

        }

        public function delete( $url )
        {
            return $this->request( $url, HttpRequest::METH_DELETE );
        }

        public function put( $url, array $values = [] )
        {
            return $this->request( $url, HttpRequest::METH_PUT, $values );
        }

        private function request( $url, $method, array $values = [] )
        {
            $url = $this->getEndpoint() . $url ;

            $req = new \HttpRequest( $url, $method );

            $req->setHeaders( [ 'client' => $this->client, 'token' => $this->token  ] );

            if( $method === HttpRequest::METH_PUT )
            {
                $req->addPutData( http_build_query($values ));
                $req->setContentType('application/x-www-form-urlencoded');
            }

            try
            {
                $req->send();
                $res = $req->getResponseBody();

                // @todo разбор ошибок?
                return json_decode( $res, true );
            }
            catch( HttpException $e )
            {

            }

            return FALSE;
        }
    }