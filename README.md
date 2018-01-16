[![Build Status](https://travis-ci.org/reichwebconsulting/array-filters.svg?branch=master)](https://travis-ci.org/reichwebconsulting/array-filters)

# reichwebconsulting/array-filters

reichwebconsulting/array-filters is a PHP 7.1+ library for array filtering.

This project began as part of a hydration/extraction library, but I realized the
components had broad use across numeric projects I work on. The library contains
an interface called `FilterInterface` that describes an interface for
passing arrays and returning modified versions of those arrays.

The `ExcludeFieldsFilter` provides the ability to remove key/value pairs from
the input array by specifying keys to exclude. This filter is useful when you
have an array of data to return but need to filter out sensitive fields based
on the context. For example, `ExcludeFieldsFilter` could be used to filter out
the "password" and "email" fields from user records before returning them in a
result set.

The `KeyMutatorFilter` provides the ability to modify array keys based on
any logic you code into a `callable` function you assign to the filter. The
output array will contain all of the same values as the input array, but
assigned to keys generates using the configured callback function. The
`KeyMutatorFilter` is useful when you have an array of data whose keys need to
be in a slightly different format before they are useful for the next phase of
code. A good example is when PostgreSQL result sets, whose properties are all
lowercase--a convention that is rarely followed within PHP.

The `KeyPrefixFilter` provides the ability to add prefixes to all of the array
keys.  A great use case for `KeyPrefixFilter` is when you have a result set you
would like to map onto a `PDOStatement` parameter list. PDO parameters begin
with a colon, so just use KeyPrefixFilter to add a colon to your keys before
using the array as your PDO statement parameters.

## Getting Started

To start using `reichwebconsulting/array-filters` install Composer and then
run the following command:

```
composer require reichwebconsulting/array-filters
```

### Prerequisites

PHP 7.1+ and Composer required. PHPUnit is required to run the test suite.

### Installing

```
composer require reichwebconsulting/array-filters
```

## Running the tests

This library strives for 100% code coverage.  Tests can be run by switching to
the `phpunit` directory and running `phpunit`.

```
cd phpunit
phpunit 
```

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/your/project/tags). 

## Authors

* **Brian Reich** - *Initial work* - [Reich Web Consulting](https://github.com/reichwebconsulting)

See also the list of [contributors](https://github.com/reichwebconsulting/array-filters/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
