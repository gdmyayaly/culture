<?php

namespace App\Controller;

use DateTime;
use App\Entity\Allsession;
use App\Entity\Evaluation;
use App\Repository\UserRepository;
use App\Repository\AllsessionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
     * @Route("/admin", name="admin")
     */
class SystemeController extends AbstractController
{
    /**
     * @Route("/infos", name="infos")
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
     * @Route("/note")
     */
    public function note(Request $request,SerializerInterface $serializer,AllsessionRepository $allsessionRepository,EntityManagerInterface $entityManagerInterface,UserRepository $userRepository){
        $user=$this->getUser();
        $sevenlastsession= $allsessionRepository->sevenlastevaluation();
        $session=$sevenlastsession[0];
        //$session= $allsessionRepository->findOneBy(['nombre'=>10]);
       // dump($session);die();
        $data = json_decode($request->getContent(),true);
        if(!$data){
            $data=$request->request->all();
        }
        $evaluation= new Evaluation();
        $evaluation->setPerseverance($data['perseverance']);
        $evaluation->setConfiance($data['confiance']);
        $evaluation->setCollaboration($data['collaboration']);
        $evaluation->setAutonomie($data['autonomie']);
        $evaluation->setProblemsolving($data['problemsolving']);
        $evaluation->setTransmission($data['transmission']);
        $evaluation->setPerformance($data['performance']);
        $evaluation->setEvaluateur($user);
        $a=$userRepository->findOneBy(['username'=>$data['evaluer']]);
        $evaluation->setEvaluer($a);
        $evaluation->setDate(new DateTime());
        $evaluation->setSession($session);
        $entityManagerInterface->persist($evaluation);
        $entityManagerInterface->flush();
        $date = $serializer->serialize($user, 'json', [
            'groups' => ['grow']
        ]);
        return new Response($date, 200, [
            'Content-Type' => 'application/json'
        ]);
    }

    /**
     * @Route("/datacarduser")
     */
    public function datacarduser(Request $request){
        $reception = json_decode($request->getContent(),true);
        if(!$reception){
            $reception=$request->request->all();
        }
        $mois=date('m');
        //$mois="03";
        $annee=date('Y');
       // dump($mois);die();
        $id=$reception['id'];
        $a=$this->userdatamois($id,$mois,$annee);
        $datamoisactuel=$this->userdatamois($id,$mois,$annee);
        $moispasser=(int)$mois;
        $moispasser--;
        $moispasser=(string)$moispasser;
        $datamoispasser=$this->userdatamois($id,$moispasser,$annee);
       // dump($datamoisactuel);
        //dump($datamoispasser);
        //die();
        if ($datamoisactuel['nbruser']==0) {
            $userperseverance=0;
            $userconfiance=0;
            $usercollaboration=0;
            $userautonomie=0;
            $userproblemsolving=0;
            $usertransmission=0;
            $userperformance=0;
            $teamperseverance=0;
            $teamconfiance=0;
            $teamcollaboration=0;
            $teamautonomie=0;
            $teamproblemsolving=0;
            $teamtransmission=0;
            $teamperformance=0;
        }
        else{
            $userperseverance=($datamoisactuel['userperseverance']*100)/($datamoisactuel['nbruser']*5);
            $userconfiance=($datamoisactuel['userconfiance']*100)/($datamoisactuel['nbruser']*5);
            $usercollaboration=($datamoisactuel['usercollaboration']*100)/($datamoisactuel['nbruser']*5);
            $userautonomie=($datamoisactuel['userautonomie']*100)/($datamoisactuel['nbruser']*5);
            $userproblemsolving=($datamoisactuel['userproblemsolving']*100)/($datamoisactuel['nbruser']*5);
            $usertransmission=($datamoisactuel['usertransmission']*100)/($datamoisactuel['nbruser']*5);
            $userperformance=($datamoisactuel['userperformance']*100)/($datamoisactuel['nbruser']*5);
            $teamperseverance=($datamoisactuel['teamperseverance']*100)/($datamoisactuel['nbrteam']*5);
            $teamconfiance=($datamoisactuel['teamconfiance']*100)/($datamoisactuel['nbrteam']*5);
            $teamcollaboration=($datamoisactuel['teamcollaboration']*100)/($datamoisactuel['nbrteam']*5);
            $teamautonomie=($datamoisactuel['teamautonomie']*100)/($datamoisactuel['nbrteam']*5);
            $teamproblemsolving=($datamoisactuel['teamproblemsolving']*100)/($datamoisactuel['nbrteam']*5);
            $teamtransmission=($datamoisactuel['teamtransmission']*100)/($datamoisactuel['nbrteam']*5);
            $teamperformance=($datamoisactuel['teamperformance']*100)/($datamoisactuel['nbrteam']*5);
            $general=(round($userperseverance,2)+round($usertransmission,2)+round($userconfiance,2)+round($usercollaboration,2)+round($userautonomie,2)+round($userproblemsolving,2)+round($userperformance,2))/(7);
        }
        if ($datamoispasser['nbruser']==0) {
            $passeruserperseverance=0;
            $passeruserconfiance=0;
            $passerusercollaboration=0;
            $passeruserautonomie=0;
            $passeruserproblemsolving=0;
            $passerusertransmission=0;
            $passeruserperformance=0;
            $passerteamperseverance=0;
            $passerteamconfiance=0;
            $passerteamcollaboration=0;
            $passerteamautonomie=0;
            $passerteamproblemsolving=0;
            $passerteamtransmission=0;
            $passerteamperformance=0;
            $passeruserperseverance=($datamoispasser['userperseverance']*100)/($datamoispasser['nbruser']*5);
            $passeruserconfiance=($datamoispasser['userconfiance']*100)/($datamoispasser['nbruser']*5);
            $passerusercollaboration=($datamoispasser['usercollaboration']*100)/($datamoispasser['nbruser']*5);
            $passeruserautonomie=($datamoispasser['userautonomie']*100)/($datamoispasser['nbruser']*5);
            $passeruserproblemsolving=($datamoispasser['userproblemsolving']*100)/($datamoispasser['nbruser']*5);
            $passerusertransmission=($datamoispasser['usertransmission']*100)/($datamoispasser['nbruser']*5);
            $passeruserperformance=($datamoispasser['userperformance']*100)/($datamoispasser['nbruser']*5);
            $passerteamperseverance=($datamoispasser['teamperseverance']*100)/($datamoispasser['nbrteam']*5);
            $passerteamconfiance=($datamoispasser['teamconfiance']*100)/($datamoispasser['nbrteam']*5);
            $passerteamcollaboration=($datamoispasser['teamcollaboration']*100)/($datamoispasser['nbrteam']*5);
            $passerteamautonomie=($datamoispasser['teamautonomie']*100)/($datamoispasser['nbrteam']*5);
            $passerteamproblemsolving=($datamoispasser['teamproblemsolving']*100)/($datamoispasser['nbrteam']*5);
            $passerteamtransmission=($datamoispasser['teamtransmission']*100)/($datamoispasser['nbrteam']*5);
            $passerteamperformance=($datamoispasser['teamperformance']*100)/($datamoispasser['nbrteam']*5);

            $moyenneuserperseverance=0;
            $moyenneuserconfiance=0;
            $moyenneusercollaboration=0;
            $moyenneuserautonomie=0;
            $moyenneuserproblemsolving=0;
            $moyenneusertransmission=0;
            $moyenneuserperformance=0;
            $moyenneteamperseverance=0;
            $moyenneteamconfiance=0;
            $moyenneteamcollaboration=0;
            $moyenneteamautonomie=0;
            $moyenneteamproblemsolving=0;
            $moyenneteamtransmission=0;
            $moyenneteamperformance=0;
            $moyennegeneral=(round($userperseverance,2)+round($usertransmission,2)+round($userconfiance,2)+round($usercollaboration,2)+round($userautonomie,2)+round($userproblemsolving,2)+round($userperformance,2))/(7);
            $moyennegeneral=-(($datamoisactuel['totalnote'])*100)/($datamoisactuel['nbruser']*30);
        }
        else{
            $moyenneuserperseverance=(($datamoispasser['userperseverance']*100)/($datamoispasser['nbruser']*5))-(($datamoisactuel['userperseverance']*100)/($datamoisactuel['nbruser']*5));
            $moyenneuserconfiance=(($datamoispasser['userconfiance']*100)/($datamoispasser['nbruser']*5))-(($datamoisactuel['userconfiance']*100)/($datamoisactuel['nbruser']*5));
            $moyenneusercollaboration=(($datamoispasser['usercollaboration']*100)/($datamoispasser['nbruser']*5))-(($datamoisactuel['usercollaboration']*100)/($datamoisactuel['nbruser']*5));
            $moyenneuserautonomie=(($datamoispasser['userautonomie']*100)/($datamoispasser['nbruser']*5))-(($datamoisactuel['userautonomie']*100)/($datamoisactuel['nbruser']*5));
            $moyenneuserproblemsolving=(($datamoispasser['userproblemsolving']*100)/($datamoispasser['nbruser']*5))-(($datamoisactuel['userproblemsolving']*100)/($datamoisactuel['nbruser']*5));
            $moyenneusertransmission=(($datamoispasser['usertransmission']*100)/($datamoispasser['nbruser']*5))-(($datamoisactuel['usertransmission']*100)/($datamoisactuel['nbruser']*5));
            $moyenneuserperformance=(($datamoispasser['userperformance']*100)/($datamoispasser['nbruser']*5))-(($datamoisactuel['userperformance']*100)/($datamoisactuel['nbruser']*5));
            $moyenneteamperseverance=(($datamoispasser['teamperseverance']*100)/($datamoispasser['nbrteam']*5))-(($datamoisactuel['teamperseverance']*100)/($datamoisactuel['nbrteam']*5));
            $moyenneteamconfiance=(($datamoispasser['teamconfiance']*100)/($datamoispasser['nbrteam']*5))-(($datamoisactuel['teamconfiance']*100)/($datamoisactuel['nbrteam']*5));
            $moyenneteamcollaboration=(($datamoispasser['teamcollaboration']*100)/($datamoispasser['nbrteam']*5))-(($datamoisactuel['teamcollaboration']*100)/($datamoisactuel['nbrteam']*5));
            $moyenneteamautonomie=(($datamoispasser['teamautonomie']*100)/($datamoispasser['nbrteam']*5))-(($datamoisactuel['teamautonomie']*100)/($datamoisactuel['nbrteam']*5));
            $moyenneteamproblemsolving=(($datamoispasser['teamproblemsolving']*100)/($datamoispasser['nbrteam']*5))-(($datamoisactuel['teamproblemsolving']*100)/($datamoisactuel['nbrteam']*5));
            $moyenneteamtransmission=(($datamoispasser['teamtransmission']*100)/($datamoispasser['nbrteam']*5))-(($datamoisactuel['teamtransmission']*100)/($datamoisactuel['nbrteam']*5));
            $moyenneteamperformance=(($datamoispasser['teamperformance']*100)/($datamoispasser['nbrteam']*5))-(($datamoisactuel['teamperformance']*100)/($datamoisactuel['nbrteam']*5));
            $moyennegeneral=(($datamoispasser['totalnote'])*100)/($datamoispasser['nbruser']*30)-(($datamoisactuel['totalnote'])*100)/($datamoisactuel['nbruser']*30);
        }
        return $this->json([
            'userperseverance'=>round($userperseverance,2),
            'userconfiance'=>round($userconfiance,2),
            'usercollaboration'=>round($usercollaboration,2),
            'userautonomie'=>round($userautonomie,2),
            'userproblemsolving'=>round($userproblemsolving,2),
            'usertransmission'=>round($usertransmission,2),
            'userperformance'=>round($userperformance,2),
            'teamperseverance'=>round($teamperseverance,2),
            'teamconfiance'=>round($teamconfiance,2),
            'teamcollaboration'=>round($teamcollaboration,2),
            'teamautonomie'=>round($teamautonomie,2),
            'teamproblemsolving'=>round($teamproblemsolving,2),
            'teamtransmission'=>round($teamtransmission,2),
            'teamperformance'=>round($teamperformance,2),
            'moyenneuserperseverance'=>round($moyenneuserperseverance,2),
            'moyenneuserconfiance'=>round($moyenneuserconfiance,2),
            'moyenneusercollaboration'=>round($moyenneusercollaboration,2),
            'moyenneuserautonomie'=>round($moyenneuserautonomie,2),
            'moyenneuserproblemsolving'=>round($moyenneuserproblemsolving,2),
            'moyenneusertransmission'=>round($moyenneusertransmission,2),
            'moyenneuserperformance'=>round($moyenneuserperformance,2),
            'moyenneteamperseverance'=>round($moyenneteamperseverance,2),
            'moyenneteamconfiance'=>round($moyenneteamconfiance,2),
            'moyenneteamcollaboration'=>round($moyenneteamcollaboration,2),
            'moyenneteamautonomie'=>round($moyenneteamautonomie,2),
            'moyenneteamproblemsolving'=>round($moyenneteamproblemsolving,2),
            'moyenneteamtransmission'=>round($moyenneteamtransmission,2),
            'moyenneteamperformance'=>round($moyenneteamperformance,2),
            'general'=>round($general,2),
            'moyennegeneral'=>round($moyennegeneral,2),
        ]);
    }

