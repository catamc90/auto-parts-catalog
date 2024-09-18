<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CategoryController extends AbstractController
{
    #[Route('/list-category-products-groups/vehicle-id/{vehicleId}/manufacturer-id/{manufacturerId}/lang-id/{langId}/country-id/{countryId}/type-id{typeId}',
        name: 'categoryProductsGroups'
    )]
    public function index(): Response
    {
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }
}
