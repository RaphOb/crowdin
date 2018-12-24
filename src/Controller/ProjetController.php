<?php

namespace App\Controller;

use App\Entity\Projet;
use App\Entity\Source;
use App\Controller;

use App\Repository\ProjetRepository;
use App\Repository\SourceRepository;
use App\Form\ProjetType;
use App\Form\SourceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;

class ProjetController extends AbstractController
{
    private $projet;
    private $entityManager;
    public function __construct(ObjectManager $entityManager, ProjetRepository $projet, SourceRepository $source)
    {
        $this->projet = $projet;
        $this->source = $source;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/projet", name="projet")
     */
    public function index(Request $request)
    {
        //$entityManager = $this->getDoctrine()->getManager();
        $projet = new Projet();
        $form_create = $this->createForm(ProjetType::class, $projet);
        $form_create->handleRequest($request);
        
        if($form_create->isSubmitted() && $form_create->isValid()) {
            $this->entityManager->persist($projet);
            $this->entityManager->flush();
            return $this->redirectToRoute('projet_all');
        }
        return $this->render('projet/create.html.twig',[
            'form_create'=> $form_create->createView()
        ]);
    }
    /**
     * @Route("/projetall", name="projet_all")
     */
    public function index1()
    {
        $projet = $this->getDoctrine()
            ->getRepository(Projet::class)
            ->findAll();
            return $this->render('/projet/index.html.twig',
            [ 'projets'=> $projet]
        );
    }

    /**
     * @route("/projet/{id}", name="project_view")
     */
    public function show($id)
    {
        $projet = $this->getDoctrine()
            ->getRepository(Projet::class)
            ->find($id);
        
        if (!$projet) {
            throw $this->createNoFoundException(
                'no product found for id'.$id
            );
        }
        return new Response('Check out this great project'.$projet->getName());
    }

    /**
     * @route("/projet/edit/{id}", name="projet_edit")
     * @param $projet
     */
    public function update( $id, Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $projet = $entityManager->getRepository(Projet::class)->find($id);
        $form_edit = $this->createForm(ProjetType::class, $projet);
        $form_edit->handleRequest($request);
        if(!$projet) {
            throw $this->createNotFoundException(
                'No project found for id'.$id
            );
        }
        if($form_edit->isSubmitted() && $form_edit->isValid()) {
        $entityManager->flush();
        return $this->redirectToRoute('projet_all');
        }
        
        return $this->render('projet/edit.html.twig', [
            'projets'=> $projet,
            'form_edit'=>$form_edit->createView()
            ]);
        }

     /**
     * @route("/projet/del/{id}", name="projet_del" )
     */
    public function remove($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $projet = $entityManager->getRepository(Projet::class)->find($id);
    
        if(!$projet) {
            throw $this->createNotFoundException(
            'No project found for id'.$id
        );
    }
    
        $entityManager->remove($projet);
        $entityManager->flush();
    
        return $this->redirectToRoute('projet_all');
        return new Response('Deleting ..'.$projet->getName());

    }

    /**
     * @route("/projet/projet/{id}/source", name="projet_source")
     * @param $projet
     */
    public function addSource($id, Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $projet = $entityManager->getRepository(Projet::class)->find($id);
        $source = new Source();
        $form_source_create = $this->createForm(SourceType::class, $source);
        $form_source_create->handleRequest($request);
        if($form_source_create->isSubmitted() && $form_source_create->isValid()) {
            $projet->setSource($source);
            $this->entityManager->persist($source);
            $this->entityManager->flush();
            return $this->redirectToRoute('home');
        }
        return $this->render('source/createS.html.twig', [
            'form_source_create'=> $form_source_create->createView()
        ]);
    }
}
