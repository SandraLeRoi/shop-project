<?php

namespace App\Controller;

use App\Entity\LineOrder;
use App\Form\LineOrderType;
use App\Repository\LineOrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/line/order")
 */
class LineOrderController extends AbstractController
{
    /**
     * @Route("/", name="line_order_index", methods={"GET"})
     */
    public function index(LineOrderRepository $lineOrderRepository): Response
    {
        return $this->render('line_order/index.html.twig', [
            'line_orders' => $lineOrderRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="line_order_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $lineOrder = new LineOrder();
        $form = $this->createForm(LineOrderType::class, $lineOrder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($lineOrder);
            $entityManager->flush();

            return $this->redirectToRoute('line_order_index');
        }

        return $this->render('line_order/new.html.twig', [
            'line_order' => $lineOrder,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="line_order_show", methods={"GET"})
     */
    public function show(LineOrder $lineOrder): Response
    {
        return $this->render('line_order/show.html.twig', [
            'line_order' => $lineOrder,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="line_order_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, LineOrder $lineOrder): Response
    {
        $form = $this->createForm(LineOrderType::class, $lineOrder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('line_order_index');
        }

        return $this->render('line_order/edit.html.twig', [
            'line_order' => $lineOrder,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="line_order_delete", methods={"DELETE"})
     */
    public function delete(Request $request, LineOrder $lineOrder): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lineOrder->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($lineOrder);
            $entityManager->flush();
        }

        return $this->redirectToRoute('line_order_index');
    }
}
