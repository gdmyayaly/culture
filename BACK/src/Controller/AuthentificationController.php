<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AuthentificationController extends AbstractController
{

/**
     * @Route("/login")
     * @param JWTEncoderInterface $JWTEncoder
     * @throws \Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTEncodeFailureException
     */
    public function logins(Request $request,UserRepository $userRepository,UserPasswordEncoderInterface $userPassword, JWTEncoderInterface $JWTEncoder){
       // $reception= $request->request->all();
        $reception = json_decode($request->getContent(),true);
        //return $this->json(['username'=>$reception['username']]);
        $user= $userRepository->findOneBy(['username'=>$reception['username']]);
        if ($user) {
            $validation=$userPassword->isPasswordValid($user,$reception['password']);
            
            if ($validation) {
                if ($user->getStatut()!=NULL) {
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
                    'Message'=>'L administrateur du systeme vous a bloquer'
                ]);
              }
             
            }
            else {
                $retour=[
                    'Alert'=>'Password Invalid'
                ];
                return new JsonResponse($retour);
            }
        }
        else {
            $retour=[
                'Alert'=>'Username Invalid'
            ];
            return new JsonResponse($retour);
        }

    }
}
