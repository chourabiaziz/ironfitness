<?php

namespace App\Controller;

use App\Form\InscriptionType;
use phpDocumentor\Reflection\PseudoTypes\True_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Utilisateur;

use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use App\Repository\UtilisateurRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Security\AppCustomAuthenticator;

class UtilisateurController extends AbstractController
{
    
    
   
   
///////////////////////////////////Affichage //////////////////////////////////////////////////////////////

#[Route('/listUti', name: 'list_uti')]
public function listUtilisateur(UtilisateurRepository $utilisateurrepository): Response
{

    return $this->render('utilisateur/listUtilisateur.html.twig', [
        'utilisateur' => $utilisateurrepository->findAll(),
    ]);
}

///////Modification////////////////////////////////////////////////////////////////////////////////////////

#[Route('/utilisateur/edit/{id}', name: 'utilisateur_edit')]
public function editUti(Request $request, ManagerRegistry $manager, $id, UtilisateurRepository $utilisateurrepository): Response
{
    $em = $manager->getManager();

    $utilisateur = $utilisateurrepository->find($id);
    $form = $this->createForm(InscriptionType::class, $utilisateur);
    $form->handleRequest($request);

    if ($form->isSubmitted()) {
        $em->persist($utilisateur);
        $em->flush();
        return $this->redirectToRoute('list_uti');
    }

    return $this->renderForm('utilisateur/edituti.html.twig', [
        'utilisateur' => $utilisateur,
        'form' => $form,
    ]);
}
//////////////////////////////////////////Suppression////////////////////////////////////////////////
#[Route('/utilisateur/delete/{id}', name: 'utilisateur_delete')]
public function deleteBook( $id, ManagerRegistry $manager,  UtilisateurRepository $utilisateurrepository): Response
{
    $em = $manager->getManager();
    $utilisateur = $utilisateurrepository->find($id);

    $em->remove($utilisateur);
    $em->flush();

    return $this->redirectToRoute('list_uti');
}
}
