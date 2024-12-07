<?php

namespace App\Controller;

use App\Entity\ListeRp;
use App\Form\ListeRpType;
use App\Repository\ListeRpRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/liste/rp')]
final class ListeRpController extends AbstractController
{
    #[Route(name: 'app_liste_rp_index', methods: ['GET'])]
    public function index(ListeRpRepository $listeRpRepository): Response
    {
        return $this->render('liste_rp/index.html.twig', [
            'liste_rps' => $listeRpRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_liste_rp_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $listeRp = new ListeRp();
        $form = $this->createForm(ListeRpType::class, $listeRp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($listeRp);
            $entityManager->flush();

            return $this->redirectToRoute('app_liste_rp_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('liste_rp/new.html.twig', [
            'liste_rp' => $listeRp,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_liste_rp_show', methods: ['GET'])]
    public function show(ListeRp $listeRp): Response
    {
        return $this->render('liste_rp/show.html.twig', [
            'liste_rp' => $listeRp,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_liste_rp_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ListeRp $listeRp, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ListeRpType::class, $listeRp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_liste_rp_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('liste_rp/edit.html.twig', [
            'liste_rp' => $listeRp,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_liste_rp_delete', methods: ['POST'])]
    public function delete(Request $request, ListeRp $listeRp, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$listeRp->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($listeRp);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_liste_rp_index', [], Response::HTTP_SEE_OTHER);
    }
}
