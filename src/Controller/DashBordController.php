<?php

namespace App\Controller;

use App\Entity\Candidature;
use App\Form\CandidatureEdit;
use App\Form\CandidatureType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CandidatureRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DashBordController extends AbstractController
{
    /**
     * @Route("/dashbord", name="dashbord")
     */
    public function index(Request $request, CandidatureRepository $candidatureRepository)
    {
        $candidatures = $candidatureRepository->findAll();
        $user = $this->getUser();
        $form = $this->createForm(CandidatureType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $candidature = $form->getData();
            $candidature->setUser($user);
            $em = $this->getDoctrine()->getManager();
            $em->persist($candidature);
            $em->flush();

            return $this->redirectToRoute('dashbord');
        }

        return $this->render('dashbord/index.html.twig', [
            'candidatureForm' => $form->createView(),
            'candidatures' => $candidatures,
        ]);
    }

    /**
     * @Route("/dashbord/{candidature}/edit", name="candidature_edit")
     */
    public function candidatureEdition(Request $request, Candidature $candidature, CandidatureRepository $candidatureRepository) 
    {
        $candidature = $candidatureRepository->find($candidature);

        $form2 = $this->createForm(CandidatureType::class, $candidature);
        $token = $request->request->get('token');
        $form2->handleRequest($request);

        // if ($this->isCsrfTokenValid('edit-candidature', $token)){

            if ($form2->isSubmitted() && $form2->isValid()) {
                $candidatureEdit = $form2->getData();
                $em = $this->getDoctrine()->getManager();
                $em->persist($candidatureEdit);
                $em->flush();

                return $this->redirectToRoute('dashbord');
                $this->addFlash('success', 'Modification prise en compte.');
            }
        // }

        return $this->render('dashbord/edit.html.twig', [
            'candidature' => $candidature,
            'CandidatureEdit' => $form2->createView(),
        ]);
    }


    /**
     * @Route("/dashbord/{candidature}/archive", name="candidature_archive")
     */
    public function candidatureArchive(Request $request, Candidature $candidature, CandidatureRepository $candidatureRepository, EntityManagerInterface $em) 
    {
        $token = $request->request->get('token');

        if ($this->isCsrfTokenValid('archive-candidature', $token)){
            $id = $request->request->get('candidature_id');
            $candidature = $candidatureRepository->find($id);
            dump($candidature);

            if ($candidature->getStatus() == 3 ) {
                $candidature->setStatus(0);
            $em->persist($candidature);
                dump($candidature);
            }
            else {
                $candidature->setStatus(3);
            }

            $em->persist($candidature);
            $em->flush();

            $this->addFlash('success', 'Modification prise en compte.');
        }

        return $this->redirectToRoute('dashbord');
    }


    /**
     * @Route("/dashbord/{candidature}/relance", name="candidature_relance")
     */
    public function candidatureRelance(Request $request, Candidature $candidature, CandidatureRepository $candidatureRepository, EntityManagerInterface $em) 
    {
        $token = $request->request->get('token');

        if ($this->isCsrfTokenValid('relance-candidature', $token)){
            $id = $request->request->get('candidature_id');
            $candidature = $candidatureRepository->find($id);

            if ($candidature->getRelance() == 0 ) {
                $candidature->setRelance(1);
            }
            elseif ($candidature->getRelance() == 1 ) {
                $candidature->setRelance(0);
            }

            $em->persist($candidature);
            $em->flush();

            $this->addFlash('success', 'Modification prise en compte.');
        }

        return $this->redirectToRoute('dashbord');
    }
}
