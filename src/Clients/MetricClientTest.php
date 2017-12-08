<?php
/**
 * Created by PhpStorm.
 * User: kevbaldwyn
 * Date: 01/12/2017
 * Time: 11:55
 */

namespace Funeralzone\MetricClient\Clients;

use Funeralzone\MetricClient\TestCase;

final class MetricClientTest extends TestCase
{
	public function test_get_calls_read_client()
	{
		$key = 'foo.bar';

		$readClient = \Mockery::mock(ReadClientInterface::class);
		$readClient->shouldReceive('get')->with($key)->once();

		$client = new MetricClient(
			\Mockery::mock(WriteClientInterface::class),
			$readClient
		);

		$client->get($key);
	}

	public function test_increment_calls_write_client()
	{
		$key = 'foo.bar';

		$client = static::getMetricClientWithWriteClient($key, 'increment');

		$client->increment($key);
	}

	public function test_decrement_calls_write_client()
	{
		$key = 'foo.bar';

		$client = static::getMetricClientWithWriteClient($key, 'decrement');

		$client->decrement($key);
	}

	public function test_count_calls_write_client()
	{
		$key = 'foo.bar';
		$value = 4;

		$client = static::getMetricClientWithWriteClient($key, 'count', $value);

		$client->count($key, $value);
	}

	public function test_gauge_calls_metric_client()
	{
		$key = 'foo.bar';
		$value = 4;

		$client = static::getMetricClientWithWriteClient($key, 'gauge', $value);

		$client->gauge($key, $value);
	}

	public function test_set_calls_metric_client()
	{
		$key = 'foo.bar';
		$value = 'some-value';

		$client = static::getMetricClientWithWriteClient($key, 'set', $value);

		$client->set($key, $value);
	}

	public function test_timing_calls_write_client()
	{
		$key = 'foo.bar';
		$value = 12898;

		$client = static::getMetricClientWithWriteClient($key, 'timing', $value);

		$client->timing($key, $value);
	}

	public function test_start_timing_calls_write_client()
	{
		$key = 'foo.bar';

		$client = static::getMetricClientWithWriteClient($key, 'startTiming');

		$client->startTiming($key);
	}

	public function test_endTiming_calls_write_client()
	{
		$key = 'foo.bar';

		$client = static::getMetricClientWithWriteClient($key, 'endTiming');

		$client->endTiming($key);
	}

	public function test_startMemoryPorfile_calls_write_client()
	{
		$key = 'foo.bar';

		$client = static::getMetricClientWithWriteClient($key, 'startMemoryProfile');

		$client->startMemoryProfile($key);
	}

	public function test_endMemoryProfile_calls_write_client()
	{
		$key = 'foo.bar';

		$client = static::getMetricClientWithWriteClient($key, 'endMemoryProfile');

		$client->endMemoryProfile($key);
	}

	public function test_memory_calls_write_client()
	{
		$key = 'foo.bar';
		$value = 30987;

		$client = static::getMetricClientWithWriteClient($key, 'memory', $value);

		$client->memory($key, $value);
	}

	public function test_time_calls_write_client()
	{
		$key = 'foo.bar';
		$closure = function() {};

		$client = static::getMetricClientWithWriteClient($key, 'time', $closure);

		$client->time($key, $closure);
	}
	
	public function test_keyName_returns_key_with_no_prefix()
	{
		$client = new MetricClient(
			\Mockery::mock(WriteClientInterface::class),
			\Mockery::mock(ReadClientInterface::class),
			null
		);

		$expected = 'foo.bar';
		$this->assertSame($expected, $client->keyName('foo.bar'));
		$this->assertSame($expected, $client->keyName('.foo.bar'));
		$this->assertSame($expected, $client->keyName('foo.bar.'));
		$this->assertSame($expected, $client->keyName('.foo.bar.'));
	}

	public function test_keyName_returns_correctly_prefixed_key_name_without_dot()
	{
		$expected = 'boo.foo.bar';

		$client = new MetricClient(
			\Mockery::mock(WriteClientInterface::class),
			\Mockery::mock(ReadClientInterface::class),
			'boo'
		);

		$this->assertSame($expected, $client->keyName('foo.bar'));
		$this->assertSame($expected, $client->keyName('.foo.bar'));
		$this->assertSame($expected, $client->keyName('foo.bar.'));
		$this->assertSame($expected, $client->keyName('.foo.bar.'));
	}

	public function test_keyName_returns_correctly_prefixed_key_name_with_dot()
	{
		$expected = 'boo.foo.bar';

		$client = new MetricClient(
			\Mockery::mock(WriteClientInterface::class),
			\Mockery::mock(ReadClientInterface::class),
			'boo.'
		);

		$this->assertSame($expected, $client->keyName('foo.bar'));
		$this->assertSame($expected, $client->keyName('.foo.bar'));
		$this->assertSame($expected, $client->keyName('foo.bar.'));
		$this->assertSame($expected, $client->keyName('.foo.bar.'));
	}

	static public function getMetricClientWithWriteClient($key, $method, $value = null)
	{
		$writeClient = \Mockery::mock(WriteClientInterface::class);

		if (!is_null($value)) {
			$writeClient->shouldReceive($method)->with($key, $value)->once();
		} else {
			$writeClient->shouldReceive($method)->with($key)->once();
		}

		return new MetricClient(
			$writeClient,
			\Mockery::mock(ReadClientInterface::class)
		);
	}
}
