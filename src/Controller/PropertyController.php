<?php

namespace App\Controller;


use App\Entity\Property;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PropertyRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;


class PropertyController extends AbstractController
{
	/**
     * @var PropertyRepository
     */
    private $repository;

    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(PropertyRepository $repository, ObjectManager $em) {
        $this->repository = $repository;
        $this->em = $em;
    }

   /**
    * @Route("/reassurance", name="property.index")
    * @return Response
    */

    public function index(paginatorInterface $paginator, Request $request): Response
    {
    	$properties = $paginator->paginate(
            $this->repository->findAllVisible(),
            $request->query->getInt('page', 1), 6
        );

        //$properties = $this->repository->findAllVisible();
        return $this->render('property/index.html.twig', [
         	'menu_courant' => 'properties',
         	'properties' => $properties
        ]);
    }
}