[![Latest Stable Version](https://img.shields.io/packagist/v/gpslab/specification-query.svg?maxAge=3600&label=stable)](https://packagist.org/packages/gpslab/specification-query)
[![Total Downloads](https://img.shields.io/packagist/dt/gpslab/specification-query.svg?maxAge=3600)](https://packagist.org/packages/gpslab/specification-query)
[![Build Status](https://img.shields.io/travis/gpslab/specification-query.svg?maxAge=3600)](https://travis-ci.org/gpslab/specification-query)
[![Coverage Status](https://img.shields.io/coveralls/gpslab/specification-query.svg?maxAge=3600)](https://coveralls.io/github/gpslab/specification-query?branch=master)
[![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/gpslab/specification-query.svg?maxAge=3600)](https://scrutinizer-ci.com/g/gpslab/specification-query/?branch=master)
[![SensioLabs Insight](https://img.shields.io/sensiolabs/i/a9e2cde7-1cbf-45bc-b89d-65c54f377967.svg?maxAge=3600&label=SLInsight)](https://insight.sensiolabs.com/projects/a9e2cde7-1cbf-45bc-b89d-65c54f377967)
[![StyleCI](https://styleci.io/repos/92381746/shield?branch=master)](https://styleci.io/repos/92381746)
[![License](https://img.shields.io/packagist/l/gpslab/specification-query.svg?maxAge=3600)](https://github.com/gpslab/specification-query)

# Doctrine Specification as query in CQRS architecture

The simple infrastructure component for use a [Doctrine Specification](https://github.com/Happyr/Doctrine-Specification) as query in [CQRS](https://github.com/gpslab/cqrs) architecture.

## Installation

Pretty simple with [Composer](http://packagist.org), run:

```sh
composer require gpslab/specification-query
```

## Usage

You can use Specifications as a simple query.

```php
// specification for get contact with id = 123
$spec = Spec::eq('id', 123);

// cache the result by 1 hour
$modifier = Spec::cache(3600);

// make specification query
$query = new ObviousSpecificationQuery('AcmeDemo:Contact', $spec, $modifier);

// get contact
$contact = $query_dispatcher->dispatch($query);
```

### Custom query

You can create custom query for this case.

```php
class ContactWithIdentityQuery implements SpecificationQuery
{
    /**
     * @var int
     */
    private $id;

    /**
     * @param int $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function entity()
    {
        return 'AcmeDemo:Contact';
    }

    /**
     * @return Specification
     */
    public function spec()
    {
        return Spec::eq('id', $this->id);
    }

    /**
     * @return ResultModifier|null
     */
    public function modifier()
    {
        return Spec::cache(3600);
    }
}
```

And use it

```php
// make specification query
$query = new ContactWithIdentityQuery(123);

// get contact
$contact = $query_dispatcher->dispatch($query);
```

## License

This bundle is under the [MIT license](http://opensource.org/licenses/MIT). See the complete license in the file: LICENSE
