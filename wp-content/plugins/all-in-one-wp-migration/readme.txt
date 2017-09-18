=== All-in-One WP Migration ===
Contributors: yani.iliev, bangelov, pimjitsawang
Tags: move, transfer, copy, migrate, backup, clone, restore, db migration, migration, wordpress migration, website migration, database export, database import
Requires at least: 3.3
Tested up to: 4.8
Stable tag: 6.48
License: GPLv2 or later

Move, transfer, copy, migrate, and backup a site with 1-click. Quick, easy, and reliable.

== Description ==
The plugin allows you to export your database, media files, plugins, and themes.
You can apply unlimited find/replace operations on your database and the plugin will also fix any serialization problems that occur during find/replace operations.

All in One WP Plugin is the first plugin to offer true mobile experience on WordPress versions 3.3 and up.

= Works on all hosting providers =
* The plugin does not depend on any extensions, making it compatible with all PHP hosting providers.
* The plugin exports and imports data in time chunks of 3 seconds each, which keeps the plugin below the max execution time that most providers set to 30 seconds.
* We have tested the plugin on the major Linux distributions, Mac OS X, and Microsoft Windows.

= Bypass all upload size restriction =
* We use chunks to import your data and that way we bypass any webserver upload size restrictions.

= 0 Dependencies =
* The plugin does not require any php extensions and can work with PHP v5.2.

= Support for MySQL and MySQLi =
* No matter what php mysql driver your webserver ships with, we support it.

= Support WordPress v3.3 up to v4.x =
* We tested every WordPress version from `3.3` up to `4.x`.

= Supported hosting providers =
* Bluehost
* InMotion
* Web Hosting Hub
* Siteground
* Pagely
* Dreamhost
* Justhost
* GoDaddy
* WP Engine
* Site5
* 1&1
* Pantheon
* [See the full list of supported providers here](https://help.servmask.com/knowledgebase/supported-hosting-providers/)

= Migrate WordPress to most popular cloud services using our completely new extensions =
* [Unlimited](https://servmask.com/products/unlimited-extension)
* [Dropbox](https://servmask.com/products/dropbox-extension)
* [Multisite](https://servmask.com/products/multisite-extension)
* [FTP](https://servmask.com/products/ftp-extension)
* [Google Drive](https://servmask.com/products/google-drive-extension)
* [Amazon S3](https://servmask.com/products/amazon-s3-extension)
* [URL](https://servmask.com/products/url-extension)
* [OneDrive](https://servmask.com/products/onedrive-extension)
* [Box](https://servmask.com/products/box-extension)
* And many more to come

= Contact us =
* [Get free help from us here](https://servmask.com/help)
* [Report a bug or request a feature](https://servmask.com/help)
* [Find out more about us](https://servmask.com)

[youtube http://www.youtube.com/watch?v=BpWxCeUWBOk]

[youtube http://www.youtube.com/watch?v=mRp7qTFYKgs]

== Installation ==
1. Upload the `all-in-one-wp-migration` folder to the `/wp-content/plugins/` directory
1. Activate the All in One WP Migration plugin through the 'Plugins' menu in WordPress
1. Configure the plugin by going to the `Site Migration` menu that appears in your admin menu

== Screenshots ==
1. Mobile Export page
2. Mobile Import page
3. Plugin Menu

== Changelog ==
= 6.48 =
**Fixed**

* Escape Find/Replace values on import
* Unable to load CSS and JS when event hook contains capital letters

= 6.47 =
**Added**

* Elementor plugin support

**Fixed**

* Site URL and Home URL replacement in JSON data

= 6.46 =
**Fixed**

* Domain replacement on import
* Invalid secret key check on import

= 6.45 =
**Changed**

* Better mechanism when enumerating files on import

**Fixed**

* Validation mechanism on export/import

= 6.44 =
**Added**

* PHP and DB version metadata in package.json
* Find/Replace values in package.json
* Internal Site URL and Internal Home URL in package.json
* Confirmation mechanism when uploading chunk by chunk on import
* Progress indicator on database export/import
* Shutdown handler to catch fatal errors

**Changed**

* Replace TYPE with ENGINE keyword on database export
* Detect Site URL and Home URL in Find/Replace values
* Activate template and stylesheet on import
* Import database chunk by chunk to avoid timeout limitation

**Fixed**

* An issue on export/import when using HipHop for PHP

= 6.43 =
**Changed**

* Plugin tags and description

= 6.42 =
**Changed**

* Improved performance when exporting database

= 6.41 =
**Added**

* Support Visual Composer plugin
* Support Jetpack Photon module

**Changed**

* Improved Maria DB support
* Disable WordPress authentication checking during migration
* Clean any temporary files after migration

= 6.40 =
**Added**

* Separate action hook in advanced settings called "ai1wm_export_advanced_settings" to allow custom checkbox options on export

**Changed**

* Do not extract dropins files on import
* Do not exclude active plugins in package.json and multisite.json on export
* Do not show "Resolving URL address..." on export/import

**Fixed**

* An issue with large files on import
* An issue with inactive plugins option in advanced settings on export

= 6.39 =
**Added**

* Support for MariaDB

**Changed**

* Do not include package.json, multisite.json, blogs.json, database.sql and filemap.list files on export
* Remove HTTP Basic authentication from Backups page

**Fixed**

* An issue with unpacking archive on import
* An issue with inactivated plugins on import

= 6.38 =
**Added**

* Support for HyperDB plugin
* Support for RevSlider plugin
* Check available disk space during export/import
* Support very restricted hosting environments
* WPRESS mime-type to web.config when the server is IIS

**Changed**

* Switch to AJAX from cURL on export/import
* Respect WordPress constants FS_CHMOD_DIR and FS_CHMOD_FILE on import
* Remove misleading available disk space information on "Backups" page

**Fixed**

* An issue related to generating archive and folder names
* An issue related to CSS styles on export page
