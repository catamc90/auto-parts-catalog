<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ModelsController extends AbstractController
{


    #[Route(
        '/models/manufacturer-id-{manufacturerId}/lang-id-{langId}/country-id-{countryId}/type-id-{typeId}',
        name: 'listModels',
        requirements: ['manufacturerId' => '\d+', 'langId' => '\d+', 'countryFilterId' => '\d+', 'typeId' => '\d+']
    )]
    public function listModelsByManufacturer(int $manufacturerId, int $langId, int $countryId, int $typeId): Response
    {

    }
}
