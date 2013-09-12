<?php

	spl_autoload_register( function( $class_name )
	{
		$class_name = ltrim( $class_name, '\\' );

		if( substr( $class_name, 0, 13) !== 'Habrahabr_api' )
		{
			return FALSE;
		}

		$path = realpath( __DIR__ ) .'/'. str_replace('\\', '/', $class_name ) . '.php';

		if( is_file( $path ) )
		{
			require_once( $path );
		}
	});