<?php

session_start();
require_once("twitteroauth.php"); //Path to twitteroauth library

/*$twitteruser = $_GET['SarGlobal'];
$notweets = $_GET['limit'];
$consumerkey = "2pkD5bT43h1QLvtwxNQbErnTY";
$consumersecret = "QNmsttWLf5woXLbLd9TUELW78CkgsmsivBgXsBUIynFfcoB3BB";
$accesstoken = "1338496465-Pn3jX6cLNzsLoiTTSFowrJbww0SxIXZ1yopaJAW";
$accesstokensecret = "HPnHAgrJ959oibdFACllju7dK10C6Z13ZILCCMXbKqubC";*/

$twitteruser = $_GET['m_akbarsarwar'];
$notweets = $_GET['limit'];
$consumerkey = "u6mMHlnOM4nPIyJ4gHGTUrQmc";
$consumersecret = "OrFA1deCvZs9ayFTGrB7pgCNfDoohTqifJQAMVgb1l3DTVzIqd";
$accesstoken = "4061694274-xCUUegr4a9KPI9OW0OpHezmqQyAxSVl5g9RuAHg";
$accesstokensecret = "dZksqHmqN7ZyeB1xHmcctws6Yf4nGuKw6U8cbawmkM5ol";

function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
    $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
    return $connection;
}

$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);

// if username isn't array check if user separated usernames with comma
if (!is_array($twitteruser))
    $twitteruser = explode(',', trim($twitteruser));

if (count($twitteruser) > 1) {
    
    $all_tweets = array();
    $remainder = $notweets % count($twitteruser);
    $tweets_per_user = floor($notweets / count($twitteruser));    
    
    // split tweets per user so it doesn't exceed limit
    foreach ($twitteruser as $user) {
        if ($remainder > 0) {
            $notweets = $tweets_per_user + $remainder;
        } else {
            $notweets = $tweets_per_user;
        }

        // get tweets
        $tweets[] = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=" . $user . "&count=" . $notweets);
    }
    
    // merge into one array
    $all_tweets = $tweets[0];
    for ($i = 1; $i < count($tweets); $i++) {
        $all_tweets = array_merge($all_tweets, $tweets[$i]);
    }
} else {
    $all_tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=" . $twitteruser[0] . "&count=" . $notweets);
}


header('content-type: application/json');
echo json_encode($all_tweets);
exit();
?>