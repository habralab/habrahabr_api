<?php

    require_once realpath( __DIR__ . '/keys.php' );
    require_once realpath(__DIR__.'/../vendor/autoload.php');

    $adapter = new Habrahabr\Api\HttpAdapter\CurlAdapter();

    $adapter->setEndpoint( $endpoint );
    $adapter->setToken( $token );
    $adapter->setClient( $client );

    $client = new Habrahabr\Api\Client( $adapter );

    //$User          = $client->getUserResource()->getUser('rpsl');

    //var_dump( $User );
    //    $Users         = $client->getUserResource()->getUsersList( 2 );
    //    $UserComments  = $client->getUserResource()->getUserComments( 'rpsl' );
    //    $UserPosts     = $client->getUserResource()->getUserPosts( 'rpsl' );
    //    $UserHubs      = $client->getUserResource()->getUserHubs( 'rpsl' );
    //    $UserCompanies = $client->getUserResource()->getUserCompanies( 'rpsl' );
    //    $UserFollowers = $client->getUserResource()->getUserFollowers( 'rpsl' );
    //    $UserFollowed  = $client->getUserResource()->getUserFollowed('rpsl');
    //
    //    $voteKarmaPlus = $client->getUserResource()->voteKarmaPlus('habrahabr');
    //    print_r( $voteKarmaPlus );

    //    $voteKarmaMinus= $client->getUserResource()->voteKarmaMinus('habrahabr');
    //    print_r( $voteKarmaMinus );
    //


    //    $SearchPosts = $client->getSearchResource()->searchPosts('оптимизация');
    //    $SearchUsers = $client->getSearchResource()->searchUsers('habrahabr');


    //    $Post = $client->getPostResource()->getPost(2160);
    //    $VotePost = $client->getPostResource()->vote(2160, 1);
    //    $FavoritePost = $client->getPostResource()->addPostToFavorite(2160);
    //    $unFavoritePost = $client->getPostResource()->removePostFromFavorite(2160);


    //    $HubInfo = $client->getHubResource()->getHubInfo('php');
    //    $HubHabred = $client->getHubResource()->getFeedHabred('php', 2);
    //    $HubUnhabred = $client->getHubResource()->getFeedUnhabred('php',2);
    //    $HubNew = $client->getHubResource()->getFeedNew('php');

    //    print_r( $HubNew );

    //    $FeedHabred = $client->getFeedResource()->getFeedHabred();
    //    $FeedUnhabred = $client->getFeedResource()->getFeedUnhabred();
    //    $FeedNew = $client->getFeedResource()->getFeedNew();

    //    print_r( $FeedNew );

    //    $CompanyPosts = $client->getCompanyResource()->getCompanyPosts('yandex');
    //    $CompanyInfo = $client->getCompanyResource()->getCompanyInfo('yandex');

    //    print_r( $CompanyInfo );

    //    $CommentsForPost = $client->getCommentsResource()->getCommentsForPost(2160);
    //    print_r( $CommentsForPost );
    //    $PostComment = $client->getCommentsResource()->postComment(2160, 'hello habr', 6706618);
    //    print_r( $PostComment );

    //	$counters = $client->getTrackerResource()->getCounters();
    //	$posts = $client->getTrackerResource()->getPostsFeed();
    //	$subs = $client->getTrackerResource()->getSubscribersFeed();
    //	$apps = $client->getTrackerResource()->getAppsFeed();

    // $mentions = $client->getTrackerResource()->getMentions();

    // var_dump( $mentions );

//    $vote = $client->getCommentsResource()->voteForComment('000', 1 );
//
//    var_dump( $vote);

//    $hubs = $client->getHubResource()->getHubList();
//    $hubs = $client->getHubResource()->getHubCategories();
//    $hubs = $client->getHubResource()->getHubOfCategory('telecommunications');
//    $hubs = $client->getHubResource()->searchHubs('апи');
//    $hubs = $client->getHubResource()->searchHubs('web');

//    $hubs = $client->getHubResource()->unsubscribeHub('php');
    $hubs = $client->getHubResource()->subscribeHub('php');

    var_dump( $hubs );


?>
