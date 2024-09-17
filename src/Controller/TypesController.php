<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TypesController extends AbstractController
{

    #[Route('/list-vehicles-types/{modelId}/manufacturer-id-{manufacturerId}/lang-id-{langId}/country-id-{countryId}/type-id-{typeId}',
        name: 'listVehicleTypes',
        requirements: ['manufacturerId' => '\d+', 'langId' => '\d+', 'countryFilterId' => '\d+', 'typeId' => '\d+']
    )]
    public function listVehicleModelTypes(int $modelId, int $manufacturerId, int $langId, int $countryId, int $typeId): Response
    {
        return $this->render('types/index.html.twig', [
            'controller_name' => 'TypesController',
        ]);
    }
}
