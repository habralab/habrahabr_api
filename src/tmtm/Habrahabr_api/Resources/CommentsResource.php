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
         * @param   int $comment_id
         * @param   int $mark
         *
         * @return  mixed
         *
         * @throws \tmtm\Habrahabr_api\Exception\IncorrectUsageException
         */
        public function voteForComment( $comment_id, $mark )
        {
            if( !in_array( $mark, [ -1, 1 ], true ) )
            {
                throw new IncorrectUsageException( 'vote type incorrect, must be (int) 1 || (int) -1' );
            }

            $params = [
                'vote' => $mark
            ];

            return $this->adapter->put( sprintf('/comments/%d/vote', $comment_id ), $params );
        }
    }