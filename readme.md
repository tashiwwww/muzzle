#Muzzle, the audio file browser

##What is Muzzle?
This project contains the necessary javascript, php, and css files to set up a website that lists audio files in a given directory and makes them playable in a web browser.

##Requirements
###To host

*	A webserver with PHP
*	OGG or MP3 files stored as: MUSIC_DIR/artist/album/song.mp3
Tested on Apache on Linux and Windows.

###To access

*	Best results with Webkit-based browsers (Chrome, Safari, etc)
*	Seekbar and volume controls not functional in Firefox, but playback works.

##How to use?
*	The music directory can be specified in "config.php" but must be in the format of MUSIC_DIR/artist/album/song.mp3
*	Store lyrics with the same filename as the song as a .txt to be automatically displayed on the site during playback.

##Current Features
*   Loop toggle
*   Seeking
*   Lyrics

##Planned Features
*   Easy theming
*   Playlists
*   Timestamps in lyrics/lyrics scroll
