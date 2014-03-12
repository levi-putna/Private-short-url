#Private-short-url
A private self hosted short url manager

#System requirements:
apache2
php 5.4
mysql 5.1
grunt
Bower

#Setup development environment

##Bower

###Setup
Bower is used as a package manager. You will need to install Bower globally using npm:

    npm install -g bower

Also make sure that git is installed as some bower packages require it to be fetched and installed.

###Install packages and dependence
Then initialise all packages and dependence:

    bower install

We are using a custom install location for Bower packages and dependence, see `.bowercc`

##Database Setup

1. Create an empty database for the project.
2. Confider the connection settings in `/protected/config/db.php`
3. Run the database migration to setup and migrate the database


    ./protected/yiic migrate

##Create admin account
Run the following commend and follow the instructions to create an admin account

    ./protected/yiic admin create

##Grunt

###Setup
In order to get started, you'll want to install Grunt's command line interface (CLI) globally. You may need to use
sudo (for OSX, nix, BSD etc) or run your command shell as Administrator (for Windows) to do this.

    npm install -g grunt-cli

This will put the grunt command in your system path, allowing it to be run from any directory.
Note that installing grunt-cli does not install the Grunt task runner! The job of the Grunt CLI is simple: run the version of Grunt which has been installed next to a Gruntfile. This allows multiple versions of Grunt to be installed on the same machine simultaneously.

###Build
LESS and JavaScript needs to be build before you can run the site, we simply need to run a single command to make Grunt start watching our files.

    grunt watch

Run this command (in your project’s root directory) anytime you want Grunt to start watching your files. To stop the process, simply use control + c on your keyboard.

#File Structure
'/public' is documentroot of site

There are few folders that should be writable by apache

/protected/runtime/
/public/images/
/public/uploads/
