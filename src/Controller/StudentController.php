<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\StudentRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Form\StudentType;
use App\Entity\Student;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
#[Route('/student')]
class StudentController extends AbstractController
{
    #[Route('/stu', name: 'app_student')]
    public function index(): Response
    {
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
        ]);
    }
    #[Route('/Affiche',name:'AffS')]
    function Affiche(StudentRepository $repo){
        $student=$repo->findAll();
        return $this->render('student/Affiche.html.twig',
    ['ss'=>$student]);

    }
    #[Route('/Ajout')]
    function Ajout(Request $request, StudentRepository $repo){
        $student=new Student();
        $form=$this->createForm(StudentType::class,$student)
        ->add('Ajout',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
                $repo->save($student,true);
                return $this->redirectToRoute('AffS');
        }
        return $this->render('student/Ajout.html.twig',[
                    'form'=>$form->createView()
        ]);
    }
}
