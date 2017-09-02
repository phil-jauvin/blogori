# So Smol CMS
Lightweight blog platform - a work in progress  
*The best place to start looking at the code is in 'includes/Controllers/App/Posts.php'*

## Where are the PHP/JS/HTML files ?

### PHP
All the back-end code is inside the 'includes' folder  
You'll find the code for Models and the framework itself in the 'Library' directory

### JS
Routing is done in the 'templates/js/app.js' file, with all the other code being in the 'templates/js/app' folder 
All JS dependencies are merged into a single file to minimise load time

### HTML
All HTML is broken up into partials that are then put in JSON format to make it easier for Backbone to read  
The raw HTML is found in 'templates/partials', while 'templates/partials-compiled' contains the JSON formatted ones

## How does it work ?

An Ori powered REST API feeds all data into a Backbone front-end  
The best place to start looking at the code is in 'includes/Controllers/App/Posts.php'

## Does this use any other libraries ?

The [PHPAuth library](https://github.com/PHPAuth/PHPAuth) is used to provide secure user authentication  

## TODO

* Fix any other OWASP Top 10 vulns
* Add markdown editor for posts
* Add markdown rendering to the front-end

