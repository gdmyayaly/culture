<?php

namespace App\Controller;

use App\Entity\Allsession;
use App\Entity\Evalluation;
use App\Entity\User;
use App\Repository\AllsessionRepository;
use App\Repository\EvalluationRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
     * @Route("/admin", name="admin")
     */
class AdminController extends AbstractController
{

    /**
     * @Route("/infos")
     */
    public function infos(SerializerInterface $serializer){
        $user= $this->getUser();
        $data = $serializer->serialize($user, 'json', [
            'groups' => ['grow']
        ]);
        return new Response($data, 200, [
            'Content-Type' => 'application/json'
        ]);
    }
    
    /**
     * @Route("/usergrow", methods={"GET"})
     */
    public function usergrow(UserRepository $userRepository,SerializerInterface $serializer){
        $user=$userRepository->testreq("ROLE_COLLABORATEUR");
        $data = $serializer->serialize($user, 'json', [
            'groups' => ['grow']
        ]);
        return new Response($data, 200, [
            'Content-Type' => 'application/json'
        ]);
    }
    /**
     * @Route("/detailuser")
     */
    public function detailuser(Request $request,AllsessionRepository $allsessionRepository,EvalluationRepository $evalluationRepository){
        $data = json_decode($request->getContent(),true);//Récupère une chaîne encodée JSON et la convertit en une variable PHP
        if(!$data){//s il n'existe pas donc on recupere directement le tableau via la request
            $data=$request->request->all();
        }
       // $id=$data['id'];
       $id=403;
        //$mois=date('m');
        $mois="03";
        $annee=date('Y');
        $mois1="02";
        $reception= $this->calcululmoyennemensuel($id,$mois,$annee);
        $reception1= $this->calcululmoyennemensuel($id,$mois1,$annee);
        return $this->json([
            'userperseverance'=>$reception['userperseverance'],
            'userconfiance'=>$reception['userconfiance'],
            'usercollaboration'=>$reception['usercollaboration'],
            'userautonomie'=>$reception['userautonomie'],
            'userproblemsolving'=>$reception['userproblemsolving'],
            'usertransmission'=>$reception['usertransmission'],
            'userperformance'=>$reception['userperformance'],
            'teamperseverance'=>$reception['teamperseverance'],
            'teamconfiance'=>$reception['teamconfiance'],
            'teamcollaboration'=>$reception['teamcollaboration'],
            'teamautonomie'=>$reception['teamautonomie'],
            'teamproblemsolving'=>$reception['teamproblemsolving'],
            'teamtransmission'=>$reception['teamtransmission'],
            'teamperformance'=>$reception['teamperformance'],
            'general'=>$reception['general'],
            'moyennegeneral'=>($reception['general']-$reception1['general']),
            'moyenneuserperseverance'=>($reception['userperseverance']-$reception1['userperseverance']),
            'moyenneuserconfiance'=>($reception['userconfiance']-$reception1['userconfiance']),
            'moyenneusercollaboration'=>($reception['usercollaboration']-$reception1['usercollaboration']),
            'moyenneuserautonomie'=>($reception['userautonomie']-$reception1['userautonomie']),
            'moyenneuserproblemsolving'=>($reception['userproblemsolving']-$reception1['userproblemsolving']),
            'moyenneusertransmission'=>($reception['usertransmission']-$reception1['usertransmission']),
            'moyenneuserperformance'=>($reception['userperformance']-$reception1['userperformance']),
            'moyenneteamperseverance'=>($reception['teamperseverance']-$reception1['teamperseverance']),
            'moyenneteamconfiance'=>($reception['teamconfiance']-$reception1['teamconfiance']),
            'moyenneteamcollaboration'=>($reception['teamcollaboration']-$reception1['teamcollaboration']),
            'moyenneteamautonomie'=>($reception['teamautonomie']-$reception1['teamautonomie']),
            'moyenneteamproblemsolving'=>($reception['teamproblemsolving']-$reception1['teamproblemsolving']),
            'moyenneteamtransmission'=>($reception['teamtransmission']-$reception1['teamtransmission']),
            'moyenneteamperformance'=>($reception['teamperformance']-$reception1['teamperformance']),
        ]);
        
    }

    /**
     * @Route("/performaceteam")
     */
    public function performaceteam(UserRepository $userRepository){
        $user=$userRepository->testreq("ROLE_COLLABORATEUR");
        
    }
    public function calcululmoyennemensuel($id,$mois,$annee){

         $allsessionRepository=$this->getDoctrine()->getRepository(Allsession::class);
         $evalluationRepository=$this->getDoctrine()->getRepository(Evalluation::class);
        //1 Recuperer toutes les sessions que ce sont dérouller durant le mois
        $sessiondumois=$allsessionRepository->findBy(['mois'=>(string)$mois,'annee'=>(string)$annee]);
        if (!$sessiondumois) {
            //Pas de session durant ce mois
        }
        $moyenneteamperseverance=0;
        $moyenneteamconfiance=0;
        $moyenneteamcollaboration=0;
        $moyenneteamautonomie=0;
        $moyenneteamproblemsolving=0;
        $moyenneteamtransmission=0;
        $moyenneteamperformance=0;
        $nbrevaluateurteam=0;

        $moyenneuserperseverance=0;
        $moyenneuserconfiance=0;
        $moyenneusercollaboration=0;
        $moyenneuserautonomie=0;
        $moyenneuserproblemsolving=0;
        $moyenneusertransmission=0;
        $moyenneuserperformance=0;
        $nbrevaluateuruser=0;
        for ($i=0; $i < count($sessiondumois); $i++) { 
           $notesessionuser=$evalluationRepository->findBy(['evaluer'=>$id,'session'=>$sessiondumois[$i]->getId()]);
           if (!$notesessionuser) {
               //Il y'a eu session mais personne ne las evaluer
               $moyenneuserperseverance=$moyenneuserperseverance+0;      
               $moyenneuserconfiance=$moyenneuserconfiance+0;         
               $moyenneusercollaboration=$moyenneusercollaboration+0;
               $moyenneuserautonomie=$moyenneuserautonomie+0;             
               $moyenneuserproblemsolving=$moyenneuserproblemsolving+0;
               $moyenneusertransmission=$moyenneusertransmission+0;              
               $moyenneuserperformance=$moyenneuserperformance+0;           
           }
           else{
               for ($j=0; $j <count($notesessionuser) ; $j++) { 
                   $moyenneuserperseverance=$moyenneuserperseverance+$notesessionuser[$j]->getPerseverance();
                   $moyenneuserconfiance=$moyenneuserconfiance+$notesessionuser[$j]->getConfiance();
                   $moyenneusercollaboration=$moyenneusercollaboration+$notesessionuser[$j]->getCollaboration();
                   $moyenneuserautonomie=$moyenneuserautonomie+$notesessionuser[$j]->getAutonomie();
                   $moyenneuserproblemsolving=$moyenneuserproblemsolving+$notesessionuser[$j]->getProblemsolving();
                   $moyenneusertransmission=$moyenneusertransmission+$notesessionuser[$j]->getTransmission();
                   $moyenneuserperformance=$moyenneuserperformance+$notesessionuser[$j]->getPerformance();
                   $nbrevaluateuruser++;
               }
               $notesessionteam=$evalluationRepository->findBy(['session'=>$sessiondumois[$i]->getId()]);
               for ($k=0; $k <count($notesessionteam) ; $k++) {
                   $moyenneteamperseverance=$moyenneteamperseverance+$notesessionteam[$k]->getPerseverance();
                   $moyenneteamconfiance=$moyenneteamconfiance+$notesessionteam[$k]->getConfiance();
                   $moyenneteamcollaboration=$moyenneteamcollaboration+$notesessionteam[$k]->getCollaboration();
                   $moyenneteamautonomie=$moyenneteamautonomie+$notesessionteam[$k]->getAutonomie();
                   $moyenneteamproblemsolving=$moyenneteamproblemsolving+$notesessionteam[$k]->getProblemsolving();
                   $moyenneteamtransmission=$moyenneteamtransmission+$notesessionteam[$k]->getTransmission();
                   $moyenneteamperformance=$moyenneteamperformance+$notesessionteam[$k]->getPerformance();
                   $nbrevaluateurteam++;
               }
           }
        }
        $totalmoyenneuser=$moyenneuserperseverance+$moyenneuserconfiance+$moyenneusercollaboration+$moyenneuserautonomie+$moyenneuserproblemsolving+$moyenneusertransmission+$moyenneuserperformance;
        $totalmoyenneteam=$moyenneteamperseverance+$moyenneteamconfiance+$moyenneteamcollaboration+$moyenneteamautonomie+$moyenneteamproblemsolving+$moyenneteamtransmission+$moyenneteamperformance;
        $general=($totalmoyenneuser*100)/(30*$nbrevaluateuruser);
       $moyenneuserperseverance=($moyenneuserperseverance*100)/($nbrevaluateuruser*5);
       $moyenneuserconfiance=($moyenneuserconfiance*100)/($nbrevaluateuruser*5);
       $moyenneusercollaboration=($moyenneusercollaboration*100)/($nbrevaluateuruser*5);
       $moyenneuserautonomie=($moyenneuserautonomie*100)/($nbrevaluateuruser*5);
       $moyenneuserproblemsolving=($moyenneuserproblemsolving*100)/($nbrevaluateuruser*5);
       $moyenneusertransmission=($moyenneusertransmission*100)/($nbrevaluateuruser*5);
       $moyenneuserperformance=($moyenneuserperformance*100)/($nbrevaluateuruser*5);


       $moyenneteamperseverance=($moyenneteamperseverance*100)/($nbrevaluateurteam*5);
       $moyenneteamconfiance=($moyenneteamconfiance*100)/($nbrevaluateurteam*5);
       $moyenneteamcollaboration=($moyenneteamcollaboration*100)/($nbrevaluateurteam*5);
       $moyenneteamautonomie=($moyenneteamautonomie*100)/($nbrevaluateurteam*5);
       $moyenneteamproblemsolving=($moyenneteamproblemsolving*100)/($nbrevaluateurteam*5);
       $moyenneteamtransmission=($moyenneteamtransmission*100)/($nbrevaluateurteam*5);
       $moyenneteamperformance=($moyenneteamperformance*100)/($nbrevaluateurteam*5);
        return [
           'userperseverance'=>$moyenneuserperseverance,
           'userconfiance'=>$moyenneuserconfiance,
           'usercollaboration'=>$moyenneusercollaboration,
           'userautonomie'=>$moyenneuserautonomie,
           'userproblemsolving'=>$moyenneuserproblemsolving,
           'usertransmission'=>$moyenneusertransmission,
           'userperformance'=>$moyenneuserperformance,
           'teamperseverance'=>$moyenneteamperseverance,
           'teamconfiance'=>$moyenneteamconfiance,
           'teamcollaboration'=>$moyenneteamcollaboration,
           'teamautonomie'=>$moyenneteamautonomie,
           'teamproblemsolving'=>$moyenneteamproblemsolving,
           'teamtransmission'=>$moyenneteamtransmission,
           'teamperformance'=>$moyenneteamperformance,
           'user'=>$nbrevaluateuruser,
           'team'=>$nbrevaluateurteam,
           'totaluser'=>$totalmoyenneuser,
           'totalteam'=>$totalmoyenneteam,
           'general'=>$general
        //    'generalperseverance'=>$moyennegeneralperseverance,
        //    'generalconfiance'=>$moyennegeneralconfiance,
        //    'generalcollaboration'=>$moyennegeneralcollaboration,
        //    'generalautonomie'=>$moyennegeneralautonomie,
        //    'generalproblemsolving'=>$moyennegeneralproblemsolving,
        //    'generaltransmission'=>$moyennegeneraltransmission,
        //    'generalperformance'=>$moyennegeneralperformance,
       ];

    }
    // public function performaceteam($mois){
    //     $allsessionRepository=$this->getDoctrine()->getRepository(Allsession::class);
    //     $evalluationRepository=$this->getDoctrine()->getRepository(Evalluation::class);
    //     $userRepository=$this->getDoctrine()->getRepository(User::class);
    //     $user=$userRepository->testreq("ROLE_COLLABORATEUR");
    //    // $mois="03";
    //     $annee=date('Y');
    //     $moyenneuserperseverance=0;
    //     $moyenneuserconfiance=0;
    //     $moyenneusercollaboration=0;
    //     $moyenneuserautonomie=0;
    //     $moyenneuserproblemsolving=0;
    //     $moyenneusertransmission=0;
    //     $moyenneuserperformance=0;
    //     $nbrevaluateuruser=0;
    //     for ($i=0; $i <count($user) ; $i++) { 
    //         $session=$allsessionRepository->findBy(['mois'=>(string)$mois,'annee'=>(string)$annee]);
    //         for ($j=0; $j < count($session); $j++) { 
    //             if (!$session) {
    //                 //Pas de session durant ce mois
    //             }
    //             $notesessionuser=$evalluationRepository->findBy(['evaluer'=>$user[$i]->getId(),'session'=>$session[$j]->getId()]);
    //             for ($k=0; $k <count($notesessionuser) ; $k++) { 
    //                 $moyenneuserperseverance=$moyenneuserperseverance+$notesessionuser[$j]->getPerseverance();
    //                 $moyenneuserconfiance=$moyenneuserconfiance+$notesessionuser[$j]->getConfiance();
    //                 $moyenneusercollaboration=$moyenneusercollaboration+$notesessionuser[$j]->getCollaboration();
    //                 $moyenneuserautonomie=$moyenneuserautonomie+$notesessionuser[$j]->getAutonomie();
    //                 $moyenneuserproblemsolving=$moyenneuserproblemsolving+$notesessionuser[$j]->getProblemsolving();
    //                 $moyenneusertransmission=$moyenneusertransmission+$notesessionuser[$j]->getTransmission();
    //                 $moyenneuserperformance=$moyenneuserperformance+$notesessionuser[$j]->getPerformance();
    //                 $nbrevaluateuruser++;                    
    //             }

    //         }
    //     }
    // }
}
