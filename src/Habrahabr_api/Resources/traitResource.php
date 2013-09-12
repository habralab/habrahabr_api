<?php

	namespace Habrahabr_api\Resources;

	use Habrahabr_api\Exception\IncorrectUsageException;
	use Habrahabr_api\HttpAdapter\HttpAdapterInterface;
	use Habrahabr_api\HttpAdapter\traitAdapter;

	trait traitResource
	{
		/**
		 * @var HttpAdapterInterface
		 */
		protected  $adapter;

		/**
		 * @param HttpAdapterInterface $adapter
		 *
		 * @return $this
		 */
		public function setAdapter( HttpAdapterInterface $adapter )
		{
			$this->adapter = $adapter;

			return $this;
		}

		public function __clone()
		{
			throw new IncorrectUsageException('Please, no clone resources');
		}


		// @todo other magic methods ??
	}