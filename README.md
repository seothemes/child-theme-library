# Child Theme Library

A lightweight drop-in library for extending Genesis child themes.

## Installation

### Git

From the terminal, navigate to your project directory:

```sh
cd wp-content/themes/my-project
```

Clone from Github into the `lib` directory:

```sh
git clone https://github.com/seothemes/child-theme-library.git lib
```

Include the library from your functions.php file:

```php
// Load child theme's lib (do not remove).
require_once get_stylesheet_directory() . '/lib/init.php';
```

### Manually

Download the zip file from Github [here](https://github.com/seothemes/child-theme-library/archive/master.zip).

Upload the file to your theme's main directory and unzip the contents.

Include the library from your functions.php file:

```php
// Load child theme's lib (do not remove).
require_once get_stylesheet_directory() . '/lib/init.php';
```

### Composer

Coming soon.

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
│    └── upgrade.php
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
├── widgets/
│    └── widgets.php
├── init.php
└── README.md
```