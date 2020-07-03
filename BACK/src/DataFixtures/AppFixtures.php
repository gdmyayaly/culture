<?php

namespace App\DataFixtures;

use App\Entity\Team;
use App\Entity\User;
use App\Entity\Poste;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $listteam=["Team Business","grow academy","Team Créa","Team Tech&Digital"];
        
        for ($i=0; $i < count($listteam); $i++) { 
            $team= new Team();
            $team->setNom($listteam[$i]);
            $team->setImage("business.png");
            $team->setImage("academy.png");
            $team->setImage("crea.png");
            $team->setImage("tech.png");
            $manager->persist($team);
        }
        $user= new User();
        $user->setPrenom("Babacar");
        $user->setNom("SY");
        $user->setUsername("director");
        $user->setRoles(["ROLE_ADMIN"]);
        $user->setStatut("actif");
        $user->setTelephone("0000000");
        $user->setPoste("Directeur");
        $user->setImage("director.png");
        $password = $this->encoder->encodePassword($user, 'welcome');
        $user->setPassword($password);
        $manager->persist($user);
        $listposte=["Développeur","Project Manager","Assitante Project Manager","Monteur","Cadreur","Infographe","Général Manager","Infographiste","Digital Manager"];
        for ($i=0; $i < count($listposte); $i++) { 
            $poste= new Poste();
            $poste->setNom($listposte[$i]);
            $manager->persist($poste);
        }
        $manager->flush();
    }
}
