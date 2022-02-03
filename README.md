# jukebox - A simple Jukebox built using PHP

This application displays music which users can browse through and select to play within this simple digital jukebox. 

![screenshot of jukebox](/assets/images/jukebox.png)

Create a `music` folder within `assets`. Music is placed into the `/music` folder and when the application is opened the data from each .mp3 file placed into this folder is gathered. The title, artist and any album art from the file is loaded and displayed.

The jukebox will automatically select and play a song after 10 minutes of no interactions if no song is currently playing and if there are no songs in the playlist ready to be played.

## Configuring the jukebox
The `settings.ini` file contains a few settings that can be altered to change the appearance of the jukebox without altering the code. For example, if you want to use this application on a large touch screen, within the settings file you can modify how many rows of songs to show, and how many songs per row should be displayed.

The application has a built in carousel which automatically rotates to let users view each page of songs. Users can also click through each page of songs by clicking on the left or right arrow on either side of the page. 

## Running the jukebox
On a windows machine with xampplite running, place this repository within the htdocs folder and then navigate to `http://localhost/jukebox/` to view and use the jukebox.
## TODO
This was created very quickly as a proof of concept and works just about. It is highly likely it will contain many bugs.

Below are some todo's which I plan to work on soon: 

* Add tests
* Fix the weird html characters displayed when showing music title, artist and album test
* Add proper instructions to run this application
* Add dummy mp3s to demonstrate how this application looks like and how it works
* clean up code / refactor
* Add ability to sort by song title
* Add ability to sort by song artist
* Add ability to sort by album name
