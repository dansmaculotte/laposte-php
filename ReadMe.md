# La Poste API PHP SDK

[![Latest Version](https://img.shields.io/packagist/v/DansMaCulotte/laposte-php.svg?style=flat-square)](https://packagist.org/packages/dansmaculotte/laposte-php)
[![Total Downloads](https://img.shields.io/packagist/dt/DansMaCulotte/laposte-php.svg?style=flat-square)](https://packagist.org/packages/dansmaculotte/laposte-php)
[![Build Status](https://img.shields.io/travis/DansMaCulotte/laposte-php/master.svg?style=flat-square)](https://travis-ci.org/dansmaculotte/laposte-php)
[![Quality Score](https://img.shields.io/scrutinizer/g/DansMaCulotte/laposte-php.svg?style=flat-square)](https://scrutinizer-ci.com/g/dansmaculotte/laposte-php)
[![Code Coverage](https://img.shields.io/coveralls/github/DansMaCulotte/laposte-php.svg?style=flat-square)](https://coveralls.io/github/dansmaculotte/laposte-php)

> This library aims to facilitate the usage of La Poste API Services

## Installation

### Requirements

- PHP 7.2
- Json Extension

You can install the package via composer:

``` bash
composer require dansmaculotte/laposte-php
```

## Usage

[La Poste Developer Portal](https://developer.laposte.fr/)

### Address Control

#### Find

```php
use DansMaCulotte\LaPoste\AddressControl;

$addressControl = new AddressControl($this->apiKey);
$results = $addressControl->find('7 rue Mélingue 14000 Caen');

print_r($results);
```

#### Detail

```php
use DansMaCulotte\LaPoste\AddressControl;

$addressControl = new AddressControl($this->apiKey);
$results = $addressControl->detail('260621288');

print_r($results);
```

### Tracking

#### Track

```php
use DansMaCulotte\LaPoste\Tracking;

$tracking = new Tracking($this->apiKey);
$results = $tracking->track('1111111111111');

print_r($results);
```

#### List

```php
use DansMaCulotte\LaPoste\Tracking;

$tracking = new Tracking($this->apiKey);
$results = $tracking->list(['1111111111111', '1111111111119']);

print_r($results);
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
