<?php

namespace App\Controller;

use App\Api\CatalogApi;
use App\Constants\ApplicationConstants;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ModelsController extends AbstractController
{
    private CatalogApi $catalogApi;

    public function __construct(CatalogApi $catalogApi)
    {
        $this->catalogApi = $catalogApi;
    }

    #[Route(
        '/models/manufacturer-id-{manufacturerId}/lang-id-{langId}/country-id-{countryId}/type-id-{typeId}',
        name: 'listModels',
        requirements: ['manufacturerId' => '\d+', 'langId' => '\d+', 'countryFilterId' => '\d+', 'typeId' => '\d+']
    )]
    public function listModelsByManufacturer(int $manufacturerId, int $langId, int $countryId, int $typeId): Response
    {
        $language = $this->catalogApi->getLanguageDetailsById($langId);
        $country = $this->catalogApi->getCountryDetailsById($langId, $countryId);
        $manufacturer = $this->catalogApi->getManufacturerDetailsById($manufacturerId);
        $models = $this->catalogApi->getModels($manufacturerId, $langId, $countryId, $typeId);


        if (ApplicationConstants::TYPE_AUTOMOBILE == $typeId) {
            $vehicleRoutes = 'listPassengerCarsModelTypes';
        } elseif (ApplicationConstants::TYPE_COMMERCIALVEHICLES == $typeId) {
            $vehicleRoutes = 'listCommercialVehiclesModelTypes';
        } elseif (ApplicationConstants::TYPE_MOTO == $typeId) {
            $vehicleRoutes = 'listMotorCyclesModelTypes';
        }


        return $this->render('models/list.html.twig', [
            'language' => $language,
            'country' => $country,
            'models' => $models,
            'langId' => $langId,
            'typeId' => $typeId,
            'countryId' => $countryId,
            'manufacturerId' => $manufacturerId,
            'manufacturer' => $manufacturer,
            'vehicleRoutes' => $vehicleRoutes,
        ]);
    }
}
