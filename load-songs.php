<?php

function loadSongs()
{
    return glob("music/*.mp3");
}

function getRandomSong($songs)
{
    return $songs[array_rand($songs)];
}

$songs = loadSongs();

// // by default sorts by artist, below sorts by song title (name)
usort($songs, function($a, $b) { //Sort the array using a user defined function
    return $a->name > $b->name ? -1 : 1; //Compare the names
});                                                                                                                                                                                                        

// obtains a random song
//$randomSong = getRandomSong($songs);

// ID3 engine https://github.com/JamesHeinrich/getID3/blob/master/demos/demo.basic.php
// include getID3() library (can be in a different directory if full path is specified)
require("getid3/getid3.php");

// Initialize getID3 engine
$getID3 = new getID3;

function htmlToPlainText($str){
    $str = str_replace('&nbsp;', ' ', $str);
    $str = html_entity_decode($str, ENT_QUOTES | ENT_COMPAT , 'UTF-8');
    // $str = html_entity_decode($str, ENT_HTML5, 'UTF-8');
    $str = html_entity_decode($str);
    $str = htmlspecialchars_decode($str);
    $str = strip_tags($str);

    return $str;
}
