<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function actionIndex() {
        //return $this->render('main/index.html');

        $time = time();
        echo '<pre>';
        print_r($time . '<br>');
        print_r(password_hash(230398, PASSWORD_ARGON2I));
        //print_r(date("H:i:s", $time));
        echo '</pre>';
    }
}
