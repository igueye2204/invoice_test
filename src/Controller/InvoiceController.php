<?php

namespace App\Controller;

use App\Entity\Invoice;
use App\Entity\InvoiceLines;
use App\Form\InvoiceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InvoiceController extends AbstractController
{
    #[Route('/invoice', name: 'new_invoice')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $invoice = new Invoice();
        $invoiceLines = new InvoiceLines();

        $invoice->getInvoiceLines()->add($invoiceLines);
        $form = $this->createForm(InvoiceType::class, $invoice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            foreach ($invoice->getInvoiceLines() as $line) {

                $totalAmount = $line->getAmount()*$line->getQuantity();
                $line->setVatAmount($totalAmount*(0.18));
                $line->setTotal($totalAmount*(1.18));
                $line->setInvoice($invoice);
              
                $entityManager->persist($line);
            }
            
            $entityManager->persist($invoice);
            $entityManager->flush();

        }

        return $this->render('invoice/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
