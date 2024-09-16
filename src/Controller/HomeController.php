<?php

namespace App\Controller;

use App\Api\CatalogApi;
use App\Form\Type\LanguageType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{

    private CatalogApi $catalogApi;

    public function __construct(CatalogApi $catalogApi)
    {
        $this->catalogApi = $catalogApi;
    }

    #[Route('/', name: 'home')]
    public function home(Request $request)
    {
        $languagesForm = $this->createForm(LanguageType::class);
        $languagesForm->handleRequest($request);

        if ($languagesForm->isSubmitted() && $languagesForm->isValid()) {
            return $this->redirectToRoute('list_manufacturers', [
                'langId' => $languagesForm->get('lngDescription')->getData(),
                'countryFilterId' => $languagesForm->get('countryFilter')->getData(),
                'typeId' => $languagesForm->get('type')->getData(),
            ]);
        }

        return $this->render('home/index.html.twig', [
            'languagesForm' => $languagesForm->createView(),
        ]);
    }

    #[Route('/home', name: 'app_index_home')]
    public function index(): Response
    {
        $getLangs = $this->catalogApi->getAllLanguages();

//        dump($getLangs);

//        $getCountries= $this->catalogApi->getAllCountriesByLanguageId(42);
//        dump($getCountries);

//        $getManufacturer = $this->catalogApi->getManufacturers(1, 4, 62);
//        dump($getManufacturer);

//        $vehicleTypes = $this->catalogApi->getAllVehicleTypes();
//        dump($vehicleTypes);


//        $getModels = $this->catalogApi->getModels(184, 4, 62, 1);
//        dump($getModels);

        $getVehicleTypeDetailedInfo = $this->catalogApi->getVehicleTypeDetailedInformation(19942, 184, 4, 62, 1);
        dump($getVehicleTypeDetailedInfo);

        $getAllVehicleEngineTypes = $this->catalogApi->getAllVehicleEngineTypes(5626, 184, 4, 62, 1);
        dump($getAllVehicleEngineTypes);

//        $getCategoryV1 = $this->catalogApi->getCategoryV1(19942, 184, 4, 62, 1);
//        dump($getCategoryV1);

//        $getCategoryV3 = $this->catalogApi->getCategoryV3(19942, 184, 4, 62, 1);
//        dump($getCategoryV3);

        $getArticlesList = $this->catalogApi->getArticlesList(19942, 100260,184, 4, 62, 1);
        dump($getArticlesList);

        $articleCompletDetails = $this->catalogApi->getArticleCompletDetailsByArticleId(131540, 4, 62);
        dump($articleCompletDetails);

        $articleSpecification = $this->catalogApi->getArticleSpecificationDetailsByArticleId(131540, 4, 62);
        dump($articleSpecification);

        $articleNoDetails = $this->catalogApi->getCompletDetailsForArticleNo('002-001-000001R', 4, 62);
        dump($articleNoDetails);

        $searchArticle = $this->catalogApi->searchArticlesByArticleNo(4, 'C 2029');
        dump($searchArticle);

        $searchArticleBySupplier = $this->catalogApi->searchArticlesByArticleNoAndSupplierId(4, 4,'C 2029');
        dump($searchArticleBySupplier);

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'langs' => $getLangs
        ]);
    }


    #[Route('/list-countries-by-lang-id/{langId}', name: 'app_home_getallcountriesbylangid')]
    public function getAllCountriesByLangId($langId)
    {
        try {
            $countries = $this->catalogApi->getAllCountriesByLanguageId($langId);
            return $this->json($countries);
        } catch (\Exception $e) {
            return $this->json([
                'error' => 'An error occurred while fetching manufacturers. Please try again later.',
            ]);
        }
    }
}
