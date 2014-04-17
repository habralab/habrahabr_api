<?php

    namespace Habrahabr\Api\Resources;

    use Habrahabr\Api\Exception\IncorrectUsageException;

    /**
     * Ресурс работы с комментариями
     *
     * @package Habrahabr_api\Resources
     */
    class CommentsResource extends abstractResource implements ResourceInterface
    {
        const VOTE_PLUS  = 1;
        const VOTE_MINUS = -1;

        /**
         * Получение списка комментариев к посту.
         *
         * @param   int $id
         *
         * @return  mixed
         */
        public function getCommentsForPost( $id )
        {
            return $this->adapter->get( sprintf( '/comments/%d', $id ) );
        }

        /**
         * Добавление комментария
         *
         * @param   int    $post_id
         * @param   string $text
         * @param   int    $parent_id
         *
         * @return mixed
         */
        public function postComment( $post_id, $text, $parent_id = 0 )
        {
            $params = [
                'text'      => $text,
                'parent_id' => $parent_id
            ];

            return $this->adapter->put( sprintf( '/comments/%d', $post_id ), $params );
        }

        /**
         * Положительное голосование за комментарий.
         *
         * @param  int $comment_id
         *
         * @return mixed
         *
         * @throws \tmtm\Habrahabr_api\Exception\IncorrectUsageException
         */
        public function votePlus( $comment_id )
        {
            return $this->vote( $comment_id, self::VOTE_PLUS );
        }

        /**
         * Отрицательное голосование за комментарий.
         *
         * @param  int $comment_id
         *
         * @return mixed
         *
         * @throws \tmtm\Habrahabr_api\Exception\IncorrectUsageException
         */
        public function voteMinus( $comment_id )
        {
            return $this->vote( $comment_id, self::VOTE_MINUS );
        }

        /**
         * Голосование за комментарий.
         *
         * @param   int $comment_id
         * @param   int $vote
         *
         * @return  mixed
         *
         * @throws \Habrahabr\Api\Exception\IncorrectUsageException
         */
        private function vote( $comment_id, $vote )
        {
            if( !in_array( $vote, [ self::VOTE_MINUS, self::VOTE_PLUS ], true ) )
            {
                throw new IncorrectUsageException( 'vote type incorrect, must be (int) 1 || (int) -1' );
            }

            $params = [
                'vote' => $vote
            ];

            return $this->adapter->put( sprintf('/comments/%d/vote', $comment_id ), $params );
        }
    }