<?php

    namespace Habrahabr\Api\Resources;

    use Habrahabr\Api\HttpAdapter\HttpAdapterInterface;

    /**
     * Interface ResourceInterface
     *
     * @package Habrahabr_api\Resources
     *
     * @interface
     */
    interface ResourceInterface
    {
        public function setAdapter( HttpAdapterInterface $adapter );
    }