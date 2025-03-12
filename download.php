<?php
if(isset($_GET['videoUrl'])) {
    $videoUrl = $_GET['videoUrl'];

    // Check if URL is valid
    if (!filter_var($videoUrl, FILTER_VALIDATE_URL)) {
        echo json_encode(["error" => "Invalid URL"]);
        exit();
    }

    // Use cURL to fetch video source
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $videoUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $response = curl_exec($ch);
    curl_close($ch);

    // Extract video URL (Basic Regex Matching)
    preg_match('/"playable_url":"(.*?)"/', $response, $matches);

    if(isset($matches[1])) {
        $videoSrc = stripslashes($matches[1]);
        echo json_encode(["video_url" => $videoSrc]);
    } else {
        echo json_encode(["error" => "Video not found"]);
    }
}
?>

