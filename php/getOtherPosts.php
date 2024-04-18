<?php
$remoteUrl = 'https://www.041er-blj.ch/2023/blogs/yannick/php/api.php';

$response = file_get_contents($remoteUrl);

if ($response === false) {
    // Handle error if the request fails
    die('Error fetching data');
}


$postsData = json_decode($response, true);



if ($postsData === null) {

    die('Error decoding JSON');
}


?>