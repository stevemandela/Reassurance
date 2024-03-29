<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PropertyRepository;
//use Twig\Environment;


class HomeController extends AbstractController
{

    
    /**
	 * @Route("/", name="home")
	 * @return Response
	 */

	public function index(PropertyRepository $repository): Response
	{
		$properties = $repository->findLatest();
        return $this->render('pages/home.html.twig', [
               'properties' => $properties
		]);
	}
}