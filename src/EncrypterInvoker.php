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

use Hyperf\Contract\ConfigInterface;
use Hyperf\Utils\Str;
use Illuminate\Encryption\Encrypter;
use Illuminate\Encryption\MissingAppKeyException;
use Psr\Container\ContainerInterface;

class EncrypterInvoker
{
    public function __invoke(ContainerInterface $container, $name = 'default')
    {
        $config = $container->get(ConfigInterface::class)->get('i_encryption.' . $name, []);

        return new Encrypter($this->parseKey($config), $config['cipher']);
    }

    /**
     * Parse the encryption key.
     *
     * @return string
     */
    protected function parseKey(array $config)
    {
        if (Str::startsWith($key = $this->key($config), $prefix = 'base64:')) {
            $key = base64_decode(Str::after($key, $prefix));
        }

        return $key;
    }

    /**
     * Extract the encryption key from the given configuration.
     *
     * @throws \RuntimeException
     * @return string
     */
    protected function key(array $config)
    {
        return tap($config['key'], function ($key) {
            if (empty($key)) {
                throw new MissingAppKeyException();
            }
        });
    }
}
