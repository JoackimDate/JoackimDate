<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Form\AdminType;
use App\Repository\AdminRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    /**
     * @Route("/", name="login")
     */
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        if($this->getUser()!=null){
            return $this->redirectToRoute('app_tableau_de_bord');
        }
        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('login/connexion.html.twig', [
            'last_username'   =>$lastUsername,
            'error'         => $error,
        ]);
    }

    /**
     * @Route("/inscription", name="inscription2")
     */
    public function creerCompte(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher, AdminRepository $adminRepository): Response
    {
        
        $date=new \DateTime('@'.strtotime('now'));
        $admin = new Admin();
        $form = $this->createForm(AdminType::class, $admin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hashedPassword = $passwordHasher->hashPassword(
                $admin,
                $admin->getPassword()
            );
            // $admin->setRoleLibelle("client");
            $admin->setPassword($hashedPassword);
            $admin->setCreePar('Premier utilisateur');
            $admin->setCreeLe($date);
            $admin->setEnable(True);
            $admin->setRoles(["ROLE_ADMIN"]);

            $adminRepository->add($admin);
           

            return $this->redirectToRoute('login');
        }

        return $this->renderForm('login/inscription.html.twig', [
            'admin' => $admin,
            'form' => $form,
        ]);
    }

     /**
     * @Route("/deconnexion", name="deconnexion")
     */

    public function seDeconnecter(RequestStack $requestStack)
    {
        $session = $requestStack->getSession();
        $session->set('nom', null);
        $session->set('prenom', null);
        $session->set('nom_utilisateur', null);
        return $this->redirectToRoute('login');
    }

}
