<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTEncodeFailureException;

class AuthentificationController extends AbstractController
{
    /**
     * @Route("/login")
     * @param JWTEncoderInterface $JWTEncoder
     * @throws \Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTEncodeFailureException
     */
    public function login(Request $request,UserRepository $userRepository,UserPasswordEncoderInterface $userPassword, JWTEncoderInterface $JWTEncoder){
        $reception = json_decode($request->getContent(),true);//Récupère une chaîne encodée JSON et la convertit en une variable PHP
        if(!$reception){//s il n'existe pas donc on recupere directement le tableau via la request
            $reception=$request->request->all();
        }
        
        $user= $userRepository->findOneBy(['username'=>$reception['username']]);
      //  dump($user);die();
        if ($user) {
            $validation=$userPassword->isPasswordValid($user,$reception['password']);
            if ($validation) {
                if ($user->getStatut()==NULL) {
                    $token = $JWTEncoder->encode([
                        'username' => $user->getUsername(),
                        'roles' => $user->getRoles(),
                        'Prenom' => $user->getPrenom(),
                        'exp' => time() + 3600 // 1 hour expiration
                    ]);
                    return new JsonResponse(['token' => $token]);
                }
              if ($user->getStatut()=="actif") {
                $token = $JWTEncoder->encode([
                    'username' => $user->getUsername(),
                    'roles' => $user->getRoles(),
                    'Prenom' => $user->getPrenom(),
                    'exp' => time() + 3600 // 1 hour expiration
                ]);
                return new JsonResponse(['token' => $token]);
              }
              if ($user->getStatut()=="BLOQUER") {
                return $this->json([
                    'message'=>'L administrateur du systeme vous a bloquer'
                ]);
              }
             
            }
            else {
                $retour=[
                    'message'=>'Password Invalid'
                ];
                return new JsonResponse($retour);
            }
        }
        else {
            $retour=[
                'message'=>'Username Invalid'
            ];
            return new JsonResponse($retour);
        }

    }
}
