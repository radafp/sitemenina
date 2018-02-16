 <?php
# STEP 1
//$url = 'https://api.instagram.com/oauth/authorize/?client_id=12975093f80c40c38a8719c6b908ff67&redirect_uri=http://www.portalmenina.com&response_type=code';

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
    "client_id" => '12975093f80c40c38a8719c6b908ff67',
    "client_secret" => '3ae49aecda544d398037cf4892bbfcdd',
    'grant_type' => 'authorization_code',
    'redirect_uri' => 'http://www.portalmenina.com',
    'code' => '88f5f39c0b0d47818d7dc3b0f9645cdc'
);
$curl = simple_curl($url, $ar);
echo $curl;  


  */

#STEP 3
$userid = "3251484169";
$accessToken = "3251484169.1297509.29deb66c688a4996b9ce379e1f294b1f";
$url = "https://api.instagram.com/v1/users/{$userid}/media/recent/?access_token={$accessToken}";
$result = file_get_contents($url);
$result = json_decode($result);

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

