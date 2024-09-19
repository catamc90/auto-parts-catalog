<?php

namespace App\Controller;

use App\Api\CatalogApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ArticlesController extends AbstractController
{
    private CatalogApi $catalogApi;

    public function __construct(CatalogApi $catalogApi)
    {
        $this->catalogApi = $catalogApi;
    }

    #[Route('/list-articles/vehicle-id/{vehicleId}/product-group-id/{productGroupId}/manufacturer-id/{manufacturerId}/lang-id/{langId}/country-id/{countryId}/type-id/{typeId}', name: 'listArticlesByCarAndProductGroup')]
    public function list(
        int $vehicleId,
        int $productGroupId,
        int $manufacturerId,
        int $langId,
        int $countryId,
        int $typeId): Response
    {
        $manufacturer = $this->catalogApi->getManufacturerDetailsById($manufacturerId);
        $model = $this->catalogApi->getModelDetailsByVehicleId($vehicleId, $langId, $countryId, $typeId);

        $getArticles = $this->catalogApi->getArticlesList($vehicleId, $productGroupId, $manufacturerId, $langId, $countryId, $typeId);

        return $this->render('articles/list.html.twig', [
            'oem' => null,
            'manufacturer' => $manufacturer,
            'model' => $model,
            'modelId' => $model['MS_ID'],
            'langId' => $langId,
            'countryId' => $countryId,
            'typeId' => $typeId,
            'manufacturerId' => $manufacturerId,
            'getArticles' => $getArticles,
        ]);
    }

    #[Route('/article-details/article-id/{articleId}/model-id/{modelId}/manufacturer-id/{manufacturerId}/lang-id/{langId}/country-id/{countryId}/type-id/{typeId}', name: 'articleDetails')]
    public function articleDetails(
        int $articleId,
        int $modelId,
        int $manufacturerId,
        int $langId,
        int $countryId,
        int $typeId,
    ) {
        $manufacturer = $this->catalogApi->getManufacturerDetailsById($manufacturerId);
        $model = $this->catalogApi->getModelDetailsById($modelId, $langId, $countryId, $typeId);

        $articleSpecification = $this->catalogApi->getArticleSpecificationDetailsByArticleId($articleId, $langId, $countryId);
        $articleDetails = $this->catalogApi->getArticleCompletDetailsByArticleId($articleId, $langId, $countryId);
        $articleMedia = $this->catalogApi->getArticleAllMedia($articleId, $langId);

        return $this->render('articles/article-details.html.twig', [
            'manufacturer' => $manufacturer,
            'model' => $model,
            'articleID' => $articleId,
            'articleSpecification' => $articleSpecification,
            'articleDetails' => $articleDetails['article'],
            'articleMedia' => $articleMedia,
        ]);
    }
}
