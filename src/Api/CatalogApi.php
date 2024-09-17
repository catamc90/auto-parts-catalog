<?php

namespace App\Api;

class CatalogApi
{
    private RapidBaseApi $rapidBaseApi;

    public function __construct(RapidBaseApi $rapidBaseApi)
    {
        $this->rapidBaseApi = $rapidBaseApi;
    }

    /**
     * Validate that an ID is valid (greater than zero).
     *
     * @param int $id
     * @param string $idName
     * @throws \InvalidArgumentException
     */
    private function validateId(int $id, string $idName): void
    {
        if ($id <= 0) {
            throw new \InvalidArgumentException(sprintf('Invalid %s provided.', $idName));
        }
    }

    public function getAllLanguages()
    {
        return $this->rapidBaseApi->fetchData('languages/list');
    }

    public function getLanguageDetailsById(int $langId)
    {
        $this->validateId($langId, 'Language ID');


        $endpoint = sprintf('languages/get-language/lang-id/%d', $langId);
        return $this->rapidBaseApi->fetchData($endpoint);
    }

    public function getAllCountries()
    {
        return $this->rapidBaseApi->fetchData('countries/list');
    }

    public function getCountryDetailsById(int $langId, int $countryId)
    {
        $this->validateId($countryId, 'Country ID');


        $endpoint = sprintf('countries/get-country/lang-id/%d/country-filter-id/%d', $langId, $countryId);
        return $this->rapidBaseApi->fetchData($endpoint);
    }

    /**
     * @param int $langId
     * @return array
     */
    public function getAllCountriesByLanguageId(int $langId)
    {
        $this->validateId($langId, 'Language ID');


        $endpoint = sprintf('countries/list-countries-by-lang-id/%d', $langId);
        return $this->rapidBaseApi->fetchData($endpoint);
    }

    public function getAllVehicleTypes()
    {
        return $this->rapidBaseApi->fetchData('types/list-vehicles-type');
    }

    public function getAllSuppliers()
    {
        return $this->rapidBaseApi->fetchData('suppliers/list');
    }

    /**
     * @param $typeId
     * @param $langid
     * @param $countryId
     * @return array
     */
    public function getManufacturers(int $typeId, int $langId, int $countryId): ?array
    {
        $this->validateId($typeId, 'Type ID');
        $this->validateId($langId, 'Language ID');
        $this->validateId($countryId, 'Country ID');


        $endpoint = sprintf('manufacturers/list/lang-id/%d/country-filter-id/%d/type-id/%d', $langId, $countryId, $typeId);
        return $this->rapidBaseApi->fetchData($endpoint);
    }

    public function getModels(int $manufacturerId, int $langId, int $countryId, int $typeId)
    {
        $this->validateId($manufacturerId, 'Manufacturer ID');
        $this->validateId($typeId, 'Type ID');
        $this->validateId($langId, 'Language ID');
        $this->validateId($countryId, 'Country ID');

        $endpoint = sprintf('models/list/manufacturer-id/%d/lang-id/%d/country-filter-id/%d/type-id/%d', $manufacturerId, $langId, $countryId, $typeId);
        return $this->rapidBaseApi->fetchData($endpoint);
    }

    public function getVehicleTypeDetailedInformation(int $vehicleId, int $manufacturerId, int $langId, int $countryId, int $typeId)
    {
        $this->validateId($vehicleId, 'Vehicle ID');
        $this->validateId($manufacturerId, 'Manufacturer ID');
        $this->validateId($typeId, 'Type ID');
        $this->validateId($langId, 'Language ID');
        $this->validateId($countryId, 'Country ID');


        $endpoint = sprintf('types/vehicle-type-details/%d/manufacturer-id/%d/lang-id/%d/country-filter-id/%d/type-id/%d',$vehicleId, $manufacturerId, $langId, $countryId, $typeId);
        return $this->rapidBaseApi->fetchData($endpoint);
    }

    public function getAllVehicleEngineTypes(int $modelId, int $manufacturerId, int $langId, int $countryId, int $typeId)
    {
        $this->validateId($modelId, 'Model ID');
        $this->validateId($manufacturerId, 'Manufacturer ID');
        $this->validateId($typeId, 'Type ID');
        $this->validateId($langId, 'Language ID');
        $this->validateId($countryId, 'Country ID');

        $endpoint = sprintf('types/list-vehicles-types/%d/manufacturer-id/%d/lang-id/%d/country-filter-id/%d/type-id/%d',$modelId, $manufacturerId, $langId, $countryId, $typeId);
        return $this->rapidBaseApi->fetchData($endpoint);
    }

