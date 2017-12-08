<?php
/**
 * Created by PhpStorm.
 * User: kevbaldwyn
 * Date: 29/11/2017
 * Time: 12:45
 */

namespace Funeralzone\MetricClient\Clients;

class MetricClient
{
    /**
     * @var WriteClientInterface
     */
    private $writeClient;

    /**
     * @var ReadClientInterface
     */
    private $readClient;

    /**
     * @var null
     */
    private $prefix;

    /**
     * Metric constructor.
     *
     * @param WriteClientInterface $writeClient
     * @param ReadClientInterface  $readClient
     */
    public function __construct(
        WriteClientInterface $writeClient,
        ReadClientInterface $readClient,
        $prefix = null
    ) {
        $this->writeClient = $writeClient;
        $this->readClient  = $readClient;
        $this->prefix      = $prefix;
    }

    public function get($key)
    {
        return $this->readClient->get($this->keyName($key));
    }

    public function increment($key)
    {
        $this->writeClient->increment($this->keyName($key));
    }

    public function decrement($key)
    {
        $this->writeClient->decrement($this->keyName($key));
    }

    public function count(
        $key,
        $value
    ) {
        $this->writeClient->count(
            $this->keyName($key),
            $value
        );
    }

    public function gauge(
        $key,
        $value
    ) {
        $this->writeClient->gauge(
            $this->keyName($key),
            $value
        );
    }

    public function set(
        $key,
        $value
    ) {
        $this->writeClient->set(
            $this->keyName($key),
            $value
        );
    }

    public function timing(
        $key,
        $value
    ) {
        $this->writeClient->timing($this->keyName($key), $value);
    }

    public function startTiming($key)
    {
        $this->writeClient->startTiming($this->keyName($key));
    }

    public function endTiming($key)
    {
        $this->writeClient->endTiming($this->keyName($key));
    }

    public function startMemoryProfile($key)
    {
        $this->writeClient->startMemoryProfile($this->keyName($key));
    }

    public function endMemoryProfile($key)
    {
        $this->writeClient->endMemoryProfile($this->keyName($key));
    }

    public function memory(
        $key,
        $memory = null
    ) {
        $this->writeClient->memory($this->keyName($key), $memory);
    }

    public function time(
        $key,
        \Closure $closure
    ) {
        $this->writeClient->time($this->keyName($key), $closure);
    }


    public function keyName($key)
    {
        $key = ltrim(rtrim($key, '.'), '.');
        if (is_null($this->prefix) || trim($this->prefix) == '') {
            return $key;
        }

        return sprintf(
            '%s.%s',
            ltrim(rtrim($this->prefix, '.'), '.'),
            $key
        );
    }
}
