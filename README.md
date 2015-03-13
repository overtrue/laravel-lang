# laravel-lang

37 languages for Laravel 5 based on [Laravel4-lang](https://github.com/caouecs/Laravel4-lang).

# Install

```shell
composer require overtrue/laravel-lang
```

or add the following line to your project's composer.json:

```json
    "require": {
        "overtrue/laravel-lang": "dev-master"
    }
```
then

```shell
composer update
```
After completion of the above, Replace
```php
'Illuminate\Translation\TranslationServiceProvider'
```

into

```php
'Overtrue\LaravelLang\TranslationServiceProvider',
```

# Usage

There is no difference with the usual usage.

# License

MIT
