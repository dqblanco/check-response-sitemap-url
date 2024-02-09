# How to check the response code of a sitemap urls
[![License: GPL v3](https://img.shields.io/badge/License-GPLv3-blue.svg)](https://www.gnu.org/licenses/gpl-3.0)

The following script helps us to know the response code of the urls of a sitemap. 

With the HTTP response code, we can determine whether the URL is available or if it
has an execution error. Knowing if the response code of our URLs published in the sitemap responds correctly is crucial, as it can significantly impact our SEO. Many unanswered URLs can pose a serious SEO problem.

## Technical requirements

* Docker version 25.0.2, build 29cf629
* Docker Compose version v2.20.2-desktop.1
* git version 2.34.1

## How to do the installation
* Clone the project.  `git clone https://github.com/dqblanco/check-response-sitemap-url.git`
* To allow different users to work with the same permissions within containers and your FS (your user), 
you must create the .env file in the **docker** directory with the permissions of your local user.
You can run the command `id | awk -e '{print $1":"$2}'` to find out the permissions of your host user.

Example .env file
```
UID=1000
GID=1000
```
* Enter the **docker** folder and run the command `docker compose up -d` to start the containers
* Enter the container with the command `docker exec -it check-sitemap-workspace bash`
* Run `composer install`
* Run `chmod +x bin/console`
* And finally run `bin/console check-url-sitemap:check urlSiteMap`  

:gift: [David Quinones]( https://github.com/dqblanco).
