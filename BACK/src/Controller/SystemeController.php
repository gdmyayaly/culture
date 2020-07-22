<?php

namespace App\Controller;

use DateTime;
use App\Entity\Allsession;
use App\Entity\Evaluation;
use App\Repository\UserRepository;
use App\Repository\AllsessionRepository;
use App\Repository\TeamRepository;
use App\Repository\UserTeamRepository;
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
        $id=$reception['id'];
        $a=$this->userdatamois($id,$mois,$annee);
        $datamoisactuel=$this->userdatamois($id,$mois,$annee);
        $moispasser=(int)$mois;
        $moispasser--;
        $moispasser=(string)$moispasser;
        $datamoispasser=$this->userdatamois($id,$moispasser,$annee);
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
            $passergeneral=0;
        }
        else{
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
            $passergeneral=(round($passeruserperseverance,2)+round($passerusertransmission,2)+round($passeruserconfiance,2)+round($passerusercollaboration,2)+round($passeruserautonomie,2)+round($passeruserproblemsolving,2)+round($passeruserperformance,2))/(7);
        }
        $moyenneuserperseverance=$userperseverance-$passeruserperseverance;
        $moyenneuserconfiance=$userconfiance-$passeruserconfiance;
        $moyenneusercollaboration=$usercollaboration-$passerusercollaboration;
        $moyenneuserautonomie=$userautonomie-$passeruserautonomie;
        $moyenneuserproblemsolving=$userproblemsolving-$passeruserproblemsolving;
        $moyenneusertransmission=$usertransmission-$passerusertransmission;
        $moyenneuserperformance=$userperformance-$passeruserperformance;

        $moyenneteamperseverance=$teamperseverance-$passerteamperseverance;
        $moyenneteamconfiance=$teamconfiance-$passerteamconfiance;
        $moyenneteamcollaboration=$teamcollaboration-$passerteamcollaboration;
        $moyenneteamautonomie=$teamautonomie-$passerteamautonomie;
        $moyenneteamproblemsolving=$teamproblemsolving-$passerteamproblemsolving;
        $moyenneteamtransmission=$teamtransmission-$passerteamtransmission;
        $moyenneteamperformance=$teamperformance-$passerteamperformance;
        $moyennegeneral=$general-$passergeneral;
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
     /**
     * @Route("/notesevenlastdays")
     */
    public function notesevenlastdays(Request $request,AllsessionRepository $allsessionRepository,UserRepository $userRepository){
        $reception = json_decode($request->getContent(),true);
        if(!$reception){
            $reception=$request->request->all();
        }
        $id=$reception['id'];
        $date=[];
        $moyenneuserperseverance=[];
        $moyenneuserconfiance=[];
        $moyenneusercollaboration=[];
        $moyenneuserautonomie=[];
        $moyenneuserproblemsolving=[];
        $moyenneusertransmission=[];
        $moyenneuserperformance=[];
        $lastevaluation=$allsessionRepository->sevenlastevaluation();
        for ($i=0; $i <count($lastevaluation) ; $i++) { 
            $a=$this->userdataday($id,$lastevaluation[$i]->getDate(),2020);
            array_push($date,date_format($lastevaluation[$i]->getDate(),'j F'));
            if ($a['nbruser']==0) {
                array_push($moyenneuserperseverance,0);
                array_push($moyenneuserconfiance,0);
                array_push($moyenneusercollaboration,0);
                array_push($moyenneuserautonomie,0);
                array_push($moyenneuserproblemsolving,0);
                array_push($moyenneusertransmission,0);
                array_push($moyenneuserperformance,0);                
            }
            else{
                array_push($moyenneuserperseverance,round(($a['userperseverance'])/($a['nbruser']),2));
                array_push($moyenneuserconfiance,round(($a['userconfiance'])/($a['nbruser']),2));
                array_push($moyenneusercollaboration,round(($a['usercollaboration'])/($a['nbruser']),2));
                array_push($moyenneuserautonomie,round(($a['userautonomie'])/($a['nbruser']),2));
                array_push($moyenneuserproblemsolving,round(($a['userproblemsolving'])/($a['nbruser']),2));
                array_push($moyenneusertransmission,round(($a['usertransmission'])/($a['nbruser']),2));
                array_push($moyenneuserperformance,round(($a['userperformance'])/($a['nbruser']),2));
            }

        }
        $user=$userRepository->testreq("ROLE_COLLABORATEUR");
        $teamperseverance=[];
        $teamconfiance=[];
        $teamcollaboration=[];
        $teamautonomie=[];
        $teamproblemsolving=[];
        $teamtransmission=[];
        $teamperformance=[];

        $userteamperseverance=0;
        $userteamconfiance=0;
        $userteamcollaboration=0;
        $userteamautonomie=0;
        $userteamproblemsolving=0;
        $userteamtransmission=0;
        $userteamperformance=0;
        for ($i=0; $i <count($lastevaluation) ; $i++) { 
            $userteamperseverance=0;
            $userteamconfiance=0;
            $userteamcollaboration=0;
            $userteamautonomie=0;
            $userteamproblemsolving=0;
            $userteamtransmission=0;
            $userteamperformance=0;
            for ($j=0; $j < count($user); $j++) {
            $rr=$this->userdataday($user[$j]->getId(),$lastevaluation[$i]->getDate(),2020);
            if ($rr['nbruser']==0) {
                $userteamperseverancetampon=0;
                $userteamconfiancetampon=0;
                $userteamcollaborationtampon=0;
                $userteamautonomietampon=0;
                $userteamproblemsolvingtampon=0;
                $userteamtransmissiontampon=0;
                $userteamperformancetampon=0;
                $userteamperseverance=$userteamperseverance+$userteamperseverancetampon;
                $userteamconfiance=$userteamconfiance+$userteamconfiancetampon;
                $userteamcollaboration=$userteamcollaboration+$userteamcollaborationtampon;
                $userteamautonomie=$userteamautonomie+$userteamautonomietampon;
                $userteamproblemsolving=$userteamproblemsolving+$userteamproblemsolvingtampon;
                $userteamtransmission=$userteamtransmission+$userteamtransmissiontampon;
                $userteamperformance=$userteamperformance+$userteamperformancetampon;
            }
            else{
                $userteamperseverancetampon=($rr['userperseverance'])/($rr['nbruser']);
                $userteamconfiancetampon=($rr['userconfiance'])/($rr['nbruser']);
                $userteamcollaborationtampon=($rr['usercollaboration'])/($rr['nbruser']);
                $userteamautonomietampon=($rr['userautonomie'])/($rr['nbruser']);
                $userteamproblemsolvingtampon=($rr['userproblemsolving'])/($rr['nbruser']);
                $userteamtransmissiontampon=($rr['usertransmission'])/($rr['nbruser']);
                $userteamperformancetampon=($rr['userperformance'])/($rr['nbruser']);
                $userteamperseverance=$userteamperseverance+$userteamperseverancetampon;
                $userteamconfiance=$userteamconfiance+$userteamconfiancetampon;
                $userteamcollaboration=$userteamcollaboration+$userteamcollaborationtampon;
                $userteamautonomie=$userteamautonomie+$userteamautonomietampon;
                $userteamproblemsolving=$userteamproblemsolving+$userteamproblemsolvingtampon;
                $userteamtransmission=$userteamtransmission+$userteamtransmissiontampon;
                $userteamperformance=$userteamperformance+$userteamperformancetampon;
            }
        }
        array_push($teamperseverance,round(($userteamperseverance)/(count($user)),2));
        array_push($teamconfiance,round(($userteamconfiance)/(count($user)),2));
        array_push($teamcollaboration,round(($userteamcollaboration)/(count($user)),2));
        array_push($teamautonomie,round(($userteamautonomie)/(count($user)),2));
        array_push($teamproblemsolving,round(($userteamproblemsolving)/(count($user)),2));
        array_push($teamtransmission,round(($userteamtransmission)/(count($user)),2));
        array_push($teamperformance,round(($userteamperformance)/(count($user)),2));
        }
       return $this->json([
        'date'=>$date,
        'perseverance'=>$moyenneuserperseverance,
        'confiance'=>$moyenneuserconfiance,
        'collaboration'=>$moyenneusercollaboration,
        'autonomie'=>$moyenneuserautonomie,
        'problemsolving'=>$moyenneuserproblemsolving,
        'transmission'=>$moyenneusertransmission,
        'performance'=>$moyenneuserperformance,
        'teamperseverance'=>$teamperseverance,
        'teamconfiance'=>$teamconfiance,
        'teamcollaboration'=>$teamcollaboration,
        'teamautonomie'=>$teamautonomie,
        'teamproblemsolving'=>$teamproblemsolving,
        'teamtransmission'=>$teamtransmission,
        'teamperformance'=>$teamperformance,
       ]);
    }

/**
     * @Route("/lastevaluationdumois")
     */
    public function lastevaluationdumois(Request $request,UserRepository $userRepository){
        $data = json_decode($request->getContent(),true);
        if(!$data){
            $data=$request->request->all();
        }
       $id=$data['id'];
        //$id=403;
        $anne=date('Y');
        $userperseverance=[];
        $userconfiance=[];
        $usercollaboration=[];
        $userautonomie=[];
        $userproblemsolving=[];
        $usertransmission=[];
        $userperformance=[];
        $moisd=["Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Décembre"];
        $mois=["01","02","03","04","05","06","07","08","09","10","11","12"];
        for ($i=0; $i <count($mois) ; $i++) { 
            $rr=$this->userdatamois($id,$mois[$i],$anne);
            if ($rr['nbruser']==0) {
                array_push($userperseverance,0);
                array_push($userconfiance,0);
                array_push($usercollaboration,0);
                array_push($userautonomie,0);
                array_push($userproblemsolving,0);
                array_push($usertransmission,0);
                array_push($userperformance,0); 
            }
            else{
                array_push($userperseverance,($rr['userperseverance'])/($rr['nbruser']));
                array_push($userconfiance,($rr['userconfiance'])/($rr['nbruser']));
                array_push($usercollaboration,($rr['usercollaboration'])/($rr['nbruser']));
                array_push($userautonomie,($rr['userautonomie'])/($rr['nbruser']));
                array_push($userproblemsolving,($rr['userproblemsolving'])/($rr['nbruser']));
                array_push($usertransmission,($rr['usertransmission'])/($rr['nbruser']));
                array_push($userperformance,($rr['userperformance'])/($rr['nbruser'])); 
            }
        }
        $user=$userRepository->testreq("ROLE_COLLABORATEUR");
        $teamperseverance=[];
        $teamconfiance=[];
        $teamcollaboration=[];
        $teamautonomie=[];
        $teamproblemsolving=[];
        $teamtransmission=[];
        $teamperformance=[];

        $userteamperseverance=0;
        $userteamconfiance=0;
        $userteamcollaboration=0;
        $userteamautonomie=0;
        $userteamproblemsolving=0;
        $userteamtransmission=0;
        $userteamperformance=0;
        for ($i=0; $i <count($mois) ; $i++) { 
            $userteamperseverance=0;
            $userteamconfiance=0;
            $userteamcollaboration=0;
            $userteamautonomie=0;
            $userteamproblemsolving=0;
            $userteamtransmission=0;
            $userteamperformance=0;
            for ($j=0; $j < count($user); $j++) {
            $rr=$this->userdatamois($user[$j]->getId(),$mois[$i],$anne);
            if ($rr['nbruser']==0) {
                $userteamperseverancetampon=0;
                $userteamconfiancetampon=0;
                $userteamcollaborationtampon=0;
                $userteamautonomietampon=0;
                $userteamproblemsolvingtampon=0;
                $userteamtransmissiontampon=0;
                $userteamperformancetampon=0;
                $userteamperseverance=$userteamperseverance+$userteamperseverancetampon;
                $userteamconfiance=$userteamconfiance+$userteamconfiancetampon;
                $userteamcollaboration=$userteamcollaboration+$userteamcollaborationtampon;
                $userteamautonomie=$userteamautonomie+$userteamautonomietampon;
                $userteamproblemsolving=$userteamproblemsolving+$userteamproblemsolvingtampon;
                $userteamtransmission=$userteamtransmission+$userteamtransmissiontampon;
                $userteamperformance=$userteamperformance+$userteamperformancetampon;
            }
            else{
                $userteamperseverancetampon=($rr['userperseverance'])/($rr['nbruser']);
                $userteamconfiancetampon=($rr['userconfiance'])/($rr['nbruser']);
                $userteamcollaborationtampon=($rr['usercollaboration'])/($rr['nbruser']);
                $userteamautonomietampon=($rr['userautonomie'])/($rr['nbruser']);
                $userteamproblemsolvingtampon=($rr['userproblemsolving'])/($rr['nbruser']);
                $userteamtransmissiontampon=($rr['usertransmission'])/($rr['nbruser']);
                $userteamperformancetampon=($rr['userperformance'])/($rr['nbruser']);
                $userteamperseverance=$userteamperseverance+$userteamperseverancetampon;
                $userteamconfiance=$userteamconfiance+$userteamconfiancetampon;
                $userteamcollaboration=$userteamcollaboration+$userteamcollaborationtampon;
                $userteamautonomie=$userteamautonomie+$userteamautonomietampon;
                $userteamproblemsolving=$userteamproblemsolving+$userteamproblemsolvingtampon;
                $userteamtransmission=$userteamtransmission+$userteamtransmissiontampon;
                $userteamperformance=$userteamperformance+$userteamperformancetampon;
            }
        }
        array_push($teamperseverance,round(($userteamperseverance)/(count($user)),2));
        array_push($teamconfiance,round(($userteamconfiance)/(count($user)),2));
        array_push($teamcollaboration,round(($userteamcollaboration)/(count($user)),2));
        array_push($teamautonomie,round(($userteamautonomie)/(count($user)),2));
        array_push($teamproblemsolving,round(($userteamproblemsolving)/(count($user)),2));
        array_push($teamtransmission,round(($userteamtransmission)/(count($user)),2));
        array_push($teamperformance,round(($userteamperformance)/(count($user)),2));
        }

        return $this->json([
            'date'=>$moisd,
            'userperseverance'=>$userperseverance,
            'userconfiance'=>$userconfiance,
            'usercollaboration'=>$usercollaboration,
            'userautonomie'=>$userautonomie,
            'userproblemsolving'=>$userproblemsolving,
            'usertransmission'=>$usertransmission,
            'userperformance'=>$userperformance,
            
            'teamperseverance'=>$teamperseverance,
            'teamconfiance'=>$teamconfiance,
            'teamcollaboration'=>$teamcollaboration,
            'teamautonomie'=>$teamautonomie,
            'teamproblemsolving'=>$teamproblemsolving,
            'teamtransmission'=>$teamtransmission,
            'teamperformance'=>$teamperformance,
        ]);

    }

