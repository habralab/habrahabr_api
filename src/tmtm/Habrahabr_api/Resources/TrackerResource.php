<?php

    namespace tmtm\Habrahabr_api\Resources;

    use tmtm\Habrahabr_api\Exception\IncorrectUsageException;

    class TrackerResource  extends abstractResource implements ResourceInterface
    {
        /**
         * @param string $title
         * @param string $text
         *
         * @throws IncorrectUsageException
         *
         * @returm mixed
         */
        public function push( $title, $text )
        {
            // @todo pre-validation title + text

            if( !is_string( $title ) || !is_string( $text ) )
            {
                throw new IncorrectUsageException('title or text invalid');
            }

            return $this->adapter->put('/tracker', [ 'title' => $title, 'text' => $text ] );
        }
    }