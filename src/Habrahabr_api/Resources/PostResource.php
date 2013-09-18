<?php

    namespace Habrahabr_api\Resources;

    use Habrahabr_api\Exception\IncorrectUsageException;

    /**
     * Ресурс работы с постами
     *
     * @package Habrahabr_api\Resources
     */
    class PostResource  extends abstractResource implements ResourceInterface
    {
        /**
         * Получение поста по его id. ( без комментариве )
         *
         * @param   int $id
         *
         * @return  mixed
         */
        public function getPost( $id )
        {
            return $this->adapter->get( sprintf('/post/%d', $id ) );
        }

        /**
         * Голосование за пост.
         *
         * @param   int $id
         * @param   int $type [ -1, 0, 1 ]
         *
         * @return mixed
         *
         * @throws \Habrahabr_api\Exception\IncorrectUsageException
         */
        public function vote( $id,  $type )
        {

            if( !in_array( $type, [ -1, 0, 1 ] , 1 ) )
            {
                throw new IncorrectUsageException('vote type incorrect');
            }

            $params = [ 'vote' => $type ];

            return $this->adapter->put( sprintf('/post/%d/vote', $id ), $params );
        }

        /**
         * Добавить пост в избранное
         *
         * @param   int $id
         *
         * @return  mixed
         */
        public function addPostToFavorite( $id )
        {
            return $this->adapter->put( sprintf('/post/%d/favorite', $id ), [] );
        }

        /**
         * Удалить пост из избранного
         *
         * @param   int $id
         *
         * @return  mixed
         */
        public function removePostFromFavorite( $id )
        {
            return $this->adapter->delete( sprintf('/post/%d/favorite', $id ) );
        }
    }