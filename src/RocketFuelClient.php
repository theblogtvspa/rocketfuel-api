<?php

namespace DigiTouch\RocketFuel;

use DigiTouch\RocketFuel\Model\BaseRequestBuilderInterface;
use DigiTouch\RocketFuel\Model\RocketFuelClientInterface;
use DigiTouch\RocketFuel\Model\Service\AdvertisementServiceInterface;
use DigiTouch\RocketFuel\Model\Service\CampaignServiceInterface;
use DigiTouch\RocketFuel\Model\Service\CompanyServiceInterface;
use DigiTouch\RocketFuel\Model\Service\LineItemServiceInterface;
use DigiTouch\RocketFuel\Service\AdvertisementService;
use DigiTouch\RocketFuel\Service\CampaignService;
use DigiTouch\RocketFuel\Service\CompanyService;
use DigiTouch\RocketFuel\Service\LineItemService;

/**
 * Class RocketFuelClient
 *
 * @package DigiTouch\RocketFuel
 */
class RocketFuelClient implements RocketFuelClientInterface
{
    /** @var RocketFuelClient */
    private static $instance;

    /** @var BaseRequestBuilderInterface */
    private $requestBuilder;

    /**
     * {@inheritdoc}
     */
    public static function getInstance(
        $apiEndpoint,
        $authenticationToken
    ) {
        if (null === self::$instance) {
            self::$instance = new self($apiEndpoint, $authenticationToken);
        }

        return static::$instance;
    }

    /**
     * RocketFuelClient constructor.
     *
     * @param string $apiEndpoint
     * @param string $authenticationToken
     */
    private function __construct($apiEndpoint, $authenticationToken)
    {
        $this->requestBuilder = new BaseRequestBuilder($authenticationToken, $apiEndpoint);
    }

    /**
     * {@inheritdoc}
     */
    public function get($serviceFQCN)
    {
        switch ($serviceFQCN) {
            case AdvertisementServiceInterface::class:
                return new AdvertisementService($this->requestBuilder);
            case CampaignServiceInterface::class:
                return new CampaignService($this->requestBuilder);
            case CompanyServiceInterface::class:
                return new CompanyService($this->requestBuilder);
            case LineItemServiceInterface::class:
                return new LineItemService($this->requestBuilder);
            default:
                throw new \LogicException(sprintf('Unhandled interface "%s"', $serviceFQCN));
        }
    }
}