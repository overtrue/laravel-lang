# Laravel-lang

52 languages support for Laravel 5 application based on [caouecs/Laravel-lang](https://github.com/caouecs/Laravel-lang).

[中文说明](README_CN.md)

[![For Laravel 5][badge_laravel]][link-github-repo]
[![For Lumen 5][badge_lumen]][link-github-repo]
[![Latest Stable Version][badge_stable]][link-packagist]
[![Latest Unstable Version][badge_unstable]][link-packagist]
[![Total Downloads][badge_downloads]][link-packagist]
[![License][badge_license]][link-packagist]

<p align="center">
  <br>
  <b>创造不息，交付不止</b>
  <br>
  <a href="https://www.yousails.com">
    <img src="https://yousails.com/banners/brand.png" width=350>
  </a>
</p>

# Features

- Laravel 5 & Lumen support.
- Translations Publisher.
- Made with 💖.

# Install

```shell
$ composer require "overtrue/laravel-lang:~3.0"
```

#### Laraval 5.*

After completion of the above, Replace the `config/app.php` content

```php
Illuminate\Translation\TranslationServiceProvider::class,
```
with:

```php
Overtrue\LaravelLang\TranslationServiceProvider::class,
```

#### Lumen

Add the following line to `bootstrap/app.php`:

```php
$app->register(Overtrue\LaravelLang\TranslationServiceProvider::class);
```

# Configuration

### Laravel
you can change the locale at `config/app.php`:

```php
'locale' => 'zh-CN',
```

### Lumen

set locale in `.env` file:

```
APP_LOCALE=zh-CN
```

# Usage

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

You need only add the partials item what you want.

### publish the language files to your project `resources/lang/` directory:

```shell
$ php artisan lang:publish [LOCALES] {--force}
```

examples:

```shell
$ php artisan lang:publish zh-CN,zh-HK,th,tk
```

# License

MIT

[badge_laravel]:      https://img.shields.io/badge/laravel-5.*-green.svg
[badge_lumen]:        https://img.shields.io/badge/lumen-5.*-green.svg
[badge_stable]:       https://img.shields.io/packagist/v/overtrue/laravel-lang.svg
[badge_unstable]:     https://img.shields.io/packagist/vpre/overtrue/laravel-lang.svg
[badge_downloads]:    https://img.shields.io/packagist/dt/overtrue/laravel-lang.svg?maxAge=2592000
[badge_license]:      https://img.shields.io/packagist/l/overtrue/laravel-lang.svg?maxAge=2592000

[link-github-repo]:   https://github.com/overtrue/laravel-lang
[link-packagist]:   https://packagist.org/packages/overtrue/laravel-lang
