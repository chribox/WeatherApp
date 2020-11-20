<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class PagesController extends AbstractController
{
    /**
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('pages/welcome.html.twig');
    }

}