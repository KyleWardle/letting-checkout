<?php declare(strict_types=1);

use DI\Container;
use DI\ContainerBuilder;
use PHPUnit\Framework\TestCase;

class BaseTestCase extends TestCase
{
    protected Container $container;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $containerBuilder = new ContainerBuilder();
        $this->container = $containerBuilder->build();
    }
}