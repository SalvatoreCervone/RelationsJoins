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

For start you setting type of your relation for all relation do you use
ex.

```php
function role(): HasMany
{
    return $this->hasMany(Role::class);
}
```

Use Triat in any models do you return joins with 

```php
Use ReturnJoin;
```

and after you call one row of code

```php
$joins = app('App\Models\User')->load['role']->returnjoin(); 
```

the result is a array with all information of all relations usage.
The array have all id and name table for real relation and have the inner join string  for usage in query builder

## Credits

- [salvatore](https://github.com/SalvatoreCervone)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
