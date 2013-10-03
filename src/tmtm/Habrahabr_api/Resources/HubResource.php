<?php

    namespace tmtm\Habrahabr_api\Resources;

    use tmtm\Habrahabr_api\Exception\IncorrectUsageException;

    /**
     * Ресурс для работы с Хабами
     *
     * @package Habrahabr_api\Resources
     */
    class HubResource  extends abstractResource implements ResourceInterface
    {
        /**
         * Получение информации о хабе по алиасу.
         *
         * @param string $alias
         *
         * @throws IncorrectUsageException
         *
         * @return mixed
         */
        public function getHubInfo( $alias )
        {
            $this->checkAliasName( $alias );

            return $this->adapter->get( sprintf('/hub/%s/info', $alias ) );
        }

        /**
         * Получение ленты хаба, с пагинацией, фильтр "Захабренные"
         *
         * @param   string  $alias
         * @param   int     $page
         *
         * @throws IncorrectUsageException
         *
         * @return mixed
         */
        public function getFeedHabred( $alias, $page = 1 )
        {
            $this->checkAliasName( $alias );

            return $this->adapter->get( sprintf('/hub/%s/habred?page=%d', $alias, $page ) );
        }

        /**
         * Получение ленты хаба, с пагинацией, фильтр "Отхабренные"
         *
         * @param   string  $alias
         * @param   int     $page
         *
         * @throws IncorrectUsageException
         *
         * @return mixed
         */
        public function getFeedUnhabred( $alias, $page = 1 )
        {
            $this->checkAliasName( $alias );

            return $this->adapter->get( sprintf('/hub/%s/unhabred?page=%d', $alias, $page ) );

        }

        /**
         * Получение ленты хаба, с пагинацией, фильтр "Новые"
         *
         * @param   string  $alias
         * @param   int     $page
         *
         * @throws IncorrectUsageException
         *
         * @return mixed
         */
        public function getFeedNew( $alias, $page = 1 )
        {
            $this->checkAliasName( $alias );

            return $this->adapter->get( sprintf('/hub/%s/new?page=%d', $alias, $page ) );

        }

        /**
         * @param   string $alias
         *
         * @throws \tmtm\Habrahabr_api\Exception\IncorrectUsageException
         */
        private function checkAliasName( $alias )
        {
            if( !preg_match('/^[a-z0-9\-_]+$/i', $alias) )
            {
                throw new IncorrectUsageException('bad alias - ' . $alias );
            }
        }
    }