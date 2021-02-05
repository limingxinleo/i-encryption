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
namespace Illuminate\Encryption;

use Illuminate\Encryption\Contracts\Encrypter as EncrypterInterface;
use Psr\Container\ContainerInterface;

class EncrypterFactory
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var EncrypterInterface[]
     */
    protected $encrypters = [];

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function make(string $name): EncrypterInterface
    {
        if ($encrypter = $this->encrypters[$name] ?? null) {
            return $encrypter;
        }

        return $this->encrypters[$name] = (new EncrypterInvoker())($this->container, $name);
    }
}
