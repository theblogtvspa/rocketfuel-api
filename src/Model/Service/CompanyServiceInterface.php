<?php

namespace DigiTouch\RocketFuel\Model\Service;

use stdClass;

/**
 * Interface CompanyServiceInterface
 *
 * @package DigiTouch\RocketFuel\Model\Service
 */
interface CompanyServiceInterface
{
    /**
     * Get a list of available companies
     *
     * @return stdClass[]
     *
     * @throws \Httpful\Exception\ConnectionErrorException
     * @throws \DigiTouch\RocketFuel\Model\Exception\RocketFuelApiException
     */
    public function getCompaniesList();

    /**
     * Get the information about a single company
     *
     * @param int $companyId
     *
     * @return stdClass
     *
     * @throws \Httpful\Exception\ConnectionErrorException
     * @throws \DigiTouch\RocketFuel\Model\Exception\RocketFuelApiException
     */
    public function getCompany($companyId);
}
