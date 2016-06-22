# ShellScrape

Syntax: php shellScrape.php

Flags: -f    - No tor. f stands for fast.

Output stored in sitesWithShells.txt

Requirements:

	* PHP 5 (sudo apt-get install php5)
	
	* Tor proxy running locally (See Tor proxy section) unless using -f
	
	* Linux (or a variant. Tested on Ubuntu 14.04 LTS)
	
	* Curl for php. (sudo apt-get install php5-curl. Also restart your webserver afterwards)
	
	* Put some sites in sites.txt. These are the sites that will be checked
	
	* Add directories to dirs.txt in the format specified below
	
	* Add shell file names to shells.txt in the format specified below

Some notes
----------

Dirs and Shells in dirs.txt and shells.txt have been removed for a little more security. No point in making things too easy.

Update sites.txt with sites you want to include in the scrape.

Every result in sitesWithShells.txt should me manually validated using the tor
browser or through a tor proxy. If you have used the -f flag, use whatever you like to validate.

shellScrape currently takes input from sites.txt, dirs.txt and shells.txt.

sites.txt: a list of sites to scan for shells. Should include https:// or http:// but NOT a slash at the end. E.g http://www.some-site.org
dirs.txt: a list of directories to look in. Should have forward slashes at both ends
shells.txt: a list of shells to look for. No slashes please. It'll not work.

Output is... well, output into sitesWithShells.txt. This will only show sites
that have returned a 200 response code for the requested shell.

Tor proxy
---------

shellScrape can run through tor in order to maintain anonymity. To start
a Tor proxy on your shiny linux box, you must first install it.

	sudo apt-get install tor

Once the installation is complete, type the following in a terminal.

	sudo /etc/init.d/tor start

Congratulations! You're now running Tor.

A good thing to do at this stage is to make sure Tor is running on port
9050 as is required by shellScrape when not using the -f flag.

	netstat -atp

Look for localhost:9050 in (likely long) list. If it's not there, please
find a solution on Google.
