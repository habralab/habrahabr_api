<?php

    namespace tmtm\Habrahabr_api\Resources;

    use tmtm\Habrahabr_api\Exception\IncorrectUsageException;

    /**
     * Ресурс работы с комментариями
     *
     * @package Habrahabr_api\Resources
     */
    class CommentsResource extends abstractResource implements ResourceInterface
    {
        const VOTE_PLUS = 1;
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
         * Голосование за комментарий.
         *
         * @param   int $id
         * @param   int $vote
         *
         * @return  mixed
         *
         * @throws \tmtm\Habrahabr_api\Exception\IncorrectUsageException
         */
        public function vote( $id, $vote )
        {
            if( !in_array( $vote, [ self::VOTE_MINUS, self::VOTE_PLUS ], true ) )
            {
                throw new IncorrectUsageException( 'vote type incorrect, must be (int) 1 || (int) -1' );
            }

            $params = [
                'vote' => $vote
            ];

            return $this->adapter->put( sprintf('/comments/%d/vote', $id ), $params );
        }

        /**
         * @see vote()
         *
         * @param $id
         *
         * @return mixed
         * @throws \tmtm\Habrahabr_api\Exception\IncorrectUsageException
         */
        public function votePlus( $id )
        {
            return $this->vote( $id, self::VOTE_PLUS );
        }

        /**
         * @see vote()
         *
         * @param $id
         *
         * @return mixed
         * @throws \tmtm\Habrahabr_api\Exception\IncorrectUsageException
         */
        public function voteMinus( $id )
        {
            return $this->vote( $id, self::VOTE_MINUS );
        }
    }