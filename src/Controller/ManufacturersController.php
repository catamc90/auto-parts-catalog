<?php

namespace App\Controller;

use App\Api\CatalogApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ManufacturersController extends AbstractController
{
    private CatalogApi $catalogApi;

    public function __construct(CatalogApi $catalogApi)
    {
        $this->catalogApi = $catalogApi;
    }

    #[Route('/manufacturers/lang-id/{langId}/country-id/{countryId}/type-id/{typeId}', name: 'listManufacturers')]
    public function list(int $langId, int $countryId, int $typeId): Response
    {
        $language = $this->catalogApi->getLanguageDetailsById($langId);
        $country = $this->catalogApi->getCountryDetailsById($langId, $countryId);
        $manufacturers = $this->catalogApi->getManufacturers($typeId, $langId, $countryId);

        return $this->render('manufacturers/list.html.twig', [
            'language' => $language,
            'country' => $country,
            'manufacturers' => $manufacturers,
            'langId' => $langId,
            'typeId' => $typeId,
            'countryId' => $countryId,
        ]);
    }
}
