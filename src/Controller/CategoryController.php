<?php

namespace App\Controller;

use App\Api\CatalogApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CategoryController extends AbstractController
{
    private CatalogApi $catalogApi;

    public function __construct(CatalogApi $catalogApi)
    {
        $this->catalogApi = $catalogApi;
    }


    #[Route('/list-category-products-groups/vehicle-id/{vehicleId}/manufacturer-id/{manufacturerId}/lang-id/{langId}/country-id/{countryId}/type-id{typeId}',
        name: 'categoryProductsGroups'
    )]
    public function list(int $vehicleId, int $manufacturerId, int $langId, int $countryId, int $typeId): Response
    {
        $manufacturer = $this->catalogApi->getManufacturerDetailsById($manufacturerId);
        $model = $this->catalogApi->getModelDetailsByVehicleId($vehicleId, $langId, $countryId, $typeId);

        $categories3 = $this->catalogApi->getCategoryV3($vehicleId, $manufacturerId, $langId, $countryId, $typeId);

        return $this->render('category/list.html.twig', [
            'manufacturer' => $manufacturer,
            'model' => $model,
            'manufacturerId' => $manufacturerId,
            'langId' => $langId,
            'countryId' => $countryId,
            'typeId' => $typeId,
            'vehicleId' => $vehicleId,
            'categories3' => $categories3['categories'],

        ]);
    }
}
