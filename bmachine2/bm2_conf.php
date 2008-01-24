<?php

##
## Configuration file for Broadcast Machine 2
##

# Relative to your webserver root, where is bm2 installed?
# Remeber to change your .htaccess file when this changes.
# NOTE: If bm2 is installed in the root dir, leave this blank!
# Example: If the url is http://sample.com/apps/bm2/, then this should be /apps/bm2/
$baseUri = "/~cbryan/bmachine2/";

# What directory is bm2 installed into?
# Be sure to add the trailing slash!
$baseDir = "/home/cbryan/Code/democracy/bmachine2/";

# Should we use clean URLs?
# Is your .htaccess file correctly setup?
# Should be "Off" or "On", be careful, it's case sensitive!
$cleanUris = "On";

# Database configuration options.
# These are used by any database controller that needs to connect.
$cf_dbengine = "MySQL"; // Which engine do you want to use? (MySQL, SQLite, Postgres...)
$cf_hostname = "localhost"; // What's the hostname?
$cf_database = "bm2"; // Which database should we use?
$cf_username = "cbryan";
$cf_password = "disSero7";

?>
