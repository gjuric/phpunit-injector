<?php
declare(strict_types=1);

namespace Zalas\PHPUnit\DependencyInjection\Tests\Service;

use PHPUnit\Framework\TestCase;
use Zalas\PHPUnit\DependencyInjection\Service\Exception\MissingServicePropertyException;
use Zalas\PHPUnit\DependencyInjection\Service\RequiredService;
use Zalas\PHPUnit\DependencyInjection\Tests\Service\Fixtures\Foo;

class RequiredServiceTest extends TestCase
{
    public function test_it_exposes_the_property_name_and_service_id()
    {
        $serviceProperty = new RequiredService(Foo::class, 'foo', 'my.service.id');

        $this->assertSame(Foo::class, $serviceProperty->getClassName());
        $this->assertSame('foo', $serviceProperty->getPropertyName());
        $this->assertSame('my.service.id', $serviceProperty->getServiceId());
    }

    public function test_it_throws_an_exception_if_class_property_does_not_exist()
    {
        $this->expectException(MissingServicePropertyException::class);

        new RequiredService(Foo::class, 'bar', 'my.service.id');
    }
}