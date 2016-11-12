# Slim Framework 3 Skeleton Application

Use this skeleton application to quickly setup and start working on a new Slim Framework 3 application. This application uses the latest Slim 3 with the Twig-View template renderer. It also uses the Monolog logger. I've include a simple database class for data query.

This skeleton application is Composer friendly. This makes setting up a new Slim Framework application quick and easy.

## Install the Application

Checkout this branch to your local directory in which you want to install your new Slim Framework application. 
Run this command from the directory.

    composer install

You'll want to:

* Point your virtual host document root to your new application's `public/` directory.
* Ensure `logs/` and `cache/` is web writeable.

To run the application, you can also run this command in the `public/` directory. 

	php -S localhost:[any available port]

Make sure you are using PHP version 5.5 or newer. That's it! Now go build something cool.
