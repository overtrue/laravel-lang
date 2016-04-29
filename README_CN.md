# Laravel-lang

Laravel 5 语言包，包含 52 种语言, 基于 [caouecs/Laravel-lang](https://github.com/caouecs/Laravel-lang).

[![For Laravel 5][badge_laravel]][link-github-repo]
[![For Lumen 5][badge_lumen]][link-github-repo]
[![Latest Stable Version][badge_stable]][link-packagist]
[![Latest Unstable Version][badge_unstable]][link-packagist]
[![Total Downloads][badge_downloads]][link-packagist]
[![License][badge_license]][link-packagist]

# Features

- Laravel 5 & Lumen support.
- Translations Publisher.
- Made with 💖.

# 安装

```shell
composer require "overtrue/laravel-lang:~2.1"
```

#### Laraval 5.*

完成上面的操作后，将项目文件 `config/app.php` 中的下一行

```php
Illuminate\Translation\TranslationServiceProvider::class,
```

替换为：

```php
Overtrue\LaravelLang\TranslationServiceProvider::class,
```

#### Lumen

在 `bootstrap/app.php` 中添加下面这行:

```php
$app->register(Overtrue\LaravelLang\TranslationServiceProvider::class);
```

# 配置

### Laravel

修改项目语言 `config/app.php`：

```php
'locale' => 'zh-CN',
```

### Lumen

在 `.env` 文件中修改语言：
```
APP_LOCALE=zh-CN
```



# 使用

和正常使用一样，你如果需要额外添加语言项，请在 `resources/lang/zh-CN/` 下建立你自己的文件即可，也可以建立同样的文件来替换掉默认的语言部分。

### 添加自定义语言项

例如创建文件 `resources/lang/zh-CN/demo.php`:

```php
<?php

return [
    'user_not_exists'    => '用户不存在',
    'email_has_registed' => '邮箱 :email 已经注册过！',
];
```
然后在任何地方：

```php
echo trans('demo.user_not_exists'); // 用户不存在
echo trans('demo.email_has_registed', ['email' => 'anzhengchao@gmail.com']);
// 邮箱 anzhengchao@gmail.com 已经注册过！
```

### 替换掉默认的语言项

我们假设想替换掉密码重围成功的提示文字为例，创建 `resources/lang/zh-CN/passwords.php`:

```php
<?php

return [
    'reset' => '您的密码已经重置成功了，你可以使用新的密码登录了!',
];
```

只放置你需要替换的部分即可。


### 将翻译文件拷贝到你的项目 `resources/lang/` 目录下:

```shell
$ php artisan lang:publish LOCALES {--force}
```

examples:

```shell
$ php artisan lang:publish zh-CN,zh-HK,th,tk
```

# License

MIT
