<?php

    namespace Habrahabr\Api\Resources;

    use Habrahabr\Api\Exception\IncorrectUsageException;

    /**
     * Ресурс работы с постами
     *
     * @package Habrahabr_api\Resources
     */
    class PostResource extends abstractResource implements ResourceInterface
    {
        const VOTE_PLUS    = 1;
        const VOTE_NEUTRAL = 0;
        const VOTE_MINUS   = -1;

        /**
         * Получение поста по его id. ( без комментариев )
         *
         * @param   int $id
         *
         * @return  mixed
         */
        public function getPost( $id )
        {
            return $this->adapter->get( sprintf( '/post/%d', $id ) );
        }

        /**
         * Положительное за пост.
         *
         * Этот метод может быть предоставлен дополнительно, по запросу.
         * http://habrahabr.ru/feedback/

         * @param $id
         *
         * @return mixed
         * @throws \Habrahabr\Api\Exception\IncorrectUsageException
         */
        public function votePlus( $id )
        {
            return $this->vote( $id, self::VOTE_PLUS );
        }

        /**
         * Отрицательное голосование за пост.
         *
         * Этот метод может быть предоставлен дополнительно, по запросу.
         * http://habrahabr.ru/feedback/

         * @param $id
         *
         * @return mixed
         *
         * @throws \Habrahabr\Api\Exception\IncorrectUsageException
         */
        public function voteMinus( $id )
        {
            return $this->vote( $id, self::VOTE_PLUS );
        }

        /**
         * Нейтральное голосование за пост.
         *
         * Этот метод может быть предоставлен дополнительно, по запросу.
         * http://habrahabr.ru/feedback/

         * @param $id
         *
         * @return mixed
         * @throws \Habrahabr\Api\Exception\IncorrectUsageException
         */
        public function voteNeutral( $id )
        {
            return $this->vote( $id, self::VOTE_NEUTRAL );
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
            return $this->adapter->put( sprintf( '/post/%d/favorite', $id ) );
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
            return $this->adapter->delete( sprintf( '/post/%d/favorite', $id ) );
        }

        /**
         * Голосование за пост.
         *
         * Этот метод может быть предоставлен дополнительно, по запросу.
         * http://habrahabr.ru/feedback/
         *
         * @param   int $id
         * @param   int $vote [ -1, 0, 1 ]
         *
         * @return mixed
         *
         * @throws \Habrahabr\Api\Exception\IncorrectUsageException
         */
        private function vote( $id, $vote )
        {
            if( !in_array( $vote, [ self::VOTE_MINUS, self::VOTE_NEUTRAL, self::VOTE_PLUS ], true ) )
            {
                throw new IncorrectUsageException( 'vote type incorrect, must be (int) 1 || (int) -1 || (int) 0' );
            }

            $params = [ 'vote' => $vote ];

            return $this->adapter->put( sprintf( '/post/%d/vote', $id ), $params );
        }
    }