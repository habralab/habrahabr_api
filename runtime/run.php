<?php

    require_once realpath( __DIR__ . '/keys.php' );
    require_once realpath(__DIR__.'/../vendor/autoload.php');

    $adapter = new \tmtm\Habrahabr_api\HttpAdapter\CurlAdapter();

    $adapter->setEndpoint( $endpoint );
    $adapter->setToken( $token );
    $adapter->setClient( $client );

    $Api = new \tmtm\Habrahabr_api\Api( $adapter );

    $User          = $Api->getUserResource()->getUser('rpsl');

    var_dump( $User );
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
    //    $PostComment = $Api->getCommentsResource()->postComment(2160, 'hello habr', 6706618);
    //    print_r( $PostComment );

    //	$counters = $Api->getTrackerResource()->getCounters();
    //	$posts = $Api->getTrackerResource()->getPostsFeed();
    //	$subs = $Api->getTrackerResource()->getSubscribersFeed();
    //	$apps = $Api->getTrackerResource()->getAppsFeed();

    // $mentions = $Api->getTrackerResource()->getMentions();

    // var_dump( $mentions );
