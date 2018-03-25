# Web skeleton v2
Web skeleton ready to work with Slim and SCSS.

### New v2
- Changed project structure to split php, precompiled resources and public documents.
- Now supports complete Handlebars templates rendering with Gulp task.
- Includes Eloquent ORM for Database Management ready to use.
- Includes CSRF protection with ```slim/csrf``` package and middleware
- Instead of using php-view, now I'm using twig view, a more powerful template engine.
- Added new gulp task to minify and copy useful code into new dist folder, ready to upload to your production server.

### Install

Template is ready to execute
```shell
composer install
```

and 
```shell
npm install
```
and it will include all vendor and npm packages.

If you want to execute gulp from your console you need to install it first:

```shell
npm install --global gulp-cli
```

You can copy the ```/apache.conf``` file to your apache2 web server sites-available folder. It includes all necessary statements to make it work.

Remember to grant access to apache user to write files into ```/cache``` and ```/public_html/uploads``` folders.
Ubuntu users can type this (as sudo):

    chown -R www-data:www-data cache public_html/uploads

### Files hierarchy

I've configured this skeleton to split backend (private) part from frontend (public) part and from the precompiled things.

![Tree view](https://imgur.com/download/3Pxtcvq "Tree view")

> It's important that all controllers are in the ```/App/Controllers``` folder or subfolders because the bootloader loads and injects them from that route.

### Gulp
Once you have downloaded *gulp* just type ```gulp``` on a shell window in root folder and it executes the default task that compiles SCSS into CSS, compiles Handlebars templates and enables the LiveReload to watch changes.

- SCSS takes the ```/resources/scss/style.scss``` file and generates the ```/public_html/css/style.css``` that you should include into your html.
- Handlebars takes the ```/resources/templates/*.handlebars``` handlebars files and compiles them into the ```/public_html/views/templates.js```.
- LiveReload watches for any change in the project root directory and compile scss and handlebars files.

I've also included a ```production``` task that executes the uglify and minify tasks and copies the required files into a new folder called ```/dist``` that you can safely upload to your server.