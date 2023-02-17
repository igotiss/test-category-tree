<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CounterpartyController extends AbstractController
{
    /**
     * @Route("/counterparty", name="app_counterparty", methods={"GET"})
     */
    public function index(): Response
    {
        return new JsonResponse([
            'test' => 'test'

        ], Response::HTTP_OK);
    }
}
