<?php

    namespace Habrahabr_api\HttpAdapter;

    use HttpRequest;
    use HttpException;

    use Habrahabr_api\Exception\ExtenstionNotLoadedException;

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

            try
            {
                $req->send();

                $res = $req->getResponseBody();

                return json_decode( $res, true );
            }
            catch( HttpException $e )
            {

            }

            return FALSE;
        }
    }