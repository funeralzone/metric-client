<?php
/**
 * Created by PhpStorm.
 * User: kevbaldwyn
 * Date: 06/12/2017
 * Time: 17:02
 */

namespace Funeralzone\MetricClient;


use Funeralzone\MetricClient\Clients\MetricClient;

class MetricTest extends TestCase
{
    public function test_client_sets_member_property()
    {
        $client = static::getClientMock();

        $setClient = Metric::client($client);
        $this->assertSame($client, $setClient);

        $getClient = Metric::client();
        $this->assertSame($client, $getClient);
    }

    public function test_get_calls_client()
    {
        $key = 'foo.bar';
        Metric::client(static::getClientMock('get', $key));
        Metric::get($key);
    }

    public function test_increment_calls_client()
    {
        $key = 'foo.bar';
        Metric::client(static::getClientMock('increment', $key));
        Metric::increment($key);
    }

    public function test_decrement_calls_client()
    {
        $key = 'foo.bar';
        Metric::client(static::getClientMock('decrement', $key));
        Metric::decrement($key);
    }

    public function test_count_calls_client()
    {
        $key   = 'foo.bar';
        $value = 4;
        Metric::client(static::getClientMock('count', $key, $value));
        Metric::count($key, $value);
    }

    public function test_gauge_calls_client()
    {
        $key   = 'foo.bar';
        $value = 4;
        Metric::client(static::getClientMock('gauge', $key, $value));
        Metric::gauge($key, $value);
    }

    public function test_set_calls_client()
    {
        $key   = 'foo.bar';
        $value = 4;
        Metric::client(static::getClientMock('set', $key, $value));
        Metric::set($key, $value);
    }

    public function test_timing_calls_client()
    {
        $key   = 'foo.bar';
        $value = 9095;
        Metric::client(static::getClientMock('timing', $key, $value));
        Metric::timing($key, $value);
    }

    public function test_startTiming_calls_client()
    {
        $key = 'foo.bar';
        Metric::client(static::getClientMock('startTiming', $key));
        Metric::startTiming($key);
    }

    public function test_endTiming_calls_client()
    {
        $key = 'foo.bar';
        Metric::client(static::getClientMock('endTiming', $key));
        Metric::endTiming($key);
    }

    public function test_startMemoryProfile_calls_client()
    {
        $key = 'foo.bar';
        Metric::client(static::getClientMock('startMemoryProfile', $key));
        Metric::startMemoryProfile($key);
    }

    public function test_endMemoryProfile_calls_client()
    {
        $key = 'foo.bar';
        Metric::client(static::getClientMock('endMemoryProfile', $key));
        Metric::endMemoryProfile($key);
    }

    public function test_memory_calls_client()
    {
        $key   = 'foo.bar';
        $value = 5689896;
        Metric::client(static::getClientMock('memory', $key, $value));
        Metric::memory($key, $value);
    }

    public function test_time_calls_client()
    {
        $key   = 'foo.bar';
        $value = function () {
        };
        Metric::client(static::getClientMock('time', $key, $value));
        Metric::time($key, $value);
    }


    public static function getClientMock($method = null, $key = null, $value = null)
    {
        $client = \Mockery::mock(MetricClient::class);

        if (!is_null($method)) {
            if (!is_null($value)) {
                $client->shouldReceive($method)->with($key, $value)->once();
            } else {
                $client->shouldReceive($method)->with($key)->once();
            }
        }

        return $client;
    }
}
