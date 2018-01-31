<?php
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'))
{

    $userid = "1261127122";
    $accessToken = "1261127122.6d7beb5.c32b85c115d240eeb11e6ed048e9c61f";
    $url = "https://api.instagram.com/v1/users/{$userid}/media/recent/?access_token={$accessToken}";
    $result = file_get_contents($url);
    $result = json_decode($result);

    $json = array();
    foreach ($result->data as $post)
    {
        $json[] = array
                  (
                      "titulo" => $post->caption->text,
                      "link" => $post->link,
                      "imgG" => $post->images->standard_resolution->url,
                  );
    }
    die(json_encode($json));
}
?>