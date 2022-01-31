<?php
// load settings file
$config = parse_ini_file('settings.ini');

$background_colour = $config['background_colour'];
$rows_to_display = $config['rows_to_display'];
$tracks_per_row =  $config['tracks_per_row'];
$track_card_size = $config['track_card_size'];
$song_artist_title_font_size = $config['song_artist_title_font_size'];
$song_album_font_size = $config['song_album_font_size'];


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
// usort($songs, function($a, $b) { //Sort the array using a user defined function
//     return $a->name > $b->name ? -1 : 1; //Compare the names
// });                                                                                                                                                                                                        

// obtains a random song
//$randomSong = getRandomSong($songs);

// ID3 engine https://github.com/JamesHeinrich/getID3/blob/master/demos/demo.basic.php
// include getID3() library (can be in a different directory if full path is specified)
require("getid3/getid3.php");

// Initialize getID3 engine
$getID3 = new getID3;
?>
<html>

<head>
    <title></title>
    <!-- Load FontAwesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

    <meta http-equiv="Content-Type" content="text/html charset=UTF-8" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


    <!-- CSS style for audio player div -->
    <style>
        body {
            color: white;
            background-color: <?php echo $background_colour; ?>;
            text-transform: capitalize;
            /* overflow: hidden; */
        }

        .track-art {
            /* margin: 25px; */
            height: 75px;
            width: 75px;
            float: left;
            margin: 0 25px 0 0;

        }

        .player-controls {
            margin: 25px 0px;
        }



        .slider_container {
            width: 75%;
            max-width: 400px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Modify the appearance of the slider */
        .seek_slider,
        .volume_slider {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            height: 5px;
            background: white;
            opacity: 0.7;
            -webkit-transition: .2s;
            transition: opacity .2s;
        }

        /* Modify the appearance of the slider thumb */
        .seek_slider::-webkit-slider-thumb,
        .volume_slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            width: 15px;
            height: 15px;
            background: white;
            cursor: pointer;
            border-radius: 50%;
        }

        .seek_slider:hover,
        .volume_slider:hover {
            opacity: 1.0;
        }

        .seek_slider {
            width: 55%;
            margin-top: 15px;
        }

        .volume_slider {
            width: 15%;
        }

        .current-time,
        .total-duration {
            padding: 10px;
        }

        .current-time {
            padding-left: 100px;
        }

        .seek-and-volume {
            width: 100%;
            float: left;
        }

        i.fa-volume-down,
        i.fa-volume-up {
            padding: 10px;
        }

        .card-body {
            color: black;
            min-height: 110px;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 70px;
        }

        .card {
            text-align: center;
            border: none;
        }

        img.card-img-top {
            min-height: 220px;
        }

        .btn {
            width: 100%;
            border-radius: 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        marquee {
            width: 300px;
            min-width: 300px;
            float: left;
        }

        h5 {
            font-size: <?php echo $song_artist_title_font_size; ?>;
        }

        .card-text {
            font-size: <?php echo $song_album_font_size; ?>;
        }
    </style>
</head>

<body>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    <div class="container-xxl">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="90000">
            <div class="carousel-inner">


                <?php
                // number of rows to show per screen
                $numberOfRows = 0;

                // counter so we add 5 cards per row
                $firstRow = 0;
                $itemsInRow = 0;

                // loop through all songs in music directory
                for ($i = 0; $i < count($songs); $i++) {

                    // get song information
                    $song = $getID3->analyze($songs[$i]);

                    $carouselActiveClass = '';
                    if ($firstRow == 0) {
                        $carouselActiveClass = ' active';
                        $firstRow = 1;
                    }

                    if ($numberOfRows == 0 && $itemsInRow == 0) {
                        echo '<div class="carousel-item' . $carouselActiveClass . '">';
                    }

                    // add a new row for cards
                    if ($itemsInRow == 0) {
                        echo '<div class="row mt-4">';
                    }

                    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($song['comments']['picture'][0]['data']);

                ?>

                    <div class="col">
                        <div class="card" style="width: <?php echo $track_card_size; ?>">

                            <img alt="<?php echo $song['tags']['id3v2']['album'][0]; ?> Album Art" class="card-img-top" src="<?php if ($base64 != 'data:image/;base64,') {
                                                                                                                                    echo $base64;
                                                                                                                                } else {
                                                                                                                                    echo 'assets/images/no-album-art.png';
                                                                                                                                } ?>" />
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $song['tags']['id3v2']['artist'][0]; ?> - <?php echo $song['tags']['id3v2']['title'][0]; ?></h5>
                                <p class="card-text">Album: <?php
                                                            $album = 'Unknown';
                                                            if ($song['tags']['id3v2']['album'][0] != '') {
                                                                $album = $song['tags']['id3v2']['album'][0];
                                                            }
                                                            echo $album;
                                                            ?></p>
                            </div>
                            <a href="#" class="btn btn-primary" data-artist="<?php echo $song['tags']['id3v2']['artist'][0]; ?>" data-image="<?php echo $base64; ?>" data-title="<?php echo $song['tags']['id3v2']['title'][0]; ?>" data-file-path="<?php echo $song['filename']; ?>" onclick="addTrackToPlaylist(this);">Select (<?php echo $song['playtime_string']; ?>)</a>

                        </div>
                    </div>



                    <?php

                    // while in the for loop
                    // we've just added a card to increase loop count for items in row
                    $itemsInRow += 1;

                    // when we have max cards in row then close div
                    if ($itemsInRow == $tracks_per_row) {
                        echo '</div>';
                        $itemsInRow = 0;
                        $numberOfRows += 1;
                    }

                    if ($itemsInRow == 0 && $numberOfRows >= $rows_to_display) {
                        echo '</div>';
                        $numberOfRows = 0;
                    }

                    ?>


                <?php }   ?>


                <script>
                    function addTrackToPlaylist(element) {
                        var title = element.getAttribute('data-title');
                        var artist = element.getAttribute('data-artist');
                        var path = "music/" + element.getAttribute('data-file-path');
                        var image = element.getAttribute('data-image');


                        var track = {
                            "name": title,
                            "artist": artist,
                            "path": path,
                            "image": image
                        }
                        track_list.push(track);
                        if (!isPlaying) nextTrack();

                        // update how many tracks in playlist
                        now_playing.textContent = "PLAYING " + (track_index + 1) + " OF " + track_list.length;

                    }
                </script>

            </div>

        </div>
    </div>
    </div>
    <div>
        <div class="player-controls">
            <img class="track-art" alt="song art" src="assets/images/no-track.png" />

            <h4>Now Playing:</h4>
            <marquee scrollamount="4">
                <span class="track-artist"></span><span class="track-name"></span>
            </marquee>
            <div class="seek-and-volume"><span class="current-time">00:00</span><span class="total-duration">0:00</span>
                <input type="range" min="1" max="100" value="0" class="seek_slider" onchange="seekTo()">
                <i class="fa fa-volume-down"></i>
                <input type="range" min="1" max="100" value="99" class="volume_slider" onchange="setVolume()">
                <i class="fa fa-volume-up"></i>
            </div>

            <div class="slider_container" style="display:none;">
                <i class="fa fa-volume-down"></i>
                <input type="range" min="1" max="100" value="99" class="volume_slider" onchange="setVolume()">
                <i class="fa fa-volume-up"></i>
            </div>
            <div class="now-playing" style="display:none;">PLAYING x OF y</div>
        </div>

        </footer>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="assets/music-player.js"></script>
</body>

</html>