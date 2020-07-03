<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     * @Route("usergrow", methods={"GET"})
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
}
