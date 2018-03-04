<?php
declare(strict_types=1);

namespace Zalas\Injector\PHPUnit\Tests\Symfony\TestCase\Fixtures;

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel;
use Zalas\Injector\PHPUnit\Symfony\Compiler\Discovery\ClassFinder;
use Zalas\Injector\PHPUnit\Symfony\Compiler\Discovery\PropertyDiscovery;
use Zalas\Injector\PHPUnit\Symfony\Compiler\ExposeServicesForTestsPass;

class AnotherTestKernel extends Kernel
{
    public function registerBundles()
    {
        return [];
    }

    public function getCacheDir()
    {
        return \sys_get_temp_dir().'/ZalasPHPUnitInjector2/cache/'.$this->environment;
    }

    public function getLogDir()
    {
        return \sys_get_temp_dir().'/ZalasPHPUnitInjector2/logs';
    }

    /**
     * Loads the container configuration.
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(function (ContainerBuilder $container) use ($loader) {
            $container->register(Service1::class, Service1::class);
        });
    }

    protected function build(ContainerBuilder $container)
    {
        if ('test' === $this->getEnvironment()) {
            $container->addCompilerPass(
                new ExposeServicesForTestsPass(
                    new PropertyDiscovery(new ClassFinder(__DIR__ . '/../'))
                )
            );
        }
    }
}
