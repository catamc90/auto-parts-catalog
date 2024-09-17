<?php

namespace App\Controller;

use App\Api\CatalogApi;
use App\Constants\ApplicationConstants;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TypesController extends AbstractController
{
    private CatalogApi $catalogApi;

    public function __construct(CatalogApi $catalogApi)
    {
        $this->catalogApi = $catalogApi;
    }

    #[Route('/list-vehicles-types/{modelId}/manufacturer-id-{manufacturerId}/lang-id-{langId}/country-id-{countryId}/type-id-{typeId}',
        name: 'listVehicleTypes',
        requirements: ['manufacturerId' => '\d+', 'langId' => '\d+', 'countryFilterId' => '\d+', 'typeId' => '\d+']
    )]
    public function listVehicleModelTypes(int $modelId, int $manufacturerId, int $langId, int $countryId, int $typeId): Response
    {
        $manufacturer = $this->catalogApi->getManufacturerDetailsById($manufacturerId);
        $model = $this->catalogApi->getModelDetailsById($modelId, $langId, $countryId, $typeId);

        if (ApplicationConstants::TYPE_AUTOMOBILE == $typeId) {
            $vehicleRoutes = 'listPassengerCarsModelTypes';

        } elseif (ApplicationConstants::TYPE_COMMERCIALVEHICLES == $typeId) {
            $vehicleRoutes = 'listCommercialVehiclesModelTypes';

        } elseif (ApplicationConstants::TYPE_MOTO == $typeId) {
            $vehicleRoutes = 'listMotorCyclesModelTypes';

        }

        $vehicleTypes = $this->catalogApi->getAllVehicleEngineTypes($modelId, $manufacturerId, $langId, $countryId, $typeId);



        return $this->render('types/index.html.twig', [
            'controller_name' => 'TypesController',
        ]);
    }
}