    public function userdatamois($id,$mois,$annee){
        $allsessionRepository=$this->getDoctrine()->getRepository(Allsession::class);
        $evaluationRepository=$this->getDoctrine()->getRepository(Evaluation::class);
        $userperseverance=0;
        $userconfiance=0;
        $usercollaboration=0;
        $userautonomie=0;
        $userproblemsolving=0;
        $usertransmission=0;
        $userperformance=0;
        $nbruser=0;
        $teamperseverance=0;
        $teamconfiance=0;
        $teamcollaboration=0;
        $teamautonomie=0;
        $teamproblemsolving=0;
        $teamtransmission=0;
        $teamperformance=0;
        $nbrteam=0;
        $totaluser=0;
        $sessiondumois=$allsessionRepository->findBy(['annee'=>$annee,'mois'=>$mois]);
        if ($sessiondumois) {
            for ($i=0; $i < count($sessiondumois); $i++) {
            $userevaluations=$evaluationRepository->findBy(['evaluer'=>$id,'session'=>$sessiondumois[$i]->getId()]);
            for ($j=0; $j <count($userevaluations) ; $j++) { 
                $userperseverance=$userperseverance+$userevaluations[$j]->getPerseverance();
                $userconfiance=$userconfiance+$userevaluations[$j]->getConfiance();
                $usercollaboration=$usercollaboration+$userevaluations[$j]->getCollaboration();
                $userautonomie=$userautonomie+$userevaluations[$j]->getAutonomie();
                $userproblemsolving=$userproblemsolving+$userevaluations[$j]->getProblemsolving();
                $usertransmission=$usertransmission+$userevaluations[$j]->getTransmission();
                $userperformance=$userperformance+$userevaluations[$j]->getPerformance();
                $nbruser++;
            }
            $teamevaluations=$evaluationRepository->findBy(['session'=>$sessiondumois[$i]->getId()]);
            for ($k=0; $k <count($teamevaluations) ; $k++) { 
                $teamperseverance=$teamperseverance+$teamevaluations[$k]->getPerseverance();
                $teamconfiance=$teamconfiance+$teamevaluations[$k]->getConfiance();
                $teamcollaboration=$teamcollaboration+$teamevaluations[$k]->getCollaboration();
                $teamautonomie=$teamautonomie+$teamevaluations[$k]->getAutonomie();
                $teamproblemsolving=$teamproblemsolving+$teamevaluations[$k]->getProblemsolving();
                $teamtransmission=$teamtransmission+$teamevaluations[$k]->getTransmission();
                $teamperformance=$teamperformance+$teamevaluations[$k]->getPerformance();
                $nbrteam++;
            }
        }
        }

        return[
            'userperseverance'=>$userperseverance,
            'userconfiance'=>$userconfiance,
            'usercollaboration'=>$usercollaboration,
            'userautonomie'=>$userautonomie,
            'userproblemsolving'=>$userproblemsolving,
            'usertransmission'=>$usertransmission,
            'userperformance'=>$userperformance,
            'nbruser'=>$nbruser,
            'teamperseverance'=>$teamperseverance,
            'teamconfiance'=>$teamconfiance,
            'teamcollaboration'=>$teamcollaboration,
            'teamautonomie'=>$teamautonomie,
            'teamproblemsolving'=>$teamproblemsolving,
            'teamtransmission'=>$teamtransmission,
            'teamperformance'=>$teamperformance,
            'nbrteam'=>$nbrteam,
            'totalnote'=>$totaluser,
        ];
    }
}
