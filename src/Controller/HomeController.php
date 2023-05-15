<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\QuantityRepository;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="app_home")
     */
    public function index(ProductRepository $productRepository,QuantityRepository $quantityRepository): Response
    {
        $em = $this->getDoctrine()->getManager();
        $queryResult = $em->createQueryBuilder('')
        ->select('p.id as price_id,p.price as price,pt.productImage as productImage,pt.productName,q.quantity ')
        ->from('App:Price', 'p')
        ->innerJoin('App:Product', 'pt', 'with', 'p.product = pt.id')
        ->innerJoin('App:Quantity', 'q', 'with', 'p.Quantity = q.id')
        ->innerJoin('App:Category', 'c', 'with', 'p.category = c.id')
        ->where('p.status = true')
        ->andWhere('pt.status = true')
        ->andWhere('c.status = true')
        ->getQuery()
        ->getArrayResult();

        return $this->render('home/index.html.twig', [
            'product_by_price' => $queryResult,
            // 'products' => $productRepository->findAll(),
            // 'quantities' => $quantityRepository->findAll(),
        ]);
    }
    /**
     * @Route("calculate/{categoryId}/{productId}/price", name="home_calculate_price_by_quantity")
     */
    public function getPriceByQuantity(QuantityRepository $quantityRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'quantities' => $quantityRepository->findAll(),
        ]);
    }
    
}
