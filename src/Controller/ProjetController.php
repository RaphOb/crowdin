<?php

namespace App\Controller;

use App\Entity\Projet;
use App\Entity\Source;
use App\Entity\Langues;
use App\Controller;
use App\Entity\Traduct;

use App\Repository\ProjetRepository;
use App\Repository\SourceRepository;
use App\Form\ProjetType;
use App\Form\SourceType;
use App\Form\TraductType;
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
            $user = $this->getUser();
           
            $projet->setUser($user);
            $projet->setUsername($user->getUsername());
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
        $user = $this->getUser();
        $id = $user->getId();
        $repo = $this->getDoctrine()->getRepository(Projet::class);
        $projets = $repo->findByUser($id);
     
        //$repo_langues = $this->getDoctrine()->getRepository(Langues::class);
        //$project_langues = $repo->findByLangue(getLangueProjet());

       // $projet = $user->getProjet();
       // $projet->findByUser
        /*$projet = $this->getDoctrine()
            ->getRepository(Projet::class)
            ->findAll();*/
            //->findOneBy(array(
             //   'user'=> $id,
            //));
            
            return $this->render('/projet/index.html.twig',
            [ 'projets'=> $projets]
            //['langues' => $project_langues]
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
        $source = new Source();
        //$projet = new Projet();
        $projet = $entityManager->getRepository(Projet::class)->find($id);
        $form_source_create = $this->createForm(SourceType::class, $source);
        $form_source_create->handleRequest($request);
        
        if($form_source_create->isSubmitted() && $form_source_create->isValid()) {
            $projet->addSource($source);
            $this->entityManager->persist($source);
            $this->entityManager->persist($projet);
            $this->entityManager->flush();
            return $this->redirectToRoute('source_all', array('id'=>$projet->getId()));
        }
        return $this->render('source/createS.html.twig', [
            'form_source_create'=> $form_source_create->createView(),
            'sources'=>$source,
            
        ]);
    }

    /**
     * @Route("/source/{id}/sourcetall/", name="source_all")
     *@param $projet
     */ 
    public function viewsource($id)
    {

        $projet = $this->getDoctrine()
        ->getRepository(Projet::class)
        ->find($id);

        $source=$projet->getSource();
      

        return $this->render('/source/sources.html.twig',
        [ 'projets'=> $projet]
    );
    }

    /**
     * @route("/source/{id}/{sId}/sourcedel/", name="source_del")
     * @param $projet
     * @param $source
     */
    public function delSource($id, $sId)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $projet = $this->getDoctrine()
        ->getRepository(Projet::class)
        ->find($id);

        $source = $this->getDoctrine()
        ->getRepository(Source::class)
        ->find($sId);

        
        if (!$source) {
            throw $this->createNotFoundException('source not found');
        }
        $projet->removeSource($source);
        $this->entityManager->flush();
        return $this->redirectToRoute('source_all', array('id'=>$projet->getId()));
    }

    /**
     * @route("/source/{id}/traduct", name="source_traduct")
     * @param $source
     */
    public function addTraduct($id, Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $traduct = new Traduct();
        $source = $entityManager->getRepository(Source::class)->find($id);
        $traduct_form = $this->createForm(TraductType::class, $traduct);
        $traduct_form->handleRequest($request);
        
        if($traduct_form->isSubmitted() && $traduct_form->isValid()) {
            $source->addTraduct($traduct);
            $this->entityManager->persist($traduct);
            $this->entityManager->persist($source);
            $this->entityManager->flush();
            return $this->redirectToRoute('source_all', array('id'=>$source->getId()));
        }
        return $this->render('traduct/createT.html.twig', [
            'traduct_form'=> $traduct_form->createView(),
            'traducts'=>$traduct,
            
        ]);
    }

}
