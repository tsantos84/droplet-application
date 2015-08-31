Getting Started
===============

1. Requirements
2. Installation
3. Configuration
3. Running the application

Requirements
------------

Droplet Framework requires PHP 5.4 or up

Installation
------------

The easiest way to install Droplet Application is using composer:

    $ composer create-project tsantos/droplet-application myapp

This command will clone the standard application structure ready to start writing your web application.

Configuration
-------------

All the application configuration is stored in the file `/app/config` directory. All the options available will
be covered in subsequent sections of the documentation.

Running the Application
-----------------------

Running your application after installing is much easy. Just start the PHP built-in server and point
your browser to `http://localhost:8000`:

    $ php -S localhost:8000 -s web
