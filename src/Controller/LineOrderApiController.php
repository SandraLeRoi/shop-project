<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LineOrderApiController extends AbstractController
{
    /**
     * @Route("/line/order/api", name="line_order_api")
     */
    public function index(): Response
    {
        return $this->render('line_order_api/index.html.twig', [
            'controller_name' => 'LineOrderApiController',
        ]);
    }
}
