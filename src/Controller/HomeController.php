<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\Query\ResultSetMapping;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function getPage()
    {

        /*
         * 229ms-267ms / 2mb-4mb
         */
        $usersRepository = $this->getDoctrine()->getRepository(User::class);
        $users = $usersRepository->findWithoutDogs();


        /*
         * 162ms / 2mb
         */
        /*$rsm = new ResultSetMapping;
        $rsm->addEntityResult('App\Entity\User', 'u');
        $rsm->addFieldResult('u', 'id', 'id');
        $rsm->addFieldResult('u', 'name', 'name');

        $query = $this->getDoctrine()->getManager()->createNativeQuery('SELECT u.id, u.name 
        FROM users u 
        WHERE NOT EXISTS (SELECT d.id FROM dogs d WHERE d.user_id = u.id)', $rsm);

        $users = $query->getResult();*/

        return $this->render('home.html.twig', [
            'users' => $users
        ]);
    }
}
