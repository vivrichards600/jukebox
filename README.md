# jukebox - A simple Jukebox built using PHP

This repository displays music dropped into the `/music` folder like a digital jukebox. 

This 'Jukebox' will load the data from each mp3 file in order to find the title, album and cover art to display within the site. 

Below are some todo's, some big, some nice to have's. This site works but might contain lots of issues and there is ZERO test coverage!!! 

To modify the number of rows, songs displayed on the page see the `settings.ini` file. Here various settings can be altered without altering the code, so if you have a bigger touch screen for example then you can modify how many songs to play per page.

## TODO
* Add tests
* Add proper instructions to run this (currently I place this repo within htdocs of xampplite which is running locally on a windows machine and then navigate to `index.php`  to open the Jukebox
* Add dummy mp3s for demo site to show how this works
* clean up code / refactor - this was something thrown together as a proof of concept so will contain lots of bugs!!
* Add ability to sort by song title
* Add ability to sort by song artist
* Add ability to sort by album name
* Display a playlist to see tracks coming up next
* Remove track from playlist once it's played

