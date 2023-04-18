<?php
$string = "The text you want to filter goes here. http://google.com, https://www.youtube.com/watch?v=K_m7NEDMrV0,https://instagram.com/hellow/";

preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $string, $match);

echo "<pre>";
print_r($match[0]); 
echo "</pre>";
die();
// Include database configuration file
require_once 'dbConfig.php';
// Include URL Shortener library file
require_once 'Shortener.class.php';

// Initialize Shortener class and pass PDO object
$shortener = new Shortener($db);

// Long URL
$longURL = get_short_url_hwe($url);


// Prefix of the short URL 
$shortURL_Prefix = 'https://xyz.com/'; // with URL rewrite
$shortURL_Prefix = ''; // without URL rewrite

try{
    // Get short code of the URL
    $shortCode = $shortener->urlToShortCode($longURL);
    
    // Create short URL
    $shortURL = $shortURL_Prefix.$shortCode;
    echo '<a href="'.$shortURL.'" target="_blank">'.$shortURL.'</a>';
    // Display short URL
   // echo 'Short URL: '.$shortURL;
    $shortURL = $shortURL_Prefix;
}catch(Exception $e){
    // Display error
    echo $e->getMessage();
}
?>