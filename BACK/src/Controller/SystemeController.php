<?php

namespace App\Controller;

use DateTime;
use App\Entity\Allsession;
use App\Entity\Blog;
use App\Entity\Evaluation;
use App\Repository\UserRepository;
use App\Repository\AllsessionRepository;
use App\Repository\BlogRepository;
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
    private $mois;
    private $moispasser;

    private $user_days_perseverance;
    private $user_days_confiance;
    private $user_days_collaboration;
    private $user_days_autonomie;
    private $user_days_problemsolving;
    private $user_days_tatransmission;
    private $user_days_performance;

    private $team_days_perseverance;
    private $team_days_confiance;
    private $team_days_collaboration;
    private $team_days_autonomie;
    private $team_days_problemsolving;
    private $team_days_tatransmission;
    private $team_days_performance;

    private $user_mois_perseverance;
    private $user_mois_confiance;
    private $user_mois_collaboration;
    private $user_mois_autonomie;
    private $user_mois_problemsolving;
    private $user_mois_tatransmission;
    private $user_mois_performance;

    private $team_mois_perseverance;
    private $team_mois_confiance;
    private $team_mois_collaboration;
    private $team_mois_autonomie;
    private $team_mois_problemsolving;
    private $team_mois_tatransmission;
    private $team_mois_performance;

    public function __construct()
    {
        $this->mois=date('m');
        //$this->mois="04";
        $moispasser=(int)$this->mois;
        $moispasser--;
        $moispasser=(string)$moispasser;
        $this->moispasser=$moispasser;
    }


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
       // $mois=date('m');
        //$mois="03";
        $annee=date('Y');
        $id=$reception['id'];
        $a=$this->userdatamois($id,$this->mois,$annee);
        $datamoisactuel=$this->userdatamois($id,$this->mois,$annee);
        // $moispasser=(int)$mois;
        // $moispasser--;
        // $moispasser=(string)$moispasser;
        $datamoispasser=$this->userdatamois($id,$this->moispasser,$annee);
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
            // $mois=date('m');
            // $moispasser=(int)$mois;
            // $moispasser--;
            // $moispasser=(string)$moispasser;
            $data=[];
            for ($i=0; $i <count($allusers) ; $i++) { 
                $totalactuel=0;
                $totalpasser=0;
                $donneractuel=$this->userdatamois($allusers[$i]->getId(),$this->mois,2020);
                $donnerpasser=$this->userdatamois($allusers[$i]->getId(),$this->moispasser,2020);
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
            //On récupere l'id du team
            $id=$data['id'];
            //On récupere le mois actuel
            // $mois=date('m');
            // //$mois="03";
            // $moispasser=(int)$mois;
            // $moispasser--;
            // //On truve le mois passer
            // $moispasser=(string)$moispasser;
            //On récupere la liste des utilisateur appartenant à cette team
            $userteam=$userTeamRepository->findBy(['team'=>$id]);
            //Initialisation des variable qui vont capture la moyenne des utilisateur suivant une session
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
            $nb=0;
            //On parcour pour chaque utilisateur
            for ($i=0; $i < count($userteam); $i++) {
                //On verifie bien si l'utilisateur est bien actif
                if ($userteam[$i]->getUser()->getStatut()=="actif") {
                    $nb++;
                    $dataactuel=$this->userdatamois($userteam[$i]->getUser()->getId(),$this->mois,2020);
                  //  dump($dataactuel);
                    $datapasser=$this->userdatamois($userteam[$i]->getUser()->getId(),$this->moispasser,2020);
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
            $actuelgeneal=(((($actueluserperseverance*100)/($nb*5))+(($actueluserconfiance*100)/($nb*5))+
            (($actuelusercollaboration*100)/($nb*5))+(($actueluserautonomie*100)/($nb*5))+
            (($actueluserproblemsolving*100)/($nb*5))+(($actuelusertransmission*100)/($nb*5))+
            (($actueluserperformance*100)/($nb*5))
                )/7);
            $passergeneral=(((($actueluserperseverance*100)/($nb*5))-(($passeruserperseverance*100)/($nb*5))+
            (($actueluserconfiance*100)/($nb*5))-(($passeruserconfiance*100)/($nb*5))+
            (($actuelusercollaboration*100)/($nb*5))-(($passerusercollaboration*100)/($nb*5))+
            (($actueluserautonomie*100)/($nb*5))-(($passeruserautonomie*100)/($nb*5))+
            (($actueluserproblemsolving*100)/($nb*5))-(($passeruserproblemsolving*100)/($nb*5))+
            (($actuelusertransmission*100)/($nb*5))-(($passerusertransmission*100)/($nb*5))+
            (($actueluserperformance*100)/($nb*5))-(($passeruserperformance*100)/($nb*5))
            )/7);

            $datamoisactuel=$this->userdatamois(403,$this->mois,2020);
            $datamoispasser=$this->userdatamois(403,$this->moispasser,2020);
            if ($datamoisactuel['nbruser']==0) {
                $teamperseverance=0;
                $teamconfiance=0;
                $teamcollaboration=0;
                $teamautonomie=0;
                $teamproblemsolving=0;
                $teamtransmission=0;
                $teamperformance=0;
            }
            else{
                $teamperseverance=($datamoisactuel['teamperseverance']*100)/($datamoisactuel['nbrteam']*5);
                $teamconfiance=($datamoisactuel['teamconfiance']*100)/($datamoisactuel['nbrteam']*5);
                $teamcollaboration=($datamoisactuel['teamcollaboration']*100)/($datamoisactuel['nbrteam']*5);
                $teamautonomie=($datamoisactuel['teamautonomie']*100)/($datamoisactuel['nbrteam']*5);
                $teamproblemsolving=($datamoisactuel['teamproblemsolving']*100)/($datamoisactuel['nbrteam']*5);
                $teamtransmission=($datamoisactuel['teamtransmission']*100)/($datamoisactuel['nbrteam']*5);
                $teamperformance=($datamoisactuel['teamperformance']*100)/($datamoisactuel['nbrteam']*5);
            }
            if ($datamoispasser['nbruser']==0) {
                $passerteamperseverance=0;
                $passerteamconfiance=0;
                $passerteamcollaboration=0;
                $passerteamautonomie=0;
                $passerteamproblemsolving=0;
                $passerteamtransmission=0;
                $passerteamperformance=0;
            }
            else{
                $passerteamperseverance=($datamoispasser['teamperseverance']*100)/($datamoispasser['nbrteam']*5);
                $passerteamconfiance=($datamoispasser['teamconfiance']*100)/($datamoispasser['nbrteam']*5);
                $passerteamcollaboration=($datamoispasser['teamcollaboration']*100)/($datamoispasser['nbrteam']*5);
                $passerteamautonomie=($datamoispasser['teamautonomie']*100)/($datamoispasser['nbrteam']*5);
                $passerteamproblemsolving=($datamoispasser['teamproblemsolving']*100)/($datamoispasser['nbrteam']*5);
                $passerteamtransmission=($datamoispasser['teamtransmission']*100)/($datamoispasser['nbrteam']*5);
                $passerteamperformance=($datamoispasser['teamperformance']*100)/($datamoispasser['nbrteam']*5);
            }

            $moyenneteamperseverance=$teamperseverance-$passerteamperseverance;
            $moyenneteamconfiance=$teamconfiance-$passerteamconfiance;
            $moyenneteamcollaboration=$teamcollaboration-$passerteamcollaboration;
            $moyenneteamautonomie=$teamautonomie-$passerteamautonomie;
            $moyenneteamproblemsolving=$teamproblemsolving-$passerteamproblemsolving;
            $moyenneteamtransmission=$teamtransmission-$passerteamtransmission;
            $moyenneteamperformance=$teamperformance-$passerteamperformance;
    
           return $this->json([
            'actuelperseverance'=>(($actueluserperseverance*100)/($nb*5)),
            'actuelconfiance'=>(($actueluserconfiance*100)/($nb*5)),
            'actuelcollaboration'=>(($actuelusercollaboration*100)/($nb*5)),
            'actuelautonomie'=>(($actueluserautonomie*100)/($nb*5)),
            'actuelproblemsolving'=>(($actueluserproblemsolving*100)/($nb*5)),
            'actueltransmission'=>(($actuelusertransmission*100)/($nb*5)),
            'actuelperformance'=>(($actueluserperformance*100)/($nb*5)),
            'actuelgeneral'=>$actuelgeneal,
            'passerperseverance'=>(($actueluserperseverance*100)/($nb*5))-(($passeruserperseverance*100)/($nb*5)),
            'passerconfiance'=>(($actueluserconfiance*100)/($nb*5))-(($passeruserconfiance*100)/($nb*5)),
            'passercollaboration'=>(($actuelusercollaboration*100)/($nb*5))-(($passerusercollaboration*100)/($nb*5)),
            'passerautonomie'=>(($actueluserautonomie*100)/($nb*5))-(($passeruserautonomie*100)/($nb*5)),
            'passerproblemsolving'=>(($actueluserproblemsolving*100)/($nb*5))-(($passeruserproblemsolving*100)/($nb*5)),
            'passertransmission'=>(($actuelusertransmission*100)/($nb*5))-(($passerusertransmission*100)/($nb*5)),
            'passerperformance'=>(($actueluserperformance*100)/($nb*5))-(($passeruserperformance*100)/($nb*5)),
            'passergeneral'=>$passergeneral,

            'teamperseverance'=>round($teamperseverance,2),
            'teamconfiance'=>round($teamconfiance,2),
            'teamcollaboration'=>round($teamcollaboration,2),
            'teamautonomie'=>round($teamautonomie,2),
            'teamproblemsolving'=>round($teamproblemsolving,2),
            'teamtransmission'=>round($teamtransmission,2),
            'teamperformance'=>round($teamperformance,2),
            'moyenneteamperseverance'=>round($moyenneteamperseverance,2),
            'moyenneteamconfiance'=>round($moyenneteamconfiance,2),
            'moyenneteamcollaboration'=>round($moyenneteamcollaboration,2),
            'moyenneteamautonomie'=>round($moyenneteamautonomie,2),
            'moyenneteamproblemsolving'=>round($moyenneteamproblemsolving,2),
            'moyenneteamtransmission'=>round($moyenneteamtransmission,2),
            'moyenneteamperformance'=>round($moyenneteamperformance,2),
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
            // $mois=$data['mois'];
            // //$mois="05";
            // $moispasser=(int)$mois;
            // $moispasser--;
            // $moispasser=(string)$moispasser;
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
            $nb=0;
            for ($i=0; $i < count($userteam); $i++) {
                if ($userteam[$i]->getUser()->getStatut()=="actif") {
                    $nb++;
                    $dataactuel=$this->userdatamois($userteam[$i]->getUser()->getId(),$this->mois,2020);
                    $datapasser=$this->userdatamois($userteam[$i]->getUser()->getId(),$this->moispasser,2020);
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
                'actuelperseverance'=>(($actueluserperseverance*100)/($nb*5)),
                'actuelconfiance'=>(($actueluserconfiance*100)/($nb*5)),
                'actuelcollaboration'=>(($actuelusercollaboration*100)/($nb*5)),
                'actuelautonomie'=>(($actueluserautonomie*100)/($nb*5)),
                'actuelproblemsolving'=>(($actueluserproblemsolving*100)/($nb*5)),
                'actueltransmission'=>(($actuelusertransmission*100)/($nb*5)),
                'actuelperformance'=>(($actueluserperformance*100)/($nb*5)),
                'actuelgeneral'=>$actuelgeneal,
                'passerperseverance'=>(($actueluserperseverance*100)/($nb*5))-(($passeruserperseverance*100)/($nb*5)),
                'passerconfiance'=>(($actueluserconfiance*100)/($nb*5))-(($passeruserconfiance*100)/($nb*5)),
                'passercollaboration'=>(($actuelusercollaboration*100)/($nb*5))-(($passerusercollaboration*100)/($nb*5)),
                'passerautonomie'=>(($actueluserautonomie*100)/($nb*5))-(($passeruserautonomie*100)/($nb*5)),
                'passerproblemsolving'=>(($actueluserproblemsolving*100)/($nb*5))-(($passeruserproblemsolving*100)/($nb*5)),
                'passertransmission'=>(($actuelusertransmission*100)/($nb*5))-(($passerusertransmission*100)/($nb*5)),
                'passerperformance'=>(($actueluserperformance*100)/($nb*5))-(($passeruserperformance*100)/($nb*5)),
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
            //recuperation des 7 derniere sesion devaluation
            $lastevaluation=$allsessionRepository->sevenlastevaluation();
            //recuperer la la liste des utilisateur appartenant a cet team
            $userteam=$userTeamRepository->findBy(['team'=>$id]);
            //On parcour les 7 last evaluation
            for ($i=0; $i < count($lastevaluation); $i++) {
                array_push($date,date_format($lastevaluation[$i]->getDate(),'j F'));
                $actuelperseverance=0;
                $actuelconfiance=0;
                $actuelcollaboration=0;
                $actuelautonomie=0;
                $actuelproblemsolving=0;
                $actueltransmission=0;
                $actuelperformance=0;
                for ($j=0; $j <count($userteam) ; $j++) { //yaya & mbacke
                    $a=$this->userdataday($userteam[$j]->getUser()->getId(),$lastevaluation[$i]->getDate());
                   // dump($a);
                    if ($a['nbruser']==0) {
                        $actuelperseverance=$actuelperseverance+0;
                        $actuelconfiance=$actuelconfiance+0;
                        $actuelcollaboration=$actuelcollaboration+0;
                        $actuelautonomie=$actuelautonomie+0;
                        $actuelproblemsolving=$actuelproblemsolving+0;
                        $actueltransmission=$actueltransmission+0;
                        $actuelperformance=$actuelperformance+0;
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
                array_push($moyenneactuelperseverance,($actuelperseverance/count($userteam)));
                array_push($moyenneactuelconfiance,($actuelconfiance/count($userteam)));
                array_push($moyenneactuelcollaboration,($actuelcollaboration/count($userteam)));
                array_push($moyenneactuelautonomie,($actuelautonomie/count($userteam)));
                array_push($moyenneactuelproblemsolving,($actuelproblemsolving/count($userteam)));
                array_push($moyenneactueltransmission,($actueltransmission/count($userteam)));
                array_push($moyenneactuelperformance,($actuelperformance/count($userteam)));
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
                'perseverance'=>$moyenneactuelperseverance,
                'confiance'=>$moyenneactuelconfiance,
                'collaboration'=>$moyenneactuelcollaboration,
                'autonomie'=>$moyenneactuelautonomie,
                'problemsolving'=>$moyenneactuelproblemsolving,
                'transmission'=>$moyenneactueltransmission,
                'performance'=>$moyenneactuelperformance,

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
     * @Route("/performaceallteamcompare")
     */
    public function performaceallteamcompare(SerializerInterface $serializer,UserTeamRepository $userTeamRepository,AllsessionRepository $allsessionRepository,UserRepository $userRepository,TeamRepository $teamRepository){
        $allteam=$teamRepository->findAll();
        $datateam=[];
        $datanow=[];
        $datapast=[];
        for ($i=0; $i < count($allteam); $i++) { 
            array_push($datateam,$allteam[$i]->getNom());
            $userteam=$userTeamRepository->findBy(['team'=>$allteam[$i]->getId()]);
            //Initialisation des variable qui vont capture la moyenne des utilisateur suivant une session
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
            $nb=0;
            //On parcour pour chaque utilisateur
            for ($j=0; $j < count($userteam); $j++) {
                //dump($userteam[$j]->getUser()->getPrenom());
                //On verifie bien si l'utilisateur est bien actif
                if ($userteam[$j]->getUser()->getStatut()=="actif") {
                    $nb++;
                    $dataactuel=$this->userdatamois($userteam[$j]->getUser()->getId(),$this->mois,2020);
                  //  dump($dataactuel);
                    $datapasser=$this->userdatamois($userteam[$j]->getUser()->getId(),$this->moispasser,2020);
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
            if ($nb==0) {
                $actuelgeneal=0;
                $passergeneral=0;
            }
            else{
                $actuelgeneal=(((($actueluserperseverance*100)/($nb*5))+(($actueluserconfiance*100)/($nb*5))+
                (($actuelusercollaboration*100)/($nb*5))+(($actueluserautonomie*100)/($nb*5))+
                (($actueluserproblemsolving*100)/($nb*5))+(($actuelusertransmission*100)/($nb*5))+
                (($actueluserperformance*100)/($nb*5))
                    )/7);
                $passergeneral=(((($actueluserperseverance*100)/($nb*5))-(($passeruserperseverance*100)/($nb*5))+
                (($actueluserconfiance*100)/($nb*5))-(($passeruserconfiance*100)/($nb*5))+
                (($actuelusercollaboration*100)/($nb*5))-(($passerusercollaboration*100)/($nb*5))+
                (($actueluserautonomie*100)/($nb*5))-(($passeruserautonomie*100)/($nb*5))+
                (($actueluserproblemsolving*100)/($nb*5))-(($passeruserproblemsolving*100)/($nb*5))+
                (($actuelusertransmission*100)/($nb*5))-(($passerusertransmission*100)/($nb*5))+
                (($actueluserperformance*100)/($nb*5))-(($passeruserperformance*100)/($nb*5))
                )/7);
            }

            $alpha=['id'=>$allteam[$i]->getId(),'nom'=>$allteam[$i]->getNom(),'general'=>$actuelgeneal,'progression'=>$passergeneral];
            array_push($datanow,$alpha);
        }
            $dataa = $serializer->serialize($datanow, 'json');
            return new Response($dataa, 200, [
                'Content-Type' => 'application/json'
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
    /**
     * @Route("/createblog", methods={"POST"})
     */
    public function createblog(Request $request,EntityManagerInterface $entityManagerInterface){
        $reception = json_decode($request->getContent(),true);
        if(!$reception){
            $reception=$request->request->all();
        }
        $blog= new Blog();
        $blog->setDate(new DateTime());
        $blog->setTitre($reception['titre']);
        if ($requestFile=$request->files->all()) {
            $file = $requestFile['image'];
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->getParameter('chemin'), $fileName);
            $blog->setImage($fileName);
        }
        $blog->setText($reception['description']);
        $entityManagerInterface->persist($blog);
        $entityManagerInterface->flush();
        return $this->json(
            [
                'message'=>'parfait',
                'statut'=>201
            ]
            );
    }
        /**
     * @Route("/listblog", methods={"POST"})
     */
    public function listblog(BlogRepository $blogRepository,SerializerInterface $serializer){
        $user=$blogRepository->findAll();
            $data = $serializer->serialize($user, 'json');
            return new Response($data, 200, [
                'Content-Type' => 'application/json'
            ]);
    }

            /**
     * @Route("/createsession", methods={"POST"})
     */
    public function createsession(Request $request,EntityManagerInterface $entityManagerInterface){
        $reception = json_decode($request->getContent(),true);
        if(!$reception){
            $reception=$request->request->all();
        }
        $session= new Allsession();
        $dd=new DateTime($reception['date']);
        $session->setConcerner($reception['concerner']);
        $session->setDate($dd);
        $session->setTeams($reception['team']);
        $session->setNombre(10);
        $session->setMois($reception['date'][5].$reception['date'][6]);
        $session->setAnnee($reception['date'][0].$reception['date'][1].$reception['date'][2].$reception['date'][3]);
        $entityManagerInterface->persist($session);
        $entityManagerInterface->flush();
        return $this->json(
            [
                'message'=>'parfait',
                'statut'=>201
            ]
            );
    }
            /**
     * @Route("/listsession", methods={"POST"})
     */
    public function listsession(AllsessionRepository $allsessionRepository,SerializerInterface $serializer){
        $user=$allsessionRepository->findAll();
            $data = $serializer->serialize($user, 'json', [
                'groups' => ['grow']
            ]);
            return new Response($data, 200, [
                'Content-Type' => 'application/json'
            ]);
    }
}
