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
namespace Illuminat\Encryption;

use Illuminate\Encryption\Contracts\Encrypter as EncrypterInterface;
use Illuminate\Encryption\Encrypter;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
                Encrypter::class => EncrypterInvoker::class,
                EncrypterInterface::class => EncrypterInvoker::class,
            ],
            'commands' => [
            ],
            'annotations' => [
                'scan' => [
                    'paths' => [
                        __DIR__,
                    ],
                ],
            ],
            'publish' => [
                [
                    'id' => 'config',
                    'description' => 'The config for i-encryption.',
                    'source' => __DIR__ . '/../publish/i_encryption.php',
                    'destination' => BASE_PATH . '/config/autoload/i_encryption.php',
                ],
            ],
        ];
    }
}
