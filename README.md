# Laravel-lang

44 languages for Laravel 5 based on [Laravel4-lang](https://github.com/caouecs/Laravel4-lang).

[中文说明](README_CN.md)

[![Latest Stable Version](https://poser.pugx.org/overtrue/laravel-lang/v/stable.svg)](https://packagist.org/packages/overtrue/laravel-lang) [![Total Downloads](https://poser.pugx.org/overtrue/laravel-lang/downloads.svg)](https://packagist.org/packages/overtrue/laravel-lang) [![Latest Unstable Version](https://poser.pugx.org/overtrue/laravel-lang/v/unstable.svg)](https://packagist.org/packages/overtrue/laravel-lang) [![License](https://poser.pugx.org/overtrue/laravel-lang/license.svg)](https://packagist.org/packages/overtrue/laravel-lang)

## Install

```shell
composer require "overtrue/laravel-lang:1.0.*"
```

or add the following line to your project's `composer.json`:

```json
"require": {
    "overtrue/laravel-lang": "1.0.*"
}
```
then

```shell
composer update
```
After completion of the above, Replace the `config/app.php` content

```php
'Illuminate\Translation\TranslationServiceProvider'
```
into

```php
'Overtrue\LaravelLang\TranslationServiceProvider',
```

## Configuration

you can change the locale at `config/app.php`:

```php
'locale' => 'zh-CN',
```

## Usage

There is no difference with the usual usage.

If you need to add additional language content, Please create a file in the `resources/lang/{LANGUAGE}`  directory.

### Add custom language items

Here, for example in Chinese:

`resources/lang/zh-CN/demo.php`:

```php
<?php

return [
    'user_not_exists'    => '用户不存在',
    'email_has_registed' => '邮箱 :email 已经注册过！',
];
```
Used in the template:

```php
echo trans('demo.user_not_exists'); // 用户不存在
echo trans('demo.email_has_registed', ['email' => 'anzhengchao@gmail.com']);
// 邮箱 anzhengchao@gmail.com 已经注册过！
```

### Replace the default language items partially

We assume that want to replace the `password.reset` message:

`resources/lang/zh-CN/passwords.php`:

```php
<?php

return [
    'reset' => '您的密码已经重置成功了，你可以使用新的密码登录了!',
];
```

You need only add the part what you want.

## License

MIT
