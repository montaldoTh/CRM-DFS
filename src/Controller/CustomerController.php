<?php

namespace App\Controller;

use App\Repository\CustomerRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CustomerController extends AbstractController
{
    #[Route('/customers', name: 'app_customers')]
    public function index(CustomerRepository $customerRepository): Response
    {
        $customers = $customerRepository->findAll();
        
        return $this->render('customer/index.html.twig', [
            'customers' => $customers,
        ]);
    }
}
