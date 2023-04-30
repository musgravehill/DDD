<?php

declare(strict_types=1);

namespace Test\Presentation\Web;

use Mezzio\Application;
use Mezzio\MiddlewareFactory;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\Constraint\Constraint;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
 
abstract class MyHelper extends TestCase
{
    protected ContainerInterface $container;
    protected Application $app;

    protected function setUp(): void
    {
        parent::setUp();
        $this->initContainer();
        $this->initApp();
        $this->initPipeline();
        $this->initRoutes();         
    }

    protected function initContainer(): void
    {
        $this->container = require __DIR__ . '/../../../src/Presentation/Web/config/container.php';   
    }

    protected function initApp(): void
    {
        $this->app = $this->container->get(Application::class);
    }

    protected function initPipeline(): void
    {
        $factory = $this->container->get(MiddlewareFactory::class);
        (require __DIR__ . '/../../../src/Presentation/Web/config/pipeline.php')($this->app, $factory, $this->container);
    }

    protected function initRoutes(): void
    {
        $factory = $this->container->get(MiddlewareFactory::class);
        (require __DIR__ . '/../../../src/Presentation/Web/config/routes.php')($this->app, $factory, $this->container);
    }
    
}
