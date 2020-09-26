<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Order;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    private $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * @Route("/")
     */
    public function actionIndex() {
        $books = $this->bookRepository->getBooks();
/*
        echo '<pre>';
        print_r($books);
        echo '</pre>';
*/
        return $this->render('main/index.html.twig',
                             [
                                 'books' => $books
                             ]);
    }

    /**
     * @Route("/order")
     */
    public function actionOrder() {
        /*$order = new Order();
        $order->set*/

        return $this->render('main/order.html.twig',
                             [
                                 'form' => $form->createView(),
                             ]);
    }
}
