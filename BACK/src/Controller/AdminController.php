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
     * @Route("/detailuser")
     */
    public function detailuser(Request $request,UserRepository $userRepository,SerializerInterface $serializer){
        
        $data = json_decode($request->getContent(),true);//Récupère une chaîne encodée JSON et la convertit en une variable PHP
        if(!$data){//s il n'existe pas donc on recupere directement le tableau via la request
            $data=$request->request->all();
        }
        $user= $userRepository->find($data['id']);
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
     * @Route("/lastevaluationdumois")
     */
    public function lastevaluationdumois(Request $request,UserRepository $userRepository){
        //$data=$request->request->all();
        $data = json_decode($request->getContent(),true);//Récupère une chaîne encodée JSON et la convertit en une variable PHP
        if(!$data){//s il n'existe pas donc on recupere directement le tableau via la request
            $data=$request->request->all();
        }
       //$id=$data['id'];
        $id=403;
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
     * @Route("/datacarduser")
     */
    public function datacarduser(Request $request){
        $reception = json_decode($request->getContent(),true);
        if(!$reception){
            $reception=$request->request->all();
        }
        //$mois=date('m');
        $mois="03";
        $annee=date('Y');
        $id=$reception['id'];
        $a=$this->userdatamois($id,$mois,$annee);
        $datamoisactuel=$this->userdatamois($id,$mois,$annee);
        $moispasser=(int)$mois;
        $moispasser--;
        $moispasser=(string)$moispasser;
        $datamoispasser=$this->userdatamois($id,$moispasser,$annee);
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
        $general=((($datamoisactuel['totalnote'])*100)/($datamoisactuel['nbruser']*30));
        $moyennegeneral=(($datamoispasser['totalnote'])*100)/($datamoispasser['nbruser']*30)-(($datamoisactuel['totalnote'])*100)/($datamoisactuel['nbruser']*30);
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
            //dump($a);
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
       // die();
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
         * @Route("/performaceteam")
         */
        public function performaceteam(UserRepository $userRepository,SerializerInterface $serializer){
            $allusers=$userRepository->testreq("ROLE_COLLABORATEUR");
            $mois="03";
            //$mois=date('m');
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
                    $totalactuel=((($donneractuel['totalnote'])*100)/($donneractuel['nbruser']*30));
                }
                if ($donneractuel['nbruser']==0) {
                    $totalpasser=0;
                }
                else{
                    $totalpasser=((($donnerpasser['totalnote'])*100)/($donnerpasser['nbruser']*30));
                }
                $a=['id'=>$allusers[$i]->getId(),'username'=>$allusers[$i]->getUsername(),'general'=>round($totalactuel,2),'progression'=>round(round($totalpasser,2)-round($totalactuel,2),2)];
                array_push($data,$a);
            }
            $dataa = $serializer->serialize($data, 'json');
            return new Response($dataa, 200, [
                'Content-Type' => 'application/json'
            ]);
            
        }

    public function userdatamois($id,$mois,$annee){
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
        $allsessionRepository=$this->getDoctrine()->getRepository(Allsession::class);
        $evalluationRepository=$this->getDoctrine()->getRepository(Evalluation::class);
        $sessiondumois=$allsessionRepository->findBy(['annee'=>$annee,'mois'=>$mois]);
        if ($sessiondumois) {
            for ($i=0; $i < count($sessiondumois); $i++) { 
                $userevaluations=$evalluationRepository->findBy(['evaluer'=>$id,'session'=>$sessiondumois[$i]->getId()]);
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
                $teamevaluations=$evalluationRepository->findBy(['session'=>$sessiondumois[$i]->getId()]);
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
        $totaluser=$userperseverance+$userconfiance+$usercollaboration+$userautonomie+$userproblemsolving+$usertransmission+$userperformance;
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
    public function userdataday($id,$days,$annee){
        $allsessionRepository=$this->getDoctrine()->getRepository(Allsession::class);
        $evalluationRepository=$this->getDoctrine()->getRepository(Evalluation::class);
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
