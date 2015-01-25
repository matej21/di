<?php

/**
 * Test: Nette\DI\ContainerBuilder and manual specification of autowired types
 */

use Nette\DI,
	Tester\Assert;


require __DIR__ . '/../bootstrap.php';


interface IFoo
{

}


class Foo implements IFoo
{

}


class Bar implements IFoo
{

}


$builder = new DI\ContainerBuilder;
$builder->addDefinition('foo')
        ->setClass('Foo');
$builder->addDefinition('bar')
        ->setClass('Bar')
        ->setAutowiredTypes(array('Bar'));

$container = createContainer($builder);

Assert::type( 'Foo', $container->getByType('IFoo') );
Assert::type( 'Foo', $container->getByType('Foo') );
Assert::type( 'Bar', $container->getByType('Bar') );
