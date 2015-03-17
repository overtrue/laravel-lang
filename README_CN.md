# Laravel-lang

Laravel 5 语言包，包含37种语言, 基于 [Laravel4-lang](https://github.com/caouecs/Laravel4-lang).

## 安装

```shell
composer require "overtrue/laravel-lang:dev-master"
```

或者添加下面一行到你的项目 `composer.json` 中 `require` 部分:

```json
"require": {
    "overtrue/laravel-lang": "dev-master"
}
```
然后

```shell
composer update
```

完成上面的操作后，将项目文件 `config/app.php` 中的下一行

```php
'Illuminate\Translation\TranslationServiceProvider'
```

替换为：

```php
'Overtrue\LaravelLang\TranslationServiceProvider',
```

即可。

## 配置

修改项目语言 `config/app.php`：

```php
'locale' => 'zh-CN',
```

## 使用

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

## License

MIT
