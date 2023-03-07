<?php

namespace App\Controller;

use App\Entity\Competances;
use App\Form\CompetancesType;
use App\Repository\CompetancesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/competances")
 */
class CompetancesController extends AbstractController
{
    /**
     * @Route("/", name="app_competances_index", methods={"GET"})
     */
    public function index(CompetancesRepository $competancesRepository): Response
    {
        return $this->render('admin/competances/index.html.twig', [
            'competances' => $competancesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_competances_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CompetancesRepository $competancesRepository): Response
    {
        $competance = new Competances();
        $form = $this->createForm(CompetancesType::class, $competance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $competancesRepository->add($competance, true);

            return $this->redirectToRoute('app_competances_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/competances/new.html.twig', [
            'competance' => $competance,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_competances_show", methods={"GET"})
     */
    public function show(Competances $competance): Response
    {
        return $this->render('admin/competances/show.html.twig', [
            'competance' => $competance,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_competances_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Competances $competance, CompetancesRepository $competancesRepository): Response
    {
        $form = $this->createForm(CompetancesType::class, $competance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $competancesRepository->add($competance, true);

            return $this->redirectToRoute('app_competances_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/competances/edit.html.twig', [
            'competance' => $competance,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_competances_delete", methods={"POST"})
     */
    public function delete(Request $request, Competances $competance, CompetancesRepository $competancesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$competance->getId(), $request->request->get('_token'))) {
            $competancesRepository->remove($competance, true);
        }

        return $this->redirectToRoute('app_competances_index', [], Response::HTTP_SEE_OTHER);
    }
}
