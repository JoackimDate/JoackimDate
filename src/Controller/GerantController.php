<?php

namespace App\Controller;

use App\Entity\Gerant;
use App\Form\GerantType;
use App\Repository\GerantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * @Route("/gerant")
 */
class GerantController extends AbstractController
{
    /**
     * @Route("/", name="gerant", methods={"GET"})
     */
    public function AcceuilGerant(GerantRepository $gerantRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_GERANT', null, "Erreur d'acces 404");
        return $this->render('gerant/AcceuilGerant.html.twig', [
            'gerants' => $gerantRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="AjouterGerant", methods={"GET", "POST"})
     */
    public function AjouterGerant(Request $request, GerantRepository $gerantRepository, UserPasswordHasherInterface $passwordHasher): Response
    {
        $gerant = new Gerant();
        $date=new \DateTime('@'.strtotime('now'));
        $form = $this->createForm(GerantType::class, $gerant);
        $form->handleRequest($request);
        $user = $this-> getUser();

        $username = $user->getUserIdentifier();

        if ($form->isSubmitted() && $form->isValid()) {
            $hashedPassword = $passwordHasher->hashPassword(
                $gerant,
                $gerant->getPassword()
            );
            $gerant->setPassword($hashedPassword);
            $gerant->setCreePar($username);
            $gerant->setCreeLe($date);
            $gerant->setEnable(True);
            $gerant->setRoles(["ROLE_GERANT"]);
            $gerantRepository->add($gerant);
            return $this->redirectToRoute('gerant');
        }
      
        return $this->renderForm('gerant/AjouterGerant.html.twig', [
            'gerant' => $gerant,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_gerant_show", methods={"GET"})
     */
    public function show(Gerant $gerant): Response
    {
        return $this->render('gerant/show.html.twig', [
            'gerant' => $gerant,
        ]);
    }

    /**
     * @Route("/{id}/ModifierGerant", name="ModifierGerant", methods={"GET", "POST"})
     */
    public function ModifierGerant(Request $request, Gerant $gerant, GerantRepository $gerantRepository): Response
    {
        $form = $this->createForm(GerantType::class, $gerant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $gerantRepository->add($gerant);
            return $this->redirectToRoute('gerant');
        }

        return $this->renderForm('gerant/ModifierGerant.html.twig', [
            'gerant' => $gerant,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="SupprimerGerant", methods={"POST"})
     */
    public function SupprimerGerant(Request $request, Gerant $gerant, GerantRepository $gerantRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$gerant->getId(), $request->request->get('_token'))) {
            $gerantRepository->remove($gerant);
        }

        return $this->redirectToRoute('gerant');
    }
}
