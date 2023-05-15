<?php

namespace App\Controller;

use App\Entity\Quantity;
use App\Form\QuantityType;
use App\Repository\QuantityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/quantity")
 */
class QuantityController extends AbstractController
{
    /**
     * @Route("/", name="app_quantity_index", methods={"GET"})
     */
    public function index(QuantityRepository $quantityRepository): Response
    {
        return $this->render('quantity/index.html.twig', [
            'quantities' => $quantityRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_quantity_new", methods={"GET", "POST"})
     */
    public function new(Request $request, QuantityRepository $quantityRepository): Response
    {
        $quantity = new Quantity();
        $form = $this->createForm(QuantityType::class, $quantity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $quantity->setInsertTime(new \DateTime());
            $quantityRepository->add($quantity, true);

            return $this->redirectToRoute('app_quantity_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('quantity/new.html.twig', [
            'quantity' => $quantity,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_quantity_show", methods={"GET"})
     */
    public function show(Quantity $quantity): Response
    {
        return $this->render('quantity/show.html.twig', [
            'quantity' => $quantity,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_quantity_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Quantity $quantity, QuantityRepository $quantityRepository): Response
    {
        $form = $this->createForm(QuantityType::class, $quantity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $quantity->setUpdateTime(new \DateTime());
            $quantityRepository->add($quantity, true);

            return $this->redirectToRoute('app_quantity_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('quantity/edit.html.twig', [
            'quantity' => $quantity,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_quantity_delete", methods={"POST"})
     */
    public function delete(Request $request, Quantity $quantity, QuantityRepository $quantityRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$quantity->getId(), $request->request->get('_token'))) {
            $quantityRepository->remove($quantity, true);
        }

        return $this->redirectToRoute('app_quantity_index', [], Response::HTTP_SEE_OTHER);
    }
}
