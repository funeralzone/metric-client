<?php
/**
 * Created by PhpStorm.
 * User: kevbaldwyn
 * Date: 01/12/2017
 * Time: 11:50
 */

namespace Funeralzone\MetricClient;


class TestCase extends \PHPUnit_Framework_TestCase
{
    protected function tearDown()
    {
        \Mockery::close();
    }
}
