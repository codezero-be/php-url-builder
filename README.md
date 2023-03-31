# PHP URL Builder

[![GitHub release](https://img.shields.io/github/release/codezero-be/php-url-builder.svg?style=flat-square)](https://github.com/codezero-be/php-url-builder/releases)
[![License](https://img.shields.io/packagist/l/codezero/php-url-builder.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/github/actions/workflow/status/codezero-be/php-url-builder/run-tests.yml?style=flat-square&logo=github&logoColor=white&label=tests)](https://github.com/codezero-be/php-url-builder/actions)
[![Code Coverage](https://img.shields.io/codacy/coverage/a5db8a1321664e67900c96eadc575ece/master?style=flat-square)](https://app.codacy.com/gh/codezero-be/php-url-builder)
[![Code Quality](https://img.shields.io/codacy/grade/a5db8a1321664e67900c96eadc575ece/master?style=flat-square)](https://app.codacy.com/gh/codezero-be/php-url-builder)
[![Total Downloads](https://img.shields.io/packagist/dt/codezero/php-url-builder.svg?style=flat-square)](https://packagist.org/packages/codezero/php-url-builder)

[![ko-fi](https://www.ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/R6R3UQ8V)

## ✅ Requirements

- PHP >= 7.2

## 📦 Install

Install this package with Composer:

```bash
composer require codezero/php-url-builder
```

## 📘 Usage

You create a new `UrlBuilder` instance and pass it the URL you want to manipulate:

```php
$urlBuilder = new \CodeZero\UrlBuilder\UrlBuilder('http://www.example.com/abc/def?foo=bar');
// or...
$urlBuilder = \CodeZero\UrlBuilder\UrlBuilder::make('http://www.example.com/abc/def?foo=bar');
```

When you are done, you can build the new URL:

```php
$url = $urlBuilder->build(); //=> Returns 'http://www.example.com/abc/def?foo=bar'
$url = $urlBuilder->build(false); //=> Returns '/abc/def?foo=bar'
```

### Updating URL Parts

There are setters and getters for the different URL parts:

```php
$urlBuilder->setScheme('https');
$urlBuilder->getScheme(); //=> Returns 'https'

$urlBuilder->setHost('www.example.com');
$urlBuilder->getHost(); //=> Returns 'www.example.com'

$urlBuilder->setPort(8000);
$urlBuilder->getPort(); //=> Returns '8000'

$urlBuilder->setPath('/abc/def');
$urlBuilder->getPath(); //=> Returns '/abc/def'
$urlBuilder->getSlugs(); //=> Returns ['abc', 'def']

$urlBuilder->setSlugs(['abc', 'def']);
$urlBuilder->getPath(); //=> Returns '/abc/def'
$urlBuilder->getSlugs(); //=> Returns ['abc', 'def']

$urlBuilder->setQueryString('foo=bar');
$urlBuilder->getQueryString(); //=> Returns 'foo=bar'
$urlBuilder->getQuery(); //=> Returns ['foo' => 'bar']

$urlBuilder->setQuery(['foo' => 'bar']);
$urlBuilder->getQueryString(); //=> Returns 'foo=bar'
$urlBuilder->getQuery(); //=> Returns ['foo' => 'bar']
```

## 🚧 Testing

```bash
composer test
```

## ☕ Credits

- [Ivan Vermeyen](https://github.com/ivanvermeyen)
- [All contributors](https://github.com/codezero-be/php-url-builder/contributors)

## 🔒 Security

If you discover any security related issues, please [e-mail me](mailto:ivan@codezero.be) instead of using the issue tracker.

## 📑 Changelog

A complete list of all notable changes to this package can be found on the
[releases page](https://github.com/codezero-be/php-url-builder/releases).

## 📜 License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
