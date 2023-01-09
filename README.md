# This is Relations to join retrive data

[![Latest Version on Packagist](https://img.shields.io/packagist/v/salvatorecervone/relationsjoins.svg?style=flat-square)](https://packagist.org/packages/salvatorecervone/relationsjoins)
[![Tests](https://img.shields.io/github/actions/workflow/status/salvatorecervone/relationsjoins/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/salvatorecervone/relationsjoins/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/salvatorecervone/relationsjoins.svg?style=flat-square)](https://packagist.org/packages/salvatorecervone/relationsjoins)

## Whats?

This package help you to convert relationship eloquent to join relation 

## Installation

You can install the package via composer:

```bash
composer require salvatorecervone/relationsjoins
```

## Usage

For start you setting type of your relation
ex.

```php
 function role(): HasMany
    {
        return $this->hasMany(Role::class);
    }
```
and this for each other relation

```php
$result = (RelationsJoinsClass::init(new User(), ['role']));
```

## Credits

- [salvatore](https://github.com/SalvatoreCervone)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
