# Wordpress Starter
Wordpress project with uploads to S3 (Digital Ocean Spaces). S3 uploads aims to be a lightweight "drop-in" for storing uploads on external S3 server instead of the local filesystem.



![Wordpress Starter](public/app/themes/wordpres-sstarter/screenshot.png)

## Features

* Better folder structure
* Dependency management with [Composer](https://getcomposer.org)
* Easy WordPress configuration with environment specific files
* Environment variables with [Dotenv](https://github.com/vlucas/phpdotenv)
* Autoloader for mu-plugins (use regular plugins as mu-plugins)
* Enhanced security (separated web root and secure passwords with [wp-password-bcrypt](https://github.com/roots/wp-password-bcrypt))

## Requirements

* PHP >= 8.2
* Composer


## Installation

**(Valet only)**

  1. Clone this repo:
    ```git clone ```

  2. Install composer depedencies
    ```composer install```

**(Plesk only)**

  1. Install composer depedencies
    ```composer install --no-dev```

  2. Set the document root on webserver to `public` folder: `/httpdocs/public`

**(Valet & Plesk)**

  1. Update environment variables in the `.env` file. Wrap values that may contain non-alphanumeric characters with quotes, or they may be incorrectly parsed.

    * **Database variables**
        * `DB_NAME` - Database name
        * `DB_USER` - Database user
        * `DB_PASSWORD` - Database password
        * `DB_HOST` - Database host

    * **Mode**
        * `WP_ENV` - Set to environment (`development`, `staging`, `production`)


    * **Url**
        * `WP_HOME` - Full URL to WordPress home (https://example.com)
        * `WP_SITEURL` - Full URL to WordPress including subdirectory (https://example.com/backend) default `${WP_HOME}/backend`


    * **Theme**
        * `WP_DEFAULT_THEME` - Default theme name


    * **Salt** - Generate with [wp-cli-dotenv-command](https://github.com/aaemnnosttv/wp-cli-dotenv-command) or [Roots WordPress Salt Generator](https://roots.io/salts.html)
        * `AUTH_KEY`
        * `SECURE_AUTH_KEY`
        * `LOGGED_IN_KEY`
        * `NONCE_KEY`
        * `AUTH_SALT`
        * `SECURE_AUTH_SALT`
        * `LOGGED_IN_SALT`
        * `NONCE_SALT`


  2. The default theme is located in the folder `public/app/themes/` as you would for a normal WordPress site
  3. Access WordPress admin at `https://example.com/backend/wp-admin/`


## Updates

Manage updates via composer

  **Production**
    ```composer update --no-dev```

  **Development**
   ```composer update```




## Documentation

  * Update theme name to match name of client.
  * Update public/app/themes/worddpress-starter/header.php to include working domain, for local vite HMR
  * Update public/app/themes/worddpress-starter/inc/vite.php to include working domain
  * Update public/hot to include workign domain
  * Update public/app/themes/worddpress-starter/manifest.json to include working domain
  * Replace any references of Wordpress Starter etc with name of client.
  * Update host & themePath in vite.config.js to match local domain and theme name e.g. wordpress-starter.loc/
  * Update hashtags and Twitter user name here: /resources/js/components/SocialShare.vue
  * Update gitignore to include theme name.
  * Update any refernces of old domains/clients etc. 

  * Update public/app/themes/worddpress-starter/site-image-yoast.jpg to show client brand logo
  * As above, update: public/app/themes/worddpress-starter/site-rep.jpg


## Screenshots

WIP

# About #

  ***Wordpress Theme***

##### Dependencies

* Wordpress

##### Installation

* Use NPM for the installation of all dependencies

  `npm install`

##### Developing

* Use vitejs for developing

  `npm run dev`

##### Deploy

  * Use vitejs for  developing

    `npm run build`
    `git add . && git commit -m "deploy" && push origin master`
