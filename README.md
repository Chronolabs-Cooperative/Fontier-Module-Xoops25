# Fontier+ 1.01
## Client for Chronolabs Cooperative ~ Fonting Repository Services API
### Author: Simon Antony Roberts (Sydney) <wishcraft@users.sourceforge.net>

This module is a client for the XOOPS Platform which is for the Fonting Repository Services API (ie. http://api.fonts4web.org.uk). This client will download from the repository a list of the supported fonts and set a browsable display for them on the website you are operating on with XOOPS 2.5.

It uses the XoopsCache to cache preview, naming cards as well as details and stores some information in the browser, it does clean the cache and you have two options to fire the module either with a cronjob or leave it to execute it batch of tasks with the preloaders in XOOPS Framework 2.5

## Installation

Download the resource for this module and install, then point and configure the path for the API in the preferences of the module, that should be all you need to do!

## Search Engine Friendly URLS (rewrite)

If you are using .htaccess with apache there is a mod-rewrite function in the preferences the following .htaccess goes in the root of your XOOPS_ROOT_PATH spot as .htaccess the following is to be copied into there:-
 
     RewriteEngine On
     RewriteRule ^fontier/index.html                  		./modules/fontier/index.php                           	[L,NC,QSA]
     RewriteRule ^fontier/([0-9]+)/([0-9]+)/(.*?)/index.html 	./modules/fontier/index.php?start=$1&limit=$2&base=$3 	[L,NC,QSA]
     RewriteRule ^fontier/uploads.html$                      	./modules/convert/uploads.php                          	[L,NC,QSA]
     RewriteRule ^fontier/releases.html$                     	./modules/convert/releases.php                         	[L,NC,QSA]
     RewriteRule ^fontier/(.*?)                          	./modules/fontier/$1                            	[L,NC,QSA]

## Maintenance & Scheduled Actions

There is two options in this module for the maintanence and scheduled actions, you can either set in the preferences how often they fire with XOOPS Preloaders, or you can use a Linux Cronjob or Windows Scheduled Task, the following crontab is what you would set if you are using cronjobs, you would specify this in the module preferences.

     */25 * * * * /usr/bin/php -q /var/www/xoops-site/modules/fontier/identities.php >/dev/null 2>&1
     */15 * * * * /usr/bin/php -q /var/www/xoops-site/modules/fontier/polling.php >/dev/null 2>&1
     */35 * * * * /usr/bin/php -q /var/www/xoops-site/modules/fontier/glyphs.php >/dev/null 2>&1
     */45 * * * * /usr/bin/php -q /var/www/xoops-site/modules/fontier/caching.php >/dev/null 2>&1
