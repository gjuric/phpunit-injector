<?php
declare(strict_types=1);

namespace Zalas\PHPUnit\DependencyInjection\Tests\TestCase\Fixtures;

use Psr\Container\ContainerInterface;
use Zalas\PHPUnit\DependencyInjection\TestCase\ServiceContainerTestCase;

class TestCase1 implements ServiceContainerTestCase
{
    private $service1;
    private $service2;

    public function createContainer(array $requiredServices): ContainerInterface
    {
    }
}