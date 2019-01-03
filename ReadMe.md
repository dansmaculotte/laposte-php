# La Poste API PHP SDK

Please refer to La Poste Developer documentation for API specifications.

[Documentation](https://developer.laposte.fr/)

## Installation

You can install the package via composer:

``` bash
composer require dansmaculotte/laposte-php
```

## Usage

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

#### Detail

```php
use DansMaCulotte\LaPoste\Tracking;

$tracking = new Tracking($this->apiKey);
$results = $tracking->trackList(['1111111111111', '1111111111119']);

print_r($results);
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
