madisonphp-doctrine-talk
========================

This is the demo application for my September 2013 presentation on Doctrine 2 at the
Madison PHP Meetup.

The slides can be found on [Google Drive](https://docs.google.com/presentation/d/1636DyKpuoKd9v4i5s3ER2gOB9U8Ytb_hUaGMz3xRFh4/edit?usp=sharing).

Setup
-----

Use Composer to install dependencies.

    $ composer.phar install

Optionally, adjust the settings in `bootstrap.php` file. Out-of-the-box, the application
uses SQLite3 which requires no setup, simply run:

    $ vendor/bin/doctrine orm:schema-tool:create

Usage
-----

Run the demo application for a list of command line options.

    $ bin/demo


Miscellaneous
-------------

If you have the SQLite client installed you can connect to the database directly.

    $ qlite3 db.sqlite