    public function getCategoryV1(int $vehicleId, int $manufacturerId, int $langId, int $countryId, int $typeId)
    {
        $this->validateId($vehicleId, 'Vehicle ID');
        $this->validateId($manufacturerId, 'Manufacturer ID');
        $this->validateId($typeId, 'Type ID');
        $this->validateId($langId, 'Language ID');
        $this->validateId($countryId, 'Country ID');


        $endpoint = sprintf('category/category-products-groups-variant-1/%d/manufacturer-id/%d/lang-id/%d/country-filter-id/%d/type-id/%d',$vehicleId, $manufacturerId, $langId, $countryId, $typeId);
        return $this->rapidBaseApi->fetchData($endpoint);
    }

    public function getCategoryV2(int $vehicleId, int $manufacturerId, int $langId, int $countryId, int $typeId)
    {
        $this->validateId($vehicleId, 'Vehicle ID');
        $this->validateId($manufacturerId, 'Manufacturer ID');
        $this->validateId($typeId, 'Type ID');
        $this->validateId($langId, 'Language ID');
        $this->validateId($countryId, 'Country ID');


        $endpoint = sprintf('category/category-products-groups-variant-2/%d/manufacturer-id/%d/lang-id/%d/country-filter-id/%d/type-id/%d',$vehicleId, $manufacturerId, $langId, $countryId, $typeId);
        return $this->rapidBaseApi->fetchData($endpoint);
    }

    public function getCategoryV3(int $vehicleId, int $manufacturerId, int $langId, int $countryId, int $typeId)
    {
        $this->validateId($vehicleId, 'Vehicle ID');
        $this->validateId($manufacturerId, 'Manufacturer ID');
        $this->validateId($typeId, 'Type ID');
        $this->validateId($langId, 'Language ID');
        $this->validateId($countryId, 'Country ID');


        $endpoint = sprintf('category/category-products-groups-variant-3/%d/manufacturer-id/%d/lang-id/%d/country-filter-id/%d/type-id/%d',$vehicleId, $manufacturerId, $langId, $countryId, $typeId);
        return $this->rapidBaseApi->fetchData($endpoint);
    }

    public function getArticlesList(int $vehicleId, int $productGroupId, int $manufacturerId, int $langId, int $countryId, int $typeId)
    {
        $this->validateId($vehicleId, 'Vehicle ID');
        $this->validateId($productGroupId, 'Product Group ID');
        $this->validateId($manufacturerId, 'Manufacturer ID');
        $this->validateId($typeId, 'Type ID');
        $this->validateId($langId, 'Language ID');
        $this->validateId($countryId, 'Country ID');

        $endpoint = sprintf('articles/list/vehicle-id/%d/product-group-id/%d/manufacturer-id/%d/lang-id/%d/country-filter-id/%d/type-id/%d',$vehicleId, $productGroupId, $manufacturerId, $langId, $countryId, $typeId);
        return $this->rapidBaseApi->fetchData($endpoint);
    }

    public function getArticleCompletDetailsByArticleId(int $articleId, int $langId, int $countryId)
    {
        $this->validateId($articleId, 'Article ID');
        $this->validateId($langId, 'Language ID');
        $this->validateId($countryId, 'Country ID');

        $endpoint = sprintf('articles/article-id-details/%d/lang-id/%d/country-filter-id/%d', $articleId, $langId, $countryId);
        return $this->rapidBaseApi->fetchData($endpoint);
    }

    public function getArticleSpecificationDetailsByArticleId(int $articleId, int $langId, int $countryId)
    {
        $this->validateId($articleId, 'Article ID');
        $this->validateId($langId, 'Language ID');
        $this->validateId($countryId, 'Country ID');


        $endpoint = sprintf('articles/details/%d/lang-id/%d/country-filter-id/%d', $articleId, $langId, $countryId);
        return $this->rapidBaseApi->fetchData($endpoint);
    }

    public function getCompletDetailsForArticleNo($articleNo, int $langId, int $countryId)
    {
        $this->validateId($langId, 'Language ID');
        $this->validateId($countryId, 'Country ID');

        $endpoint = sprintf('articles/article-number-details/lang-id/%d/country-filter-id/%d/article-no/%d', $langId, $countryId, $articleNo);
        return $this->rapidBaseApi->fetchData($endpoint);
    }

    public function searchArticlesByArticleNo(int $langId, $articleNo)
    {
        $this->validateId($langId, 'Language ID');


        $endpoint = sprintf('articles/search/lang-id/%d/article-search/%d', $langId, $articleNo);
        return $this->rapidBaseApi->fetchData($endpoint);
    }

    public function searchArticlesByArticleNoAndSupplierId(int $langId, int $supplierId, $articleNo)
    {
        $this->validateId($langId, 'Language ID');
        $this->validateId($supplierId, 'Supplier ID');

        $endpoint = sprintf('articles/search/lang-id/%d/supplier-id/%d/article-search/%d', $langId, $supplierId, $articleNo);
        return $this->rapidBaseApi->fetchData($endpoint);
    }

}