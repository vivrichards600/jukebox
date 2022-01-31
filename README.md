# jukebox - A simple Jukebox built using PHP

This application displays music which users can browse through and select to play on as simple digital jukebox. 

![screenshot of jukebox](/assets/images/jukebox.png)

Music is placed into the `/music` folder and when `index.php` is opened the data from each .mp3 file placed into this folder is gathered. The title, artist and any album art from the file is loaded and displayed.

## Configuring the jukebox
The `settings.ini` file contains a few settings that can be altered to change the appearance of the jukebox without altering the code. For example, if you hwant to use this application on a large touch screen, within the settings file you can modify how many rows of songs to show, and how many songs per row should be displayed.

The application has a built in carousel which automatically rotates to let users browser through each page of songs. Users can also click through each page of songs by clicking on the left or right arrow on either side of the page. 

## Running the jukebox
On a windows machine with xampplite running, place this repository within the htdocs folder and then navigate to `http://localhost/jukebox/` to view and user the jukebox.
## TODO
This was created very quickly as a proof of concept and works just about. It is highly likely it will contain many bugs.

Below are some todo's which I plan to work on soon: 

* Add tests
* Add proper instructions to run this application
* Add dummy mp3s for demo site to show how this works
* clean up code / refactor - this was something thrown together as a proof of concept so will contain lots of bugs!!
* Add ability to sort by song title
* Add ability to sort by song artist
* Add ability to sort by album name
* Display a playlist to see tracks coming up next
* Remove track from playlist once it's played
