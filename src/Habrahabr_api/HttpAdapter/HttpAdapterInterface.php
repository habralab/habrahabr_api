<?php

	namespace Habrahabr_api\HttpAdapter;

	interface HttpAdapterInterface
	{
		public function setToken( $token );

		public function setClient( $client );

		public function get( $url );

		public function post( $url, array $values = [] );

		public function delete( $url );

		public function put( $url, array $values = [] );
	}