<?php

    namespace Habrahabr_api\HttpAdapter;

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
            // @todo validation / normalization
            // @todo mb extract 'setVersion' ?
            $this->endpoint = $url;
        }

        public function getEndpoint()
        {
            return $this->endpoint;
        }
    }