<?php


    require_once realpath( __DIR__ .'/../src/autoload.php' );
//    require_once realpath(__DIR__.'/../vendor/autoload.php');

    $adapter = new \Habrahabr_api\HttpAdapter\HttpRequestAdapter();

    $adapter->setEndpoint('http://api.rpsl.habratest.net/v1');
    $adapter->setToken('55e1f222a8fb50fa7e500b443e0075d48bf21297');
    $adapter->setClient('252370d0d156958.66501983');

    $Api = new \Habrahabr_api\Habrahabr_api( $adapter );

//    $User          = $Api->getUserResource()->getUser( 'rpsl' );
//    $Users         = $Api->getUserResource()->getUsersList( 2 );
//    $UserComments  = $Api->getUserResource()->getUserComments( 'rpsl' );
//    $UserPosts     = $Api->getUserResource()->getUserPosts( 'rpsl' );
//    $UserHubs      = $Api->getUserResource()->getUserHubs( 'rpsl' );
//    $UserCompanies = $Api->getUserResource()->getUserCompanies( 'rpsl' );
//    $UserFollowers = $Api->getUserResource()->getUserFollowers( 'rpsl' );
//    $UserFollowed  = $Api->getUserResource()->getUserFollowed('rpsl');
//
//    $voteKarmaPlus = $Api->getUserResource()->voteKarmaPlus('habrahabr');
//    print_r( $voteKarmaPlus );
//
//    $voteKarmaMinus= $Api->getUserResource()->voteKarmaMinus('habrahabr');
//    print_r( $voteKarmaMinus );
//


//    $SearchPosts = $Api->getSearchResource()->searchPosts('оптимизация');
//    $SearchUsers = $Api->getSearchResource()->searchUsers('habrahabr');


//    $Post = $Api->getPostResource()->getPost(2160);
//    $VotePost = $Api->getPostResource()->vote(2160, 1);
//    $FavoritePost = $Api->getPostResource()->addPostToFavorite(2160);
//    $unFavoritePost = $Api->getPostResource()->removePostFromFavorite(2160);


//    $HubInfo = $Api->getHubResource()->getHubInfo('php');
//    $HubHabred = $Api->getHubResource()->getFeedHabred('php', 2);
//    $HubUnhabred = $Api->getHubResource()->getFeedUnhabred('php',2);
//    $HubNew = $Api->getHubResource()->getFeedNew('php');

//    print_r( $HubNew );

//    $FeedHabred = $Api->getFeedResource()->getFeedHabred();
//    $FeedUnhabred = $Api->getFeedResource()->getFeedUnhabred();
//    $FeedNew = $Api->getFeedResource()->getFeedNew();

//    print_r( $FeedNew );

//    $CompanyPosts = $Api->getCompanyResource()->getCompanyPosts('yandex');
//    $CompanyInfo = $Api->getCompanyResource()->getCompanyInfo('yandex');

//    print_r( $CompanyInfo );

//    $CommentsForPost = $Api->getCommentsResource()->getCommentsForPost(2160);
//    print_r( $CommentsForPost );
    $PostComment = $Api->getCommentsResource()->postComment(2160, 'hello habr', 6706618);
    print_r( $PostComment );

