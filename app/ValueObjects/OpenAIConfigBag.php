<?php

namespace App\ValueObjects;

class OpenAIConfigBag
{
    /**
     * 
     */
    private readonly string $apiKey;

    /**
     * 
     */
    private readonly string $auth;

    /**
     * 
     */
    private readonly string $model;

    /**
     * 
     */
    private readonly float $temperature;

    /**
     * 
     */
    public function __construct(private readonly array $config)
    {
        $this->apiKey = $config['api_key'];
        $this->auth = "Bearer " . $config['api_key'];
        $this->model = $config['model'];
        $this->temperature = floatval($config['temperature']);
    }

    /**
     * 
     */
    public function getRawConfig(): array
    {
        return $this->config;
    }

    /**
     * 
     */
    public function apiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * 
     */
    public function auth(): string
    {
        return $this->auth;
    }

    /**
     * 
     */
    public function model(): string
    {
        return $this->model;
    }

    /**
     * 
     */
    public function temperature(): float
    {
        return  $this->temperature;
    }
}
