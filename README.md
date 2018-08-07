# Child Theme Library

[![WordPress](https://img.shields.io/badge/wordpress-4.9.7%20tested-brightgreen.svg)]() [![License](https://img.shields.io/badge/license-GPL--2.0--or--later-blue.svg)](https://github.com/seothemes/child-theme-library/blob/master/LICENSE.md)

**Note:** This project is no longer maintained. Please use [d2/core](https://github.com/d2themes/core) instead.

A config-based composer package that provides a set of modules to extend Genesis child theme development.

## Description

The main purpose of the Child Theme Library is to provide a shareable codebase for commercial Genesis child themes. This is achieved by using configuration-based architecture to separate the theme's reusable logic from it's configuration. Using this approach, we are able to use a single codebase which can be heavily customized by passing in different configs. This project is inspired by the [Genesis Theme Toolkit](https://github.com/gamajo/genesis-theme-toolkit) by Gary Jones, but contains additional functionality specific to commercial themes, including support for older versions of PHP. See the [Genesis Starter Theme](https://github.com/seothemes/genesis-starter-theme) as an example.

## Requirements

| Requirement | How to Check | How to Install |
| :---------- | :----------- | :------------- |
| PHP >= 5.4 | `php -v` | [php.net](http://php.net/manual/en/install.php) |
| WordPress >= 4.8 | `Admin Footer` | [wordpress.org](https://codex.wordpress.org/Installing_WordPress) |
| Genesis >= 2.6 | `Theme Page` | [studiopress.com](http://www.shareasale.com/r.cfm?b=346198&u=1459023&m=28169&urllink=&afftrack=) |
| Composer >= 1.5.0 | `composer --version` | [getcomposer.org](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx) |
| Node >= 9.10.1 | `node -v` | [nodejs.org](https://nodejs.org/) |
| NPM >= 5.6.0 | `npm -v` | [npm.js](https://www.npmjs.com/) |
| Yarn >= 0.2.x | `yarn -v` | [yarnpkg.com](https://yarnpkg.com/lang/en/docs/install/#mac-stable) |
| Gulp CLI >= 1.3.0 | `gulp -v` | [gulp.js](https://gulpjs.com/) |
| Gulp = 3.9.1 | `gulp -v` | [gulp.js](https://gulpjs.com/) |

## Installation

Include the package in your child theme's `composer.json` file (an example `composer.json` file can be found [here](https://github.com/seothemes/genesis-starter-theme/composer.json)).

```bash
composer require seothemes/child-theme-library
```

Optionally install the TGMPA composer package:

```bash
composer require tgmpa/tgm-plugin-activation
```

## Usage

There are three steps to include the Child Theme Library in your project:

- Include the Composer `autoload.php` file
- Store the library as a global variable for use throughout your theme
- Initialize the child theme library

All changes to the child theme should be made via the theme configuration file. An example config can be found [here](https://github.com/seothemes/child-theme-library/blob/master/docs/example-config.php).

The following is an example of how to achieve the steps mentioned above. This code should be placed in your `functions.php` file, before any custom code is loaded:

```php
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {

	require_once __DIR__ . '/vendor/autoload.php';
	$child_theme = new SEOThemes\ChildThemeLibrary\Theme();
	$child_theme->init();

}
```

Storing the Child Theme Library object as a global variable provides access to the library's public properties and methods. For example, to print the name of the theme you can do the following:

```php
echo $child_theme->name;
```

Or, to use the Minify CSS helper function:

```php
$css = 'body { background-color: red; }';
echo $child_theme->utilities->minify_css( $css );
```

## Structure

The Child Theme Library follows the [PHP Package Development Standard](https://github.com/php-pds/skeleton_research) folder structure and uses [PSR-4 Autoloading](https://www.php-fig.org/psr/psr-4/).

```sh
./
├── docs/
│   └── example-config.php
├── src/
│   ├── Admin.php
│   ├── Attributes.php
│   ├── Customizer.php
│   ├── Defaults.php
│   ├── DemoImport.php
│   ├── Enqueue.php
│   ├── HeroSection.php
│   ├── Layout.php
│   ├── Markup.php
│   ├── Plugins.php
│   ├── Setup.php
│   ├── Shortcodes.php
│   ├── Structure.php
│   ├── Templates.php
│   ├── Theme.php
│   ├── Utilities.php
│   └── WidgetsAreas.php
├── tests/
├── .editorconfig
├── .gitattributes
├── .gitignore
├── composer.json
├── phpcs.xml
├── CHANGELOG.md
├── CONTRIBUTING.md
├── LICENSE.md
└── README.md
```

## Hooks

| Name                               | Type     | Description                      |
| :--------------------------------- | :------- | :------------------------------- |
| `child_theme_after_title_area`     | *action* | Runs after the title area        |
| `child_theme_hero_section`         | *action* | Runs during the hero section     |
| `child_theme_front_page_widgets`   | *action* | Runs during the front page loop  |
| `child_theme_constants`            | *filter* | Filters the array of constants   |
| `child_theme_config`               | *filter* | Filters the path to the config   |
| `child_theme_latest_posts_title`   | *filter* | Filters the latest posts title   |
| `child_theme_latest_posts_excerpt` | *filter* | Filters the latest posts excerpt |
| `child_theme_footer_backtotop`     | *filter* | Filters the backtotop shortcode  |

## Support

Please visit https://github.com/seothemes/child-theme-library/issues/ to open a new issue.

## License

This project is licensed under the GNU General Public License - see the LICENSE.md file for details.

## Authors

- **Lee Anthony** - [SEO Themes](https://seothemes.com/)

See also the list of [contributors](https://github.com/seothemes/child-theme-library/graphs/contributors) who participated in this project.

## Acknowledgments

A shout out to anyone who's code was used in or provided inspiration to this project:

<a href="https://github.com/christophherr/" target="_blank">Christoph Herr</a>, 
<a href="https://github.com/garyjones/" target="_blank">Gary Jones</a>, 
<a href="https://github.com/craigsimps/" target="_blank">Craig Simpson</a>, 
<a href="https://github.com/timothyjensen/" target="_blank">Tim Jensen</a>, 
<a href="https://github.com/billerickson/" target="_blank">Bill Erickson</a>, 
<a href="https://github.com/srikat/" target="_blank">Sridhar Katakam</a>, 
<a href="https://github.com/cpaul007/" target="_blank">Chinmoy Paul</a>, 
<a href="https://github.com/nathanrice/" target="_blank">Nathan Rice</a>, 
<a href="https://github.com/bgardner/" target="_blank">Brian Gardner</a>
