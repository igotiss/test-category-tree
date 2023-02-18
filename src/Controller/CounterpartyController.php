<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Counterparty;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class CounterpartyController extends AbstractController
{
    private $category;
    public function __construct(ManagerRegistry $doctrine)
    {
        $this->category = $doctrine->getManager()->getRepository(Category::class);
    }

    /**
     * @Route("/categories", name="app_categories", methods={"GET"})
     */
    public function getCategories(ManagerRegistry $doctrine): JsonResponse
    {
        return new JsonResponse([
            'categories' => $this->category
                ->findMainTrueCategories()
        ], Response::HTTP_OK);
    }

    /**
     * @Route("/categories/{id}", name="app_counterparty", methods={"GET"})
     */
    public function showCategories(int $id, ManagerRegistry $doctrine): JsonResponse
    {
        $category = $this->category->find($id);
        $RootCat = $category->getParentId() === 0;
        $childCat = $this->category->findAllChildCategory($id);
        $counterparties = $doctrine->getManager()->getRepository(Counterparty::class)->findByCategory($id);

        return new JsonResponse([
            'name' => $category->getName(),
            'is root category' => $RootCat,
            'count of child category' => count($childCat),
            'childs categories' => $childCat,
            'counterparties count' => count($counterparties),
            'counterparties' => ($counterparties),
        ], Response::HTTP_OK);
    }

}
