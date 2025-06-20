<?php

namespace App\Controller;

use App\Entity\Order;
use App\Form\OrderTypeForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class OrderController extends AbstractController
{
    #[Route('/order', name: 'order_create')]
    public function order(Request $request, EntityManagerInterface $em): Response
    {
        $order = new Order();
        $order->setCreatedAt(new \DateTimeImmutable());

        $form = $this->createForm(OrderTypeForm::class, $order);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($order);
            $em->flush();

            return $this->render('order/success.html.twig', [
                'order' => $order,
            ]);
        }

        return $this->render('order/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
