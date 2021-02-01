# OIB Validator

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://www.travis-ci.com/tesla-software/oib.svg?branch=master)](https://travis-ci.com/github/tesla-software/oib)

Validate OIB (Personal Identification Number).

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

/**
 * Results
 *
    [
      "73963178454"   => false
      "25878484848"   => false
      "73963178454AA" => false
      "25878484848ZZ" => false
      "87783564545"   => false
      "87783564545GG" => false
      "12345678911"   => true
      "91145678919"   => true
      "87884784457"   => true
      "87871118443"   => true
      "36875454458"   => true
      "78745548455"   => true
    ]
*/
```

## Testing

``` bash
composer test
```

[ico-version]: https://img.shields.io/packagist/v/tesla-software/oib.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/tesla-software/oib

