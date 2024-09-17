<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PassengerCarsController extends AbstractController
{
    #[Route(
        '/passenger-car-types/{modelId}/manufacturer-id-{manufacturerId}/lang-id-{langId}/country-id-{countryId}/type-id-{typeId}',
        name: 'listPassengerCarsModelTypes',
        requirements: ['manufacturerId' => '\d+', 'langId' => '\d+', 'countryFilterId' => '\d+', 'typeId' => '\d+']
    )]
    public function listPassengerCarModelTypes(int $modelId, int $manufacturerId, int $langId, int $countryId, int $typeId): Response
    {



        return $this->render('passenger_cars/list.html.twig', [
            'controller_name' => 'PassengerCarsController',
        ]);
    }
}
