# Web skeleton
Web skeleton ready to work with Slim and SASS

Template is ready to execute
```shell
composer install
```

and 
```shell
npm install
```
and it will include all vendor and npm packages.

<p id="console">If you want to execute gulp from your console you need to install it first (I prefer using it directly from the IDE):</p>

```shell
npm install --global gulp-cli
```

###Files hierarchy

<div>I've configured this skeleton to split backend (private) part from frontend (public) part.</div>

![Tree view](http://imgur.com/ZcleGvB.png "Tree view")

<div>This is because apache virtualhost points to /public_html in *documentRoot* directive and prevents users accessing /app directory from URL.</div>

Besides, I modified permissions on /public_html/uploads directory to give the control to www-data user and group (Debian x64) in order to allow php to write and read files (and just php).

###Custom autoloader

I've created a custom autoloader

([/app/project_autoloader.php](https://github.com/legomolina/web-skeleton/blob/master/app/project_autoloader.php))

to load all neccessary classes without requiring them one by one, so you just need to use namespaces as I'm using at examples and you are done.

###SASS and LiveReload

Installing npm dependencies you download *gulp*. Once you have it, just type ```gulp``` [on a shell window](#console) in your project's root and hit enter and now, you have a file watcher for all your project files and SASS compiler.
- SASS takes [/public_html/styles/sass/style.scss](https://github.com/legomolina/web-skeleton/blob/master/public_html/styles/sass/style.scss) and all imports done in this file (and just this file - you need to import all scss files you want to use in your project into this one-) and generates a style.css (file you need to link into your project) file into css folder.
- Live reload is a file watcher that reloads your linked web browser everytime a file is saved, included or deleted. You need to download browser extension for LiveReload in order to run it.

###Database connection

Database connection is located on [/app/utils/DBConnection.php](https://github.com/legomolina/web-skeleton/blob/master/app/utils/DBConnection.php)
and it uses mysqli function to create the connection.

Now you only need to configure database credentials located on 
[/app/config/Constants.php](https://github.com/legomolina/web-skeleton/blob/master/app/config/Constants.php).

Connection is instantiated in 
[/public_html/index.php](https://github.com/legomolina/web-skeleton/blob/master/public_html/index.php#L31)
and due to this, you can use it everywhere in your application just calling it with 
```php
global $connection;
```
