<?php
/**
 * Created by PhpStorm.
 * User: kevbaldwyn
 * Date: 27/11/2017
 * Time: 17:36
 */

namespace Funeralzone\MetricClient;

use Funeralzone\MetricClient\Clients\MetricClient;

class Metric
{
    /**
     * @var MetricClient
     */
    private static $client = null;

    /**
     * @return MetricClient
     */
    public static function client(MetricClient $client = null)
    {
        if (!is_null($client)) {
            static::$client = $client;
        }

        return static::$client;
    }

    public static function get($key)
    {
        $client = static::client();

        return $client->get($key);
    }

    public static function increment($key)
    {
        $client = static::client();
        $client->increment($key);
    }

    public static function decrement($key)
    {
        $client = static::client();
        $client->decrement($key);
    }

    public static function count(
        $key,
        $value
    ) {
        $client = static::client();
        $client->count($key, $value);
    }

    public static function gauge(
        $key,
        $value
    ) {
        $client = static::client();
        $client->gauge($key, $value);
    }

    public static function set(
        $key,
        $value
    ) {
        $client = static::client();
        $client->set($key, $value);
    }

    public static function timing(
        $key,
        $value
    ) {
        $client = static::client();
        $client->timing($key, $value);
    }

    public static function startTiming($key)
    {
        $client = static::client();
        $client->startTiming($key);
    }

    public static function endTiming($key)
    {
        $client = static::client();
        $client->endTiming($key);
    }

    public static function startMemoryProfile($key)
    {
        $client = static::client();
        $client->startMemoryProfile($key);
    }

    public static function endMemoryProfile($key)
    {
        $client = static::client();
        $client->endMemoryProfile($key);
    }

    public static function memory(
        $key,
        $memory = null
    ) {
        $client = static::client();
        $client->memory($key, $memory);
    }

    public static function time(
        $key,
        \Closure $closure
    ) {
        $client = static::client();
        $client->time($key, $closure);
    }
}
