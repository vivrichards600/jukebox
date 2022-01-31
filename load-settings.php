<?php
// load settings file
$config = parse_ini_file('settings.ini');

$background_colour = $config['background_colour'];
$rows_to_display = $config['rows_to_display'];
$tracks_per_row =  $config['tracks_per_row'];
$track_card_size = $config['track_card_size'];
$song_artist_title_font_size = $config['song_artist_title_font_size'];
$song_album_font_size = $config['song_album_font_size'];
