<?php

namespace App\Controller;

use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class ApiOrderControllerPhpController extends AbstractController
{
    #[Route('/api/orders', name: 'api_orders', methods: ['GET'])]

    public function getOrders(EntityManagerInterface $em): JsonResponse
    {
        $orders = $em->getRepository(Order::class)->findAll();

        $data = [];

        foreach ($orders as $order) {
            $data[] = [
                'clientName' => $order->getClientName(),
                'email' => $order->getEmail(),
                'size' => $order->getSize(),
                'ingredients' => $order->getIngredients(),
                'comment' => $order->getComment(),
                'createdAt' => $order->getCreatedAt()->format('Y-m-d H:i:s', 'Europe/Sofia'),
            ];
        }
    return $this->json($data);
    }
}