/**
         * @Route("/performaceteam")
         */
        public function performaceteam(UserRepository $userRepository,SerializerInterface $serializer){
            $allusers=$userRepository->testreq("ROLE_COLLABORATEUR");
            //$mois="03";
            $mois=date('m');
            $moispasser=(int)$mois;
            $moispasser--;
            $moispasser=(string)$moispasser;
            $data=[];
            for ($i=0; $i <count($allusers) ; $i++) { 
                $totalactuel=0;
                $totalpasser=0;
                $donneractuel=$this->userdatamois($allusers[$i]->getId(),$mois,2020);
                $donnerpasser=$this->userdatamois($allusers[$i]->getId(),$moispasser,2020);
                if ($donneractuel['nbruser']==0) {
                    $totalactuel=0;
                }
                else{
                    $userperseverance=($donneractuel['userperseverance']*100)/($donneractuel['nbruser']*5);
                    $userconfiance=($donneractuel['userconfiance']*100)/($donneractuel['nbruser']*5);
                    $usercollaboration=($donneractuel['usercollaboration']*100)/($donneractuel['nbruser']*5);
                    $userautonomie=($donneractuel['userautonomie']*100)/($donneractuel['nbruser']*5);
                    $userproblemsolving=($donneractuel['userproblemsolving']*100)/($donneractuel['nbruser']*5);
                    $usertransmission=($donneractuel['usertransmission']*100)/($donneractuel['nbruser']*5);
                    $userperformance=($donneractuel['userperformance']*100)/($donneractuel['nbruser']*5);
                    $totalactuel=(round($userperseverance,2)+round($usertransmission,2)+round($userconfiance,2)+round($usercollaboration,2)+round($userautonomie,2)+round($userproblemsolving,2)+round($userperformance,2))/(7);
                }
                if ($donnerpasser['nbruser']==0) {
                    $totalpasser=0;
                }
                else{
                    $passeruserperseverance=($donnerpasser['userperseverance']*100)/($donnerpasser['nbruser']*5);
                    $passeruserconfiance=($donnerpasser['userconfiance']*100)/($donnerpasser['nbruser']*5);
                    $passerusercollaboration=($donnerpasser['usercollaboration']*100)/($donnerpasser['nbruser']*5);
                    $passeruserautonomie=($donnerpasser['userautonomie']*100)/($donnerpasser['nbruser']*5);
                    $passeruserproblemsolving=($donnerpasser['userproblemsolving']*100)/($donnerpasser['nbruser']*5);
                    $passerusertransmission=($donnerpasser['usertransmission']*100)/($donnerpasser['nbruser']*5);
                    $passeruserperformance=($donnerpasser['userperformance']*100)/($donnerpasser['nbruser']*5);
                    $totalpasser=(round($passeruserperseverance,2)+round($passerusertransmission,2)+round($passeruserconfiance,2)+round($passerusercollaboration,2)+round($passeruserautonomie,2)+round($passeruserproblemsolving,2)+round($passeruserperformance,2))/(7);
                }
                $a=['poste'=>$allusers[$i]->getPoste(),'prenom'=>$allusers[$i]->getPrenom(),'nom'=>$allusers[$i]->getNom(),'telephone'=>$allusers[$i]->getTelephone(),'id'=>$allusers[$i]->getId(),'username'=>$allusers[$i]->getUsername(),'general'=>round($totalactuel,2),'progression'=>round(round($totalactuel,2)-round($totalpasser,2),2)];
                array_push($data,$a);
            }
            $dataa = $serializer->serialize($data, 'json');
            return new Response($dataa, 200, [
                'Content-Type' => 'application/json'
            ]);
            
        }
        /**
         * @Route("/datateam")
         */
        public function datateam(Request $request,UserTeamRepository $userTeamRepository,TeamRepository $teamRepository){
            $data = json_decode($request->getContent(),true);
            if(!$data){
                $data=$request->request->all();
            }
            $id=$data['id'];
            $mois=date('m');
            //$mois="05";
            $moispasser=(int)$mois;
            $moispasser--;
            $moispasser=(string)$moispasser;
            $userteam=$userTeamRepository->findBy(['team'=>$id]);
            $actueluserperseverance=0;
            $actueluserconfiance=0;
            $actuelusercollaboration=0;
            $actueluserautonomie=0;
            $actueluserproblemsolving=0;
            $actuelusertransmission=0;
            $actueluserperformance=0;
            
            $passeruserperseverance=0;
            $passeruserconfiance=0;
            $passerusercollaboration=0;
            $passeruserautonomie=0;
            $passeruserproblemsolving=0;
            $passerusertransmission=0;
            $passeruserperformance=0;

            for ($i=0; $i < count($userteam); $i++) {
                if ($userteam[$i]->getUser()->getStatut()=="actif") {
                    $dataactuel=$this->userdatamois($userteam[$i]->getUser()->getId(),$mois,2020);
                    $datapasser=$this->userdatamois($userteam[$i]->getUser()->getId(),$moispasser,2020);
                    $actueluserperseverance=$actueluserperseverance+$dataactuel['moyenneuserperseverance'];
                    $actueluserconfiance=$actueluserconfiance+$dataactuel['moyenneuserconfiance'];
                    $actuelusercollaboration=$actuelusercollaboration+$dataactuel['moyenneusercollaboration'];
                    $actueluserautonomie=$actueluserautonomie+$dataactuel['moyenneuserautonomie'];
                    $actueluserproblemsolving=$actueluserproblemsolving+$dataactuel['moyenneuserproblemsolving'];
                    $actuelusertransmission=$actuelusertransmission+$dataactuel['moyenneusertransmission'];
                    $actueluserperformance=$actueluserperformance+$dataactuel['moyenneuserperformance'];
                    
                    $passeruserperseverance=$passeruserperseverance+$datapasser['moyenneuserperseverance'];
                    $passeruserconfiance=$passeruserconfiance+$datapasser['moyenneuserconfiance'];
                    $passerusercollaboration=$passerusercollaboration+$datapasser['moyenneusercollaboration'];
                    $passeruserautonomie=$passeruserautonomie+$datapasser['moyenneuserautonomie'];
                    $passeruserproblemsolving=$passeruserproblemsolving+$datapasser['moyenneuserproblemsolving'];
                    $passerusertransmission=$passerusertransmission+$datapasser['moyenneusertransmission'];
                    $passeruserperformance=$passeruserperformance+$datapasser['moyenneuserperformance'];
                }
                
            }
            $actuelgeneal=(((($actueluserperseverance*100)/(count($userteam)*5))+(($actueluserconfiance*100)/(count($userteam)*5))+
            (($actuelusercollaboration*100)/(count($userteam)*5))+(($actueluserautonomie*100)/(count($userteam)*5))+
            (($actueluserproblemsolving*100)/(count($userteam)*5))+(($actuelusertransmission*100)/(count($userteam)*5))+
            (($actueluserperformance*100)/(count($userteam)*5))
                )/7);
            $passergeneral=(((($actueluserperseverance*100)/(count($userteam)*5))-(($passeruserperseverance*100)/(count($userteam)*5))+
            (($actueluserconfiance*100)/(count($userteam)*5))-(($passeruserconfiance*100)/(count($userteam)*5))+
            (($actuelusercollaboration*100)/(count($userteam)*5))-(($passerusercollaboration*100)/(count($userteam)*5))+
            (($actueluserautonomie*100)/(count($userteam)*5))-(($passeruserautonomie*100)/(count($userteam)*5))+
            (($actueluserproblemsolving*100)/(count($userteam)*5))-(($passeruserproblemsolving*100)/(count($userteam)*5))+
            (($actuelusertransmission*100)/(count($userteam)*5))-(($passerusertransmission*100)/(count($userteam)*5))+
            (($actueluserperformance*100)/(count($userteam)*5))-(($passeruserperformance*100)/(count($userteam)*5))
            )/7);
           return $this->json([
            'actuelperseverance'=>(($actueluserperseverance*100)/(count($userteam)*5)),
            'actuelconfiance'=>(($actueluserconfiance*100)/(count($userteam)*5)),
            'actuelcollaboration'=>(($actuelusercollaboration*100)/(count($userteam)*5)),
            'actuelautonomie'=>(($actueluserautonomie*100)/(count($userteam)*5)),
            'actuelproblemsolving'=>(($actueluserproblemsolving*100)/(count($userteam)*5)),
            'actueltransmission'=>(($actuelusertransmission*100)/(count($userteam)*5)),
            'actuelperformance'=>(($actueluserperformance*100)/(count($userteam)*5)),
            'actuelgeneral'=>$actuelgeneal,
            'passerperseverance'=>(($actueluserperseverance*100)/(count($userteam)*5))-(($passeruserperseverance*100)/(count($userteam)*5)),
            'passerconfiance'=>(($actueluserconfiance*100)/(count($userteam)*5))-(($passeruserconfiance*100)/(count($userteam)*5)),
            'passercollaboration'=>(($actuelusercollaboration*100)/(count($userteam)*5))-(($passerusercollaboration*100)/(count($userteam)*5)),
            'passerautonomie'=>(($actueluserautonomie*100)/(count($userteam)*5))-(($passeruserautonomie*100)/(count($userteam)*5)),
            'passerproblemsolving'=>(($actueluserproblemsolving*100)/(count($userteam)*5))-(($passeruserproblemsolving*100)/(count($userteam)*5)),
            'passertransmission'=>(($actuelusertransmission*100)/(count($userteam)*5))-(($passerusertransmission*100)/(count($userteam)*5)),
            'passerperformance'=>(($actueluserperformance*100)/(count($userteam)*5))-(($passeruserperformance*100)/(count($userteam)*5)),
            'passergeneral'=>$passergeneral,
        ]);
        }

         /**
         * @Route("/searchdatateam")
         */
        public function searchdatateam(Request $request,UserTeamRepository $userTeamRepository,TeamRepository $teamRepository){
            $data = json_decode($request->getContent(),true);
            if(!$data){
                $data=$request->request->all();
            }
            $id=$data['id'];
            $mois=$data['mois'];
            //$mois="05";
            $moispasser=(int)$mois;
            $moispasser--;
            $moispasser=(string)$moispasser;
            $userteam=$userTeamRepository->findBy(['team'=>$id]);
            $actueluserperseverance=0;
            $actueluserconfiance=0;
            $actuelusercollaboration=0;
            $actueluserautonomie=0;
            $actueluserproblemsolving=0;
            $actuelusertransmission=0;
            $actueluserperformance=0;
            
            $passeruserperseverance=0;
            $passeruserconfiance=0;
            $passerusercollaboration=0;
            $passeruserautonomie=0;
            $passeruserproblemsolving=0;
            $passerusertransmission=0;
            $passeruserperformance=0;

            for ($i=0; $i < count($userteam); $i++) {
                if ($userteam[$i]->getUser()->getStatut()=="actif") {
                    $dataactuel=$this->userdatamois($userteam[$i]->getUser()->getId(),$mois,2020);
                    $datapasser=$this->userdatamois($userteam[$i]->getUser()->getId(),$moispasser,2020);
                    $actueluserperseverance=$actueluserperseverance+$dataactuel['moyenneuserperseverance'];
                    $actueluserconfiance=$actueluserconfiance+$dataactuel['moyenneuserconfiance'];
                    $actuelusercollaboration=$actuelusercollaboration+$dataactuel['moyenneusercollaboration'];
                    $actueluserautonomie=$actueluserautonomie+$dataactuel['moyenneuserautonomie'];
                    $actueluserproblemsolving=$actueluserproblemsolving+$dataactuel['moyenneuserproblemsolving'];
                    $actuelusertransmission=$actuelusertransmission+$dataactuel['moyenneusertransmission'];
                    $actueluserperformance=$actueluserperformance+$dataactuel['moyenneuserperformance'];
                    
                    $passeruserperseverance=$passeruserperseverance+$datapasser['moyenneuserperseverance'];
                    $passeruserconfiance=$passeruserconfiance+$datapasser['moyenneuserconfiance'];
                    $passerusercollaboration=$passerusercollaboration+$datapasser['moyenneusercollaboration'];
                    $passeruserautonomie=$passeruserautonomie+$datapasser['moyenneuserautonomie'];
                    $passeruserproblemsolving=$passeruserproblemsolving+$datapasser['moyenneuserproblemsolving'];
                    $passerusertransmission=$passerusertransmission+$datapasser['moyenneusertransmission'];
                    $passeruserperformance=$passeruserperformance+$datapasser['moyenneuserperformance'];
                }
                
            }
            $actuelgeneal=(((($actueluserperseverance*100)/(count($userteam)*5))+(($actueluserconfiance*100)/(count($userteam)*5))+
            (($actuelusercollaboration*100)/(count($userteam)*5))+(($actueluserautonomie*100)/(count($userteam)*5))+
            (($actueluserproblemsolving*100)/(count($userteam)*5))+(($actuelusertransmission*100)/(count($userteam)*5))+
            (($actueluserperformance*100)/(count($userteam)*5))
                )/7);
            $passergeneral=(((($actueluserperseverance*100)/(count($userteam)*5))-(($passeruserperseverance*100)/(count($userteam)*5))+
            (($actueluserconfiance*100)/(count($userteam)*5))-(($passeruserconfiance*100)/(count($userteam)*5))+
            (($actuelusercollaboration*100)/(count($userteam)*5))-(($passerusercollaboration*100)/(count($userteam)*5))+
            (($actueluserautonomie*100)/(count($userteam)*5))-(($passeruserautonomie*100)/(count($userteam)*5))+
            (($actueluserproblemsolving*100)/(count($userteam)*5))-(($passeruserproblemsolving*100)/(count($userteam)*5))+
            (($actuelusertransmission*100)/(count($userteam)*5))-(($passerusertransmission*100)/(count($userteam)*5))+
            (($actueluserperformance*100)/(count($userteam)*5))-(($passeruserperformance*100)/(count($userteam)*5))
            )/7);
           return $this->json([
            'actuelperseverance'=>(($actueluserperseverance*100)/(count($userteam)*5)),
            'actuelconfiance'=>(($actueluserconfiance*100)/(count($userteam)*5)),
            'actuelcollaboration'=>(($actuelusercollaboration*100)/(count($userteam)*5)),
            'actuelautonomie'=>(($actueluserautonomie*100)/(count($userteam)*5)),
            'actuelproblemsolving'=>(($actueluserproblemsolving*100)/(count($userteam)*5)),
            'actueltransmission'=>(($actuelusertransmission*100)/(count($userteam)*5)),
            'actuelperformance'=>(($actueluserperformance*100)/(count($userteam)*5)),
            'actuelgeneral'=>$actuelgeneal,
            'passerperseverance'=>(($actueluserperseverance*100)/(count($userteam)*5))-(($passeruserperseverance*100)/(count($userteam)*5)),
            'passerconfiance'=>(($actueluserconfiance*100)/(count($userteam)*5))-(($passeruserconfiance*100)/(count($userteam)*5)),
            'passercollaboration'=>(($actuelusercollaboration*100)/(count($userteam)*5))-(($passerusercollaboration*100)/(count($userteam)*5)),
            'passerautonomie'=>(($actueluserautonomie*100)/(count($userteam)*5))-(($passeruserautonomie*100)/(count($userteam)*5)),
            'passerproblemsolving'=>(($actueluserproblemsolving*100)/(count($userteam)*5))-(($passeruserproblemsolving*100)/(count($userteam)*5)),
            'passertransmission'=>(($actuelusertransmission*100)/(count($userteam)*5))-(($passerusertransmission*100)/(count($userteam)*5)),
            'passerperformance'=>(($actueluserperformance*100)/(count($userteam)*5))-(($passeruserperformance*100)/(count($userteam)*5)),
            'passergeneral'=>$passergeneral,
        ]);
        }
        /**
         * @Route("/sevenlastevaluationteam")
         */
        public function sevenlastevaluationteam(Request $request,UserTeamRepository $userTeamRepository,AllsessionRepository $allsessionRepository,UserRepository $userRepository){
            $reception = json_decode($request->getContent(),true);
            if(!$reception){
                $reception=$request->request->all();
            }
            $id=$reception['id'];
            $date=[];
            $moyenneactuelperseverance=[];
            $moyenneactuelconfiance=[];
            $moyenneactuelcollaboration=[];
            $moyenneactuelautonomie=[];
            $moyenneactuelproblemsolving=[];
            $moyenneactueltransmission=[];
            $moyenneactuelperformance=[];

            $moyennepasserperseverance=[];
            $moyennepasserconfiance=[];
            $moyennepassercollaboration=[];
            $moyennepasserautonomie=[];
            $moyennepasserproblemsolving=[];
            $moyennepassertransmission=[];
            $moyennepasserperformance=[];
            $lastevaluation=$allsessionRepository->sevenlastevaluation();
            $userteam=$userTeamRepository->findBy(['team'=>$id]);
            for ($i=0; $i < count($lastevaluation); $i++) {
                array_push($date,date_format($lastevaluation[$i]->getDate(),'j F'));
                $actuelperseverance=0;
                $actuelconfiance=0;
                $actuelcollaboration=0;
                $actuelautonomie=0;
                $actuelproblemsolving=0;
                $actueltransmission=0;
                $actuelperformance=0;
                for ($j=0; $j <count($userteam) ; $j++) { 
                    $a=$this->userdataday($userteam[$j]->getUser()->getId(),$lastevaluation[$i]->getDate());
                    if ($a['nbruser']==0) {
                        $actuelperseverance=0;
                        $actuelconfiance=0;
                        $actuelcollaboration=0;
                        $actuelautonomie=0;
                        $actuelproblemsolving=0;
                        $actueltransmission=0;
                        $actuelperformance=0;
                    }
                    else{
                        $actuelperseverance=$actuelperseverance+($a['userperseverance']/$a['nbruser']);
                        $actuelconfiance=$actuelconfiance+($a['userconfiance']/$a['nbruser']);
                        $actuelcollaboration=$actuelcollaboration+($a['usercollaboration']/$a['nbruser']);
                        $actuelautonomie=$actuelautonomie+($a['userautonomie']/$a['nbruser']);
                        $actuelproblemsolving=$actuelproblemsolving+($a['userproblemsolving']/$a['nbruser']);
                        $actueltransmission=$actueltransmission+($a['usertransmission']/$a['nbruser']);
                        $actuelperformance=$actuelperformance+($a['userperformance']/$a['nbruser']); 
                    }
                }
                array_push($moyenneactuelperseverance,$actuelperseverance);
                array_push($moyenneactuelconfiance,$actuelconfiance);
                array_push($moyenneactuelcollaboration,$actuelcollaboration);
                array_push($moyenneactuelautonomie,$actuelautonomie);
                array_push($moyenneactuelproblemsolving,$actuelproblemsolving);
                array_push($moyenneactueltransmission,$actueltransmission);
                array_push($moyenneactuelperformance,$actuelperformance);
            }
            return $this->json([
                'date'=>$date,
                'moyenneactuelperseverance'=>$moyenneactuelperseverance,
                'moyenneactuelconfiance'=>$moyenneactuelconfiance,
                'moyenneactuelcollaboration'=>$moyenneactuelcollaboration,
                'moyenneactuelautonomie'=>$moyenneactuelautonomie,
                'moyenneactuelproblemsolving'=>$moyenneactuelproblemsolving,
                'moyenneactueltransmission'=>$moyenneactueltransmission,
                'moyenneactuelperformance'=>$moyenneactuelperformance,
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
        if ($nbruser==0) {
            $moyenneuserperseverance=0;
            $moyenneuserconfiance=0;
            $moyenneusercollaboration=0;
            $moyenneuserautonomie=0;
            $moyenneuserproblemsolving=0;
            $moyenneusertransmission=0;
            $moyenneuserperformance=0;
        }
        else{
            $moyenneuserperseverance=(($userperseverance)/($nbruser));
            $moyenneuserconfiance=(($userconfiance)/($nbruser));
            $moyenneusercollaboration=(($usercollaboration)/($nbruser));
            $moyenneuserautonomie=(($userautonomie)/($nbruser));
            $moyenneuserproblemsolving=(($userproblemsolving)/($nbruser));
            $moyenneusertransmission=(($usertransmission)/($nbruser));
            $moyenneuserperformance=(($userperformance)/($nbruser));
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

            'moyenneuserperseverance'=>$moyenneuserperseverance,
            'moyenneuserconfiance'=>$moyenneuserconfiance,
            'moyenneusercollaboration'=>$moyenneusercollaboration,
            'moyenneuserautonomie'=>$moyenneuserautonomie,
            'moyenneuserproblemsolving'=>$moyenneuserproblemsolving,
            'moyenneusertransmission'=>$moyenneusertransmission,
            'moyenneuserperformance'=>$moyenneuserperformance,
        ];
    }
    public function userdataday($id,$days){
        $allsessionRepository=$this->getDoctrine()->getRepository(Allsession::class);
        $evalluationRepository=$this->getDoctrine()->getRepository(Evaluation::class);
        $sessionevaluation=$allsessionRepository->findOneBy(['date'=>$days]);
        $evaluation=$evalluationRepository->findBy(['evaluer'=>$id,'session'=>$sessionevaluation->getId()]);
        $userperseverance=0;
        $userconfiance=0;
        $usercollaboration=0;
        $userautonomie=0;
        $userproblemsolving=0;
        $usertransmission=0;
        $userperformance=0;
        $nbruser=0;
        for ($i=0; $i <count($evaluation) ; $i++) { 
            $userperseverance=$userperseverance+$evaluation[$i]->getPerseverance();
            $userconfiance=$userconfiance+$evaluation[$i]->getConfiance();
            $usercollaboration=$usercollaboration+$evaluation[$i]->getCollaboration();
            $userautonomie=$userautonomie+$evaluation[$i]->getAutonomie();
            $userproblemsolving=$userproblemsolving+$evaluation[$i]->getProblemsolving();
            $usertransmission=$usertransmission+$evaluation[$i]->getTransmission();
            $userperformance=$userperformance+$evaluation[$i]->getPerformance();
            $nbruser++;
        }
        return [
            'userperseverance'=>$userperseverance,
            'userconfiance'=>$userconfiance,
            'usercollaboration'=>$usercollaboration,
            'userautonomie'=>$userautonomie,
            'userproblemsolving'=>$userproblemsolving,
            'usertransmission'=>$usertransmission,
            'userperformance'=>$userperformance,
            'nbruser'=>$nbruser,
        ];
    }
}