<?php
# STEP 1
//$url = 'https://api.instagram.com/oauth/authorize/?client_id=6d7beb559b12427ebfe57f74bd7ff835&redirect_uri=http://www.portalmenina.com&response_type=code';

#STEP 2

/* 
function simple_curl($url,$post=array(),$get=array())
{
    $url = explode('?',$url,2);
    if(count($url)===2)
    {
            $temp_get = array();
            parse_str($url[1],$temp_get);
            $get = array_merge($get,$temp_get);
    }

    $ch = curl_init($url[0]."?".http_build_query($get));
    echo $ch; 
    curl_setopt ($ch, CURLOPT_POST, 1);
    curl_setopt ($ch, CURLOPT_POSTFIELDS, http_build_query($post));
    curl_setopt($ch,CURLOPT_TIMEOUT,0); 
    //curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    return curl_exec ($ch);
}
$url = 'https://api.instagram.com/oauth/access_token/';

$ar = array
(
    "client_id" => '6d7beb559b12427ebfe57f74bd7ff835',
    "client_secret" => '67ee93c95d6a4e049b3453d303c75f10',
    'grant_type' => 'authorization_code',
    'redirect_uri' => 'http://www.portalmenina.com',
    'code' => 'ac73da12aa984699baa98d089a163b9c'
);
$curl = simple_curl($url, $ar);
echo $curl;  
*/



#STEP 3
$userid = "1261127122";
$accessToken = "1261127122.6d7beb5.7ca0e32270444670a075b73f2e68113e";
$url = "https://api.instagram.com/v1/users/{$userid}/media/recent/?access_token={$accessToken}";
$result = file_get_contents($url);
$result = json_decode($result);

/*
echo "<pre>";
var_dump($result);
echo "</pre>";
*/
?>
 

<ul id="pictures">
<?php foreach ($result->data as $post)
{
?>
    <a class="fancybox" href="<?php echo $post->images->standard_resolution->url ?>" data-fancybox-group="gallery" title="<?php echo $post->caption->text ?>">
        <img src="<?php echo $post->images->low_resolution->url ?>" alt="<?php echo $post->caption->text ?>" />
    </a>
<?php
}
?>
</ul>
<?
 
?>

