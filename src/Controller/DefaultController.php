<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Medecin;
use App\Entity\Patient;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class DefaultController extends AbstractController
{

    /**
     * @Route("/test", name="default")
     */
    public function test(\Doctrine\ORM\EntityManagerInterface $em, UserPasswordEncoderInterface $pw)
    {
    	$patient = new Patient();
    	$patient->setEmail('test@patient.com');
        $patient->setPassword($pw->encodePassword(
             $patient,
             'test'));
    	$patient->setRoles(['ROLE_USER']);
    	$patient->setName('Mr Patient');

    	$medecin = new Medecin();
    	$medecin->setEmail('test@medecin.com');
    	$medecin->setPassword($pw->encodePassword(
             $medecin,
             'test'));
    	$medecin->setRoles(['ROLE_USER']);
    	$medecin->setName('Mr Medecin');

    	$em->persist($patient);
    	$em->persist($medecin);

    	$em->flush();

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function index(\Doctrine\ORM\EntityManagerInterface $em, UserPasswordEncoderInterface $pw)
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
}
