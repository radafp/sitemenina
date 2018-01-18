<?php
# STEP 1
//$url = 'https://api.instagram.com/oauth/authorize/?client_id=528dd0ed99084c769c8b0e48456ff8af&redirect_uri=http://dev.web989.uni5.net&response_type=code';

# STEP 2
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
    "client_id" => 'a079cd49a8ca4c1d942304562a33d0a4',
    "client_secret" => '7a9ccab188d34f7b99feafdd41142709',
    'grant_type' => 'authorization_code',
    'redirect_uri' => 'http://www.novomenina.web7097.uni5.net',
    'code' => 'd6e34e2d0c404f68a33a4bedb30fbf83'
);
$curl = simple_curl($url, $ar);
echo $curl;
*/


#STEP 3
$userid = "3288624807";
$accessToken = "3288624807.a079cd4.51b29d589d674a88b42c9c73a38e8011";
$url = "https://api.instagram.com/v1/users/{$userid}/media/recent/?access_token={$accessToken}";
$result = file_get_contents($url);
$result = json_decode($result);

?>
 


<ul id="pictures">
<?php foreach ($result->data as $post)
{
?>
    <a class="fancybox" href="<?php echo $post->images->standard_resolution->url ?>" data-fancybox-group="gallery" title="<?php echo $post->caption->text ?>"><img src="<?php echo $post->images->thumbnail->url ?>" alt="<?php echo $post->caption->text ?>" /></a>
<?php
}
?>
</ul>

