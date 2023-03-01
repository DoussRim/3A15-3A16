<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ClasseroomRepository;
use App\Entity\Classeroom;
use App\Form\ClassroomType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ClassroomController extends AbstractController
{
    #[Route('/classroom', name: 'app_classroom')]
    public function index(): Response
    {
        return $this->render('classroom/index.html.twig', [
            'controller_name' => 'ClassroomController',
        ]);
    }
    #[Route('/classroom/Affiche',name:'Aff')]
    function Affiche(ClasseroomRepository $repo){
        $classroom=$repo->findAll();
        return $this->render('classroom/Affiche.html.twig',
    ['cc'=>$classroom]);

    }
    // #[Route('/Detail/{i}',name:"DD")]
    // function Detail($i,ClasseroomRepository $repo){
    //     $classroom=$repo->find($i);
    //     return $this->render('classroom/Detail.html.twig',
    //     ['cc'=>$classroom]);
    // }
    #[Route('/Detail/{id}',name:"DD")]
    function Detail(Classeroom $classroom){
        return $this->render('classroom/Detail.html.twig',
        ['cc'=>$classroom]);
    }
    #[Route('/Delete/{id}',name:'Del')]
     function Delete(ClasseroomRepository $repo,Classeroom $classroom){
         $repo->remove($classroom,true);
         return $this->redirectToRoute('Aff');
        
     }
    // #[Route('/Delete/{id}',name:'Del')]
    // function Delete(ManagerRegistry $doctrine,Classeroom $classroom){
    //     $em=$doctrine->getManager();
    //     $em->remove($classroom);
    //     $em->flush();
    //     return $this->redirectToRoute('Aff');
        
    // }
    #[Route('/Ajout')]
    function Ajout(ClasseroomRepository $repo,Request $req){
        #form
        $classroom=new Classeroom();
        $form=$this->createForm(ClassroomType::class,$classroom)
        ->add('Ajout',SubmitType::class);
        $form->handleRequest($req);
        #isEmpty isValid isSubmitted
        if($form->isSubmitted() && $form->isValid()){
             #Insertion
            # 2 methodes:
                #Repo->save()
                $repo->save($classroom,true);
                #EM->persist() flush()*
                return $this->redirectToRoute('Aff');
        }
        return $this->render('classroom/Ajout.html.twig',
    ['form'=>$form->createView()]);
       
    }
    #[Route('/Update/{id}',name:"Update")]
    function Update(ManagerRegistry $doctrine,Request $req,Classeroom $classroom){
        
        $form=$this->createForm(ClassroomType::class,$classroom)
        ->add('Update',SubmitType::class);
        $form->handleRequest($req);
        #isEmpty isValid isSubmitted
        if($form->isSubmitted() && $form->isValid()){
             #Insertion
            # 2 methodes:
                #Repo->save()
                $em=$doctrine->getManager();
                $em->flush();
                #EM->persist() flush()*
                return $this->redirectToRoute('Aff');
        }
        return $this->render('classroom/Ajout.html.twig',
    ['form'=>$form->createView()]);
       
    }
}
