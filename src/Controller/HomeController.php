<?php

namespace App\Controller;

use App\Api\CatalogApi;
use App\Form\Type\LanguageType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
            return $this->redirectToRoute('listManufacturers', [
                'langId' => $languagesForm->get('lngDescription')->getData(),
                'countryId' => $languagesForm->get('countryFilter')->getData(),
                'typeId' => $languagesForm->get('type')->getData(),
            ]);
        }

        return $this->render('home/index.html.twig', [
            'languagesForm' => $languagesForm->createView(),
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
