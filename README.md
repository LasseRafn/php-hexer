# Modify HEX brightness

Ever wanted to lighten or darken a hex in PHP? This package will allow you to. 
It's easy to use, fully tested and is very lightweight.

<p align="center"> 
<a href="https://travis-ci.org/LasseRafn/php-hexer"><img src="https://img.shields.io/travis/LasseRafn/php-hexer.svg?style=flat-square" alt="Build Status"></a>
<a href="https://coveralls.io/github/LasseRafn/php-hexer"><img src="https://img.shields.io/coveralls/LasseRafn/php-hexer.svg?style=flat-square" alt="Coverage"></a>
<a href="https://styleci.io/repos/94527137"><img src="https://styleci.io/repos/94527137/shield?branch=master" alt="StyleCI Status"></a>
<a href="https://packagist.org/packages/LasseRafn/php-hexer"><img src="https://img.shields.io/packagist/dt/LasseRafn/php-hexer.svg?style=flat-square" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/LasseRafn/php-hexer"><img src="https://img.shields.io/packagist/v/LasseRafn/php-hexer.svg?style=flat-square" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/LasseRafn/php-hexer"><img src="https://img.shields.io/packagist/l/LasseRafn/php-hexer.svg?style=flat-square" alt="License"></a>
</p>

## Installation

You just require using composer and you're good to go!

```bash
composer require lasserafn/php-hexer
```

## Usage

As with installation, usage is quite simple. 

```php
use LasseRafn\Hexer\Hex;

// Lighten
$hex = new Hex('#333'); // You can leave out the hashtag if you wish.
echo $hex->lighten(15); // Output: #595959 (if you left out the hashtag, it would not be included in the output either)

// Darken
$hex = new Hex('ffffff');
echo $hex->darken(15); // Output: d9d9d9
```

## Methods

There are only two methods, that both accept just one parameter.

The constructor accepts one parameter (`hex`) which can optionally contain a hashtag (#). The length has to be between 3-6 characters (without the hashtag).

### `lighten($percentage)`

Will lighten the color by X percentage. Percentage must be between 0-100. An exception will be thrown otherwise.

### `darken($percentage)`

Will darken the color by X percentage. Percentage must be between 0-100. An exception will be thrown otherwise.

## Exceptions

If you input a HEX which is less than 3 characters of length, or greater than 6, an exception will be thrown. Similar with percentages, if you specify a percentage less than zero, or greater than 100, an exception will be thrown. If the percentage *is* zero, the hex itself will simply be returned.

## Requirements
* PHP 5.6, 7.0 or 7.1
