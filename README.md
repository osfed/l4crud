L4CRUD
===

A CRUD package for Laravel. Using this you can create your entire c.r.u.d (Create Read Update Delete) interface in a matter of minutes

More info available on the library website http://raw.adigheorghe.ro

Installation
=============

Run the following command in your laravel root directory
> composer require osfed/l4crud
> dev-master

Or add `osfed/l4crud` as a requirement to `composer.json`:

"osfed/l4crud": "dev-master"

Once the package is installed you will need to add the service provider. Add the following in the `providers` section in app/config/app.php

'Osfed\L4CRUD\RawServiceProvider'

The package assets need to be published afterwards

php artisan asset:publish osfed/l4crud

Documentation
=============

An sql file containing sample data is available in the package. 

 - yourinstallpath/vendor/Osfed/L4CRUD/raw.sql

You need to import this file in your database and then you can access:

 - yourinstallpath/raw_items

Example code is available by accessing

 - vendor/Osfed/L4CRUD/src/controllers/RawController.php
