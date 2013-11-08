<?php

    namespace tmtm\Habrahabr_api\HttpAdapter;

    use tmtm\Habrahabr_api\Exception\IncorrectUsageException;

    trait traitAdapter
    {
        protected $token;
        protected $client;
        protected $endpoint;

        public function setToken( $token )
        {
            // @todo validation??
            $this->token = $token;
        }

        public function setClient( $client )
        {
            // @todo validation??
            $this->client = $client;
        }

        public function setEndpoint( $url )
        {
            // @todo mb extract 'setVersion' ?

            $check = parse_url( $url );

            if( empty( $check['scheme'] ) || $check['scheme'] !== 'https' )
            {
                throw new IncorrectUsageException('Scheme of endpoint must be https');
            }

            $url = rtrim( $url, '/' );

            $this->endpoint = $url;
        }

        public function getEndpoint()
        {
            return $this->endpoint;
        }
    }