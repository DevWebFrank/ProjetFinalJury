<?php

namespace App\Controller;

use App\Entity\LegalNotices;
use App\Form\LegalNoticesType;
use App\Repository\LegalNoticesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LegalNoticesController extends AbstractController
{
    #[Route('/admin/legal_notices', name: 'admin_legal_notices')]
    public function index(): Response
    {
        return $this->render('admin/legal_notices/index.html.twig', [
            'controller_name' => 'LegalNoticesController',
        ]);
    }

    #[Route('/admin/{title}/edit', name: 'admin_legal_notice_edit')]
    public function edit($title, LegalNoticesRepository $legalNoticesRepository, Request $request, EntityManagerInterface $em): Response
    {
        //je vais chercher la condition qui correspond au nom reçu en paramétre (dans la route)
        $legalNotice = $legalNoticesRepository->findOneBy([
            'title' => $title
        ]);

        // je crée une variable qui va me permettre de savoir si je suis en train de créer un legalNotice  ou d'en modifier une
        $isEdit = true;

        // si legalNotice est égale à null on la crée
        if (!$legalNotice) //! = different
        {
            $legalNotice = new LegalNotices();
            $legalNotice->setTitle($title);
            $isEdit = false;
        }

        $form = $this->createForm(LegalNoticesType::class, $legalNotice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isvalid()) {
            if (!$isEdit) {
                $em->persist($legalNotice);
            }

            $em->flush();

            $this->addFlash("success", "Les mentions ont bien été modifiées.");
            return $this->redirectToRoute("admin_legal_notice_edit", [
                "title" => $title
            ]);
        }

        return $this->render('admin/legal_notices/legal_notice_edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/customer/{title}/show', name: 'customer_legal_notice_show')]
    public function show($title, LegalNoticesRepository $legalNoticesRepository, Request $request, EntityManagerInterface $em): Response
    {
        //je vais chercher la condition qui correspond au nom reçu dans la route
        $legalNotice = $legalNoticesRepository->findOneBy([
            'title' => $title
        ]);

        // si condition est égale à null on redirige vers la page d'accueil
        if (!$legalNotice) //"!" = différent
        {
            return $this->redirectToRoute("home");
        }

        return $this->render('customer/legalNotices/document.html.twig', [
            'legalNotice' => $legalNotice,
        ]);
    }

    #[Route('/customer/{title}/planDuSite',  name: 'customer_legalNotices_planDuSite')]
    public function planDeSite($title, LegalNoticesRepository $legalNoticesRepository, Request $request, EntityManagerInterface $em): Response
    {
        $legalNotice = $legalNoticesRepository->findOneBy([
            'title' => $title
        ]);

        if (!$legalNotice) //"!" = différent
        {
            return $this->redirectToRoute("home");
        }

        return $this->render('customer/legalNotices/planDuSite.html.twig', [
            'legalNotice' => $legalNotice,
        ]);
    }
}
