# OIB Validator/Generator

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]

Validate, generate OIB (Personal Identification Number).

## Install

Via Composer

``` bash
composer require tesla-software/oib
```

## Usage

### Validation

```php
use Tesla\OIB\OIB;

// Check if OIB is valid
OIB::validate('00000000001'); // Returns: bool
```

### Validation of multiple OIB's

``` php
// Check if OIB's are valid
OIB::validateMany('00000000001', '00000000002', ...); // Returns: array
// or
OIB::validateMany(['00000000001', '00000000002', ...]); // Returns: array
```
### Generation


## Testing

``` bash
composer test
```

