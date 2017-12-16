<?php

/*
|--------------------------------------------------------------------------
| Register The Composer Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader
| for our application. We just need to utilize it! We'll require it
| into the script here so that we do not have to worry about the
| loading of any our classes "manually". Feels great to relax.
|
*/

require __DIR__.'/../vendor/autoload.php';

use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Set The Default Timezone
|--------------------------------------------------------------------------
|
| Here we will set the default timezone for PHP. PHP is notoriously mean
| if the timezone is not explicitly set. This will be used by each of
| the PHP date and date-time functions throughout the application.
|
*/

date_default_timezone_set('UTC');

Carbon::setTestNow(Carbon::now());

/*
|--------------------------------------------------------------------------
| PHPUnit 4/5/6 Support
|--------------------------------------------------------------------------
|
| PHPUnit 6 introduced a breaking change that removed 
| PHPUnit_Framework_TestCase as a base class, and replaced it with
| \PHPUnit\Framework\TestCase 
|
*/

if (! class_exists('\PHPUnit_Framework_TestCase') && class_exists('\PHPUnit\Framework\TestCase')) {
    class_alias('\PHPUnit\Framework\TestCase', '\PHPUnit_Framework_TestCase');
}

if (! class_exists('\PHPUnit_Framework_Assert') && class_exists('\PHPUnit\Framework\Assert')) {
    class_alias('\PHPUnit\Framework\Assert', 'PHPUnit_Framework_Assert');
}

if (! class_exists('\PHPUnit_Framework_ExpectationFailedException') && class_exists('\PHPUnit\Framework\ExpectationFailedException')) {
    class_alias('\PHPUnit\Framework\ExpectationFailedException', 'PHPUnit_Framework_ExpectationFailedException');
}

if (! class_exists('\PHPUnit_Framework_Constraint_Not') && class_exists('\PHPUnit\Framework\Constraint\LogicalNot')) {
    class_alias('\PHPUnit\Framework\Constraint\LogicalNot', 'PHPUnit_Framework_Constraint_Not');
}

if (! class_exists('\PHPUnit_Framework_Constraint') && class_exists('\PHPUnit\Framework\Constraint\Constraint')) {
    class_alias('\PHPUnit\Framework\Constraint\Constraint', 'PHPUnit_Framework_Constraint');
}

if (! class_exists('\PHPUnit_Framework_Error_Notice') && class_exists('\PHPUnit\Framework\Error\Notice')) {
    class_alias('\PHPUnit\Framework\Error\Notice', 'PHPUnit_Framework_Error_Notice');
}