# Laravel 加密解密

[illuminate/encryption](https://github.com/illuminate/encryption)

## 安装

```
composer require limingxinleo/i-encryption
```

## 配置

```php
<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
return [
    'default' => [
        'key' => '',
        'cipher' => '',
    ],
];

```

## 使用

```php
use Hyperf\Utils\ApplicationContext;
use Illuminate\Encryption\Contracts\Encrypter;

$encrypter = ApplicationContext::getContainer()->get(Encrypter::class);

$encrypted = $encrypter->encrypt('foo');
$decrypted = $encrypter->decrypt($encrypted);
```
