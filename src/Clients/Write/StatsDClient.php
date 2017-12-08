<?php
/**
 * Created by PhpStorm.
 * User: kevbaldwyn
 * Date: 27/11/2017
 * Time: 17:23
 */

namespace Funeralzone\MetricClient\Clients\Write;


use Domnikl\Statsd\Client;
use Funeralzone\MetricClient\Clients\WriteClientInterface;

final class StatsDClient implements WriteClientInterface
{
	/**
	 * @var Client
	 */
	private $client;

	public function __construct(Client $client)
	{
		$this->client = $client;
		$this->client->setNamespace('');
	}

	public function increment($key)
	{
		$this->client->increment($key);
	}

	public function decrement($key)
	{
		$this->client->decrement($key);
	}

	public function count(
		$key,
		$value
	) {
		$this->client->count($key, $value);
	}

	public function gauge(
		$key,
		$value
	) {
		$this->client->gauge($key, $value);
	}

	public function set(
		$key,
		$value
	) {
		$this->client->set($key, $value);
	}

	public function timing(
		$key,
		$value
	) {
		$this->client->timing($key, $value);
	}

	public function startTiming($key)
	{
		$this->client->startTiming($key);
	}

	public function endTiming($key)
	{
		$this->client->endTiming($key);
	}

	public function startMemoryProfile($key)
	{
		$this->client->startMemoryProfile($key);
	}

	public function endMemoryProfile($key)
	{
		$this->client->endMemoryProfile($key);
	}

	public function memory(
		$key,
		$memory = null
	) {
		$this->client->memory($key, $memory);
	}

	public function time(
		$key,
		\Closure $closure
	) {
		$this->client->time($key, $closure);
	}
}
