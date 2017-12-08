<?php

namespace Funeralzone\MetricClient\Clients;

/**
 * Created by PhpStorm.
 * User: kevbaldwyn
 * Date: 27/11/2017
 * Time: 17:17
 */
interface WriteClientInterface
{
    public function increment($key);

    public function decrement($key);

    public function count($key, $value);

    public function gauge($key, $value);

    public function set($key, $value);

    public function timing($key, $value);

    public function startTiming($key);

    public function endTiming($key);

    public function startMemoryProfile($key);

    public function endMemoryProfile($key);

    public function memory($key, $memory = null);

    public function time($key, \Closure $closure);
}
