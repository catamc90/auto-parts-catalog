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


//        $vehicleTypes = $this->catalogApi->getAllVehicleTypes();
        if (ApplicationConstants::TYPE_AUTOMOBILE == $typeId) {
            $typeTemplate = 'listPassengerCarsModelTypes';
            $selectedVehicleTypes = 'Automobile';
        } elseif (ApplicationConstants::TYPE_COMMERCIALVEHICLES == $typeId) {
            $typeTemplate = 'listCommercialVehiclesModelTypes';
            $selectedVehicleTypes = 'Commercial-Vehicles';
        } elseif (ApplicationConstants::TYPE_MOTO == $typeId) {
            $typeTemplate = 'listMotorCyclesModelTypes';
            $selectedVehicleTypes = 'Moto';
        }

        $vehicleEngineModelTypes = $this->catalogApi->getAllVehicleEngineTypes($modelId, $manufacturerId, $langId, $countryId, $typeId);
        dump($vehicleEngineModelTypes);


        return $this->render('types/list.html.twig', [
            'langId' => $langId,
            'typeId' => $typeId,
            'countryId' => $countryId,
            'modelId' => $modelId,
            'manufacturerId' => $manufacturerId,
            'manufacturer' => $manufacturer,
            'model' => $model,
            'vehicleEngineModelTypes' => $vehicleEngineModelTypes,
            'selectedVehicleTypes' => $selectedVehicleTypes,
            'typeTemplate' => $typeTemplate
        ]);
    }

    #[Route('/vehicle-type-details/{vehicleId}/manufacturer-id-{manufacturerId}/lang-id-{langId}/country-id-{countryId}/type-id-{typeId}',
        name: 'vehicleTypeDetails'
    )]
    public function vehicleTypeDetails(int $vehicleId, int $manufacturerId, int $langId, int $countryId, int $typeId)
    {

    }
}
