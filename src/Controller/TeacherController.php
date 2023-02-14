<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TeacherController extends AbstractController
{
    #[Route('/teacher', name: 'app_teacher')]
    public function index(): Response
    {
        return $this->render('teacher/index.html.twig', [
            'controller_name' => 'TeacherController',
        ]);
    }
    #[Route('/tt')]
    function test(){
        return new Response("Bonjour les <i>3A15-3A16</i>");
    }
    #[Route('/show/{classe}')]
    function showTeacher($classe){
        return $this->render('teacher/show.html.twig',
        ["c"=>$classe]);
    }
    #[Route('/liste')]
    function liste(){
        $formations = array(
            array('ref' => 'form147', 'Titre' => 'Formation Symfony 4','Description'=>'formation pratique',
                'date_debut'=>'12/06/2020', 'date_fin'=>'19/06/2020', 'nb_participants'=>0) ,
            array('ref'=>'form177','Titre'=>'Formation SOA' ,
                'Description'=>'formation theorique','date_debut'=>'03/12/2020','date_fin'=>'10/12/2020',
                'nb_participants'=>0),
            array('ref'=>'form178','Titre'=>'Formation Angular' ,
                'Description'=>'formation theorique','date_debut'=>'10/06/2020','date_fin'=>'14/06/2020',
                'nb_participants'=>12));
        return $this->render('liste.html.twig',
        ['formation'=>$formations]);
    }
    #[Route('/detail/{titre}',name:'D')]
    function Detail($titre){
        return $this->render('detail.html.twig',
    ['t'=>$titre]);

    }
}
