<?php
/**
 * Created by PhpStorm.
 * User: kevbaldwyn
 * Date: 06/12/2017
 * Time: 17:49
 */

namespace Funeralzone\MetricClient\Clients\Write;


use Domnikl\Statsd\Client;
use Domnikl\Statsd\Connection;
use Funeralzone\MetricClient\TestCase;

class StatsDClientTest extends TestCase
{
    public function test_constructor_resets_metric_namespace()
    {
        $statsD = new Client(
            \Mockery::mock(Connection::class),
            'foo.bye'
        );

        // check first
        $this->assertSame('foo.bye', $statsD->getNamespace());

        // instantiating the class should reset the metric namespace
        new StatsDClient($statsD);
        $this->assertSame('', $statsD->getNamespace());
    }

    public function test_increment_calls_client()
    {
        $key = 'foo.bar';

        $statsD = new StatsDClient(static::getClient($key, 'increment'));
        $statsD->increment($key);
    }

    public function test_decrement_calls_client()
    {
        $key = 'foo.bar';

        $statsD = new StatsDClient(static::getClient($key, 'decrement'));
        $statsD->decrement($key);
    }

    public function test_count_calls_client()
    {
        $key   = 'foo.bar';
        $value = 4;

        $statsD = new StatsDClient(static::getClient($key, 'count', $value));
        $statsD->count($key, $value);
    }

    public function test_gauge_calls_client()
    {
        $key   = 'foo.bar';
        $value = 4;

        $statsD = new StatsDClient(static::getClient($key, 'gauge', $value));
        $statsD->gauge($key, $value);
    }

    public function test_set_calls_client()
    {
        $key   = 'foo.bar';
        $value = 4;

        $statsD = new StatsDClient(static::getClient($key, 'set', $value));
        $statsD->set($key, $value);
    }

    public function test_timing_calls_client()
    {
        $key   = 'foo.bar';
        $value = 4734;

        $statsD = new StatsDClient(static::getClient($key, 'timing', $value));
        $statsD->timing($key, $value);
    }

    public function test_startTiming_calls_client()
    {
        $key = 'foo.bar';

        $statsD = new StatsDClient(static::getClient($key, 'startTiming'));
        $statsD->startTiming($key);
    }

    public function test_endTiming_calls_client()
    {
        $key = 'foo.bar';

        $statsD = new StatsDClient(static::getClient($key, 'endTiming'));
        $statsD->endTiming($key);
    }

    public function test_startMemoryProfile_calls_client()
    {
        $key = 'foo.bar';

        $statsD = new StatsDClient(static::getClient($key, 'startMemoryProfile'));
        $statsD->startMemoryProfile($key);
    }

    public function test_endMemoryProfile_calls_client()
    {
        $key = 'foo.bar';

        $statsD = new StatsDClient(static::getClient($key, 'endMemoryProfile'));
        $statsD->endMemoryProfile($key);
    }

    public function test_memory_calls_client()
    {
        $key   = 'foo.bar';
        $value = 4734;

        $statsD = new StatsDClient(static::getClient($key, 'memory', $value));
        $statsD->memory($key, $value);
    }

    public function test_time_calls_client()
    {
        $key   = 'foo.bar';
        $value = function () {
        };

        $statsD = new StatsDClient(static::getClient($key, 'time', $value));
        $statsD->time($key, $value);
    }


    static public function getClient($key, $method, $value = null)
    {
        $client = \Mockery::mock(Client::class);
        $client->shouldReceive('setNamespace');

        if (!is_null($value)) {
            $client->shouldReceive($method)->with($key, $value)->once();
        } else {
            $client->shouldReceive($method)->with($key)->once();
        }

        return $client;
    }
}
