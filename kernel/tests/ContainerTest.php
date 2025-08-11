<?php

namespace meowprd\FelinePHP\tests;

use meowprd\FelinePHP\Container\Container;
use PHPUnit\Framework\TestCase;

class TestClass {}

class ContainerTest extends TestCase
{
    public function test_get_service_from_container() {
        $container = new Container();
        $container->add('test-class', TestClass::class);
        $this->assertInstanceOf(TestClass::class, $container->get('test-class'));
    }
}