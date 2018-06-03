# Child Theme Library

A configuration based drop-in library for extending Genesis child themes.

### Why was the Child Theme Library built?

The main purpose of the Child Theme Library is to provide a shareable codebase for commercial Genesis child themes. This is achieved by using configuration-based architecture to separate the theme's reusable logic from it's config. Using this approach, we are able to use a single codebase which can be heavily customized by passing in a configuration file.

## Installation

### Composer (recommended)

Include the package and the custom directory installer package in your child theme's `composer.json` file

```json
"require":{
  "mnsami/composer-custom-directory-installer": "1.1.*",
  "seothemes/child-theme-library": "dev-master"
}
```

In the `extra` section define the custom directory you want the package to be installed in:

```json
"extra":{
  "installer-paths":{
    "./lib/": ["seothemes/child-theme-library"]
  }
},
```

While the child theme library is in beta, you will also need to add the repository details:

```json
"repositories": [
  {
    "type": "git",
    "url": "https://github.com/seothemes/child-theme-library.git"
  }
],
```

An example `composer.json` file can be found [here](https://github.com/seothemes/genesis-starter/composer.json)

### Git

The Child Theme Library can be installed as a Git Submodule. This allows the library to receive future updates with ease. If you are not familiar with Git Submodules please read [this article](https://gist.github.com/gitaarik/8735255).

From the terminal, navigate to your project directory:

```sh
cd wp-content/themes/my-theme
```

Clone from Github into the `lib` directory. This creates a submodule:

```sh
git submodule add https://github.com/seothemes/child-theme-library.git lib
```

Include the library from your `functions.php` file by placing the following line **after** the Genesis Framework has loaded:

```php
// Load Child Theme Library (do not remove).
require_once get_stylesheet_directory() . '/lib/init.php';
```

### Manually

Download the zip file from Github [here](https://github.com/seothemes/child-theme-library/archive/master.zip).

Upload the file to your theme's main directory and unzip the contents.

Include the library from your `functions.php` file, **AFTER** the Genesis Framework has loaded, e.g:

```php
// Load Genesis Framework (do not remove).
require_once get_template_directory() . '/lib/init.php';

// Load child theme's lib (do not remove).
require_once get_stylesheet_directory() . '/lib/init.php';
```

## Setup

Once the library has been included in your theme, it is ready to accept your config file. By default, this should be placed in `./config/config.php`, however this location can be changed by using the config path filter, e.g:

```php
add_filter( 'child_theme_config', get_stylesheet_directory() . 'my-config.php' );
```

A working example of the config file with all of the possible settings can be found [here](https://github.com/seothemes/genesis-starter/composer.json).

## Structure

The Child Theme Library loosely resembles the current Genesis Framework file structure:

```sh
lib/
├── admin/
│   ├── customizer-output.php
│   └── customizer-settings.php
├── classes/
│   ├── class-child-theme-rgba-customizer-control.php
│   └── class-child-theme-tgm-plugin-activation.php
├── css/
│   ├── customizer.css
│   ├── library.css
│   └── load-styles.php
├── functions/
│   ├── attributes.php
│   ├── autoload.php
│   ├── defaults.php
│   ├── demo.php
│   ├── general.php
│   ├── hero.php
│   ├── layout.php
│   ├── markup.php
│   ├── plugins.php
│   ├── setup.php
│   ├── templates.php
│   ├── upgrade.php
│   └── utilities.php
├── js/
│   ├── customizer.js
│   ├── library.js
│   └── load-scripts.php
├── languages/
│   └── child-theme-library.pot
├── shortcodes/
│   └── footer.php
├── structure/
│   ├── footer.php
│   ├── header.php
│   └── menu.php
├── views/
│   ├── page-grid.php
│   ├── page-blog.php
│   ├── page-front.php
│   ├── page-full.php
│   ├── page-landing.php
│   └── page-sitemap.php
├── widgets/
│   └── widgets.php
├── .gitattributes
├── composer.json
├── README.md
└── init.php
```
