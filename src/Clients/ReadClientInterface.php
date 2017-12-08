<?php

namespace Funeralzone\MetricClient\Clients;

/**
 * Created by PhpStorm.
 * User: kevbaldwyn
 * Date: 27/11/2017
 * Time: 17:16
 */
interface ReadClientInterface
{
    public function get($key);
}
