<?php

// src/Controller/CategoryController.php
namespace App\Controller;

use App\Entity\Program;
use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/categories", name="category_")
 */

class CategoryController  extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @return Response
     */
    public function index(): Response
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        return $this->render(
            'category/index.html.twig',
            ['categories' => $categories]
        );
    }

    /**
     * @param string $categoryName
     * @Route("/{categoryName}", name="show")
     * @return Response
     */
    public function show(string $categoryName): Response
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findOneBy(['name' => $categoryName]);

            if (!$categories) {
            throw $this->createNotFoundException(' Cette catégorie n\'éxiste pas');
        }
            $programs = $this->getDoctrine()
                ->getRepository(Program::class)
                ->findBy(['category' => $categories->getId() ], ['id' => 'DESC'], 3);
            if (!$programs){
                throw $this->createNotFoundException('Pas de séries dans cette catégorie');
            }
        return $this->render(
            'category/show.html.twig',['categories' => $categories,'programs' => $programs]
        );
    }
}