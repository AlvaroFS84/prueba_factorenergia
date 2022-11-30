<?php

namespace App\Controller;

use App\Service\CurlService;
use App\Service\Interfaces\GetDataInterface;
use App\Service\Interfaces\UrlInterface;
use App\Service\Interfaces\ValidationInterface;
use App\Service\ParamsValidatorService;
use App\Service\UrlContructorService;
use BadRequestException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/api")
*/
class ApiController extends AbstractController
{
    private ParamsValidatorService $paramsValidatorService;
    private UrlContructorService $urlConstrutorService;
    private CurlService $curlService;

    public function __construct(ValidationInterface $paramsValidatorService, UrlInterface $urlConstrutorService, GetDataInterface $curlService)
    {
        $this->paramsValidatorService = $paramsValidatorService;    
        $this->urlConstrutorService = $urlConstrutorService;
        $this->curlService = $curlService;
    }
     /**
     * @Route("/get/stackoverfow/data", name="get_stackoverflow_data")
     */
    public function number(Request $request): JsonResponse
    {
        //comprobar si llega el parametro tagged
        try{
            $this->paramsValidatorService->validate($request);
        }catch(BadRequestException $ex){
            return new JsonResponse([
                'error_message' => $ex->getMessage()
            ]);
        }
        //obtener la url de la peticion
        $url = $this->urlConstrutorService->getUrl($request);
        $result = $this->curlService->getData($url);

        return new JsonResponse($result, 200,[], true);
    }
}