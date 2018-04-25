# Child Theme Library

A lightweight drop-in library for extending Genesis child themes.

## Installation

### Git

The Child Theme Library can be installed as a Git Submodule. This allows the library to receive future updates with ease. If you are not familiar with Git Submodules please read [this article](https://gist.github.com/gitaarik/8735255).

From the terminal, navigate to your project directory:

```sh
cd wp-content/themes/my-theme
```

Clone from Github into the `lib` directory. This creates a submodule:

```sh
git submodule add https://github.com/seothemes/seothemes-library.git lib
```

Include the library from your `functions.php` file by placing the following line **after** the Genesis Framework has loaded:

```php
// Load child theme's lib (do not remove).
require_once get_stylesheet_directory() . '/lib/init.php';
```

### Manually

Download the zip file from Github [here](https://github.com/seothemes/seothemes-library/archive/master.zip).

Upload the file to your theme's main directory and unzip the contents.

Include the library from your `functions.php` file, **AFTER** the Genesis Framework has loaded, e.g:

```php
// Load Genesis Framework (do not remove).
require_once get_template_directory() . '/lib/init.php';

// Load child theme's lib (do not remove).
require_once get_stylesheet_directory() . '/lib/init.php';
```

### Composer

Coming soon.

## Features

## Structure

The Child Theme Library is modular built with configuration architecture that loosely follows the Genesis Framework file structure:

```sh
lib/
├── admin/
│    ├── css-handler.php
│    └── customizer.php
├── classes/
│    ├── class-colors.php
│    ├── class-plugins.php
│    └── class-rgba.php
├── css/
│    ├── core.css
│    └── load-styles.php
├── functions/
│    ├── general.php
│    ├── head.php
│    ├── helpers.php
│    ├── layout.php
│    ├── markup.php
│    ├── setup.php
│    ├── upgrade.php
│    └── widgetize.php
├── js/
│    ├── core.js
│    └── load-scripts.php
├── languages/
│    └── core.pot
├── structure/
│    ├── footer.php
│    ├── header.php
│    ├── hero.php
│    ├── logo.php
│    └── menu.php
├── init.php
└── README.md
```
