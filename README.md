<h1 align="center">Laravel-lang</h1>
<p align="center">75 languages support for Laravel 5 application based on <a href="https://github.com/Laravel-Lang/lang">Laravel-Lang/lang</a>.
<p align="center"><a href="https://github.com/overtrue/laravel-lang"><img alt="For Laravel 5" src="https://img.shields.io/badge/laravel-5.*-green.svg" style="max-width:100%;"></a>
<a href="https://github.com/overtrue/laravel-lang"><img alt="For Lumen 5" src="https://img.shields.io/badge/lumen-5.*-green.svg" style="max-width:100%;"></a>
<a href="https://packagist.org/packages/overtrue/laravel-lang"><img alt="Latest Stable Version" src="https://img.shields.io/packagist/v/overtrue/laravel-lang.svg" style="max-width:100%;"></a>
<a href="https://packagist.org/packages/overtrue/laravel-lang"><img alt="Latest Unstable Version" src="https://img.shields.io/packagist/vpre/overtrue/laravel-lang.svg" style="max-width:100%;"></a>
<a href="https://packagist.org/packages/overtrue/laravel-lang"><img alt="Total Downloads" src="https://img.shields.io/packagist/dt/overtrue/laravel-lang.svg?maxAge=2592000" style="max-width:100%;"></a>
<a href="https://packagist.org/packages/overtrue/laravel-lang"><img alt="License" src="https://img.shields.io/packagist/l/overtrue/laravel-lang.svg?maxAge=2592000" style="max-width:100%;"></a></p>

# Features

- Laravel 5+ && Lumen support.
- Translations Publisher.
- Made with 💖.

# Install

```shell
$ composer require "overtrue/laravel-lang:~4.0"
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
'locale' => 'zh_CN',
```

### Lumen

set locale in `.env` file:

```
APP_LOCALE=zh_CN
```

# Usage

There is no difference with the usual usage.

If you need to add additional language content, Please create a file in the `resources/lang/{LANGUAGE}` directory.

### Add custom language items

Here, for example in Chinese:

`resources/lang/zh_CN/demo.php`:

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

`resources/lang/zh_CN/passwords.php`:

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
$ php artisan lang:publish zh_CN,zh_HK,th,tk
```

## PHP 扩展包开发

> 想知道如何从零开始构建 PHP 扩展包？
>
> 请关注我的实战课程，我会在此课程中分享一些扩展开发经验 —— [《PHP 扩展包实战教程 - 从入门到发布》](https://learnku.com/courses/creating-package)

# License

MIT
