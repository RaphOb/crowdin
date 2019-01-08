<?php

namespace App\Controller;
use App\Form\FileUploadType;
use App\Entity\FileUpload;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class FileUploadController extends AbstractController
{
    /**
     * @Route("/file/upload", name="file_upload")
     */
    public function index(Request $request, 
    ObjectManager $manager, AuthenticationUtils $authenticationUtils)
    {
        $upload = new FileUpload();
        $form = $this->createForm(FileUploadType::class, $upload);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //$file = $upload->getFile($form->getName());
            //$file_name = md5(uniqid()).'.'.$file->guessExtension();
            //$upload->setFile($file_name);
            //$file_name = $file->getClientOriginalName();
            /*$upload->setFile($file_name);
            $lastUsername = $this->getUser();
            $upload->setUserRequester($lastUsername);*/
            $manager->persist($upload);
            $manager->flush();
            return $this->redirectToRoute('source_all');
        }
        return $this->render('file_upload/index.html.twig', [
            'form'=> $form->createView(),
            
        ]);
    }
}