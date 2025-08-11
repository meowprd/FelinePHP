<?php

namespace meowprd\FelinePHP\tests;

use meowprd\FelinePHP\Container\Container;
use meowprd\FelinePHP\Exceptions\ContainerException;
use PHPUnit\Framework\TestCase;

class TestClass {}

class ContainerTest extends TestCase
{
    public function test_get_service_from_container() {
        $container = new Container();
        $container->add('test-class', TestClass::class);
        $this->assertInstanceOf(TestClass::class, $container->get('test-class'));
    }

    public function test_container_exception_on_wrong_class() {
        $container = new Container();
        $this->expectException(ContainerException::class);
        $container->add('unknown-class');
    }

    public function test_has_method() {
        $container = new Container();
        $container->add('test-class', TestClass::class);
        $this->assertTrue($container->has('test-class'));
        $this->assertFalse($container->has('unknown-class'));
    }
}