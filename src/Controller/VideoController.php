<?php

namespace App\Controller;

use App\Entity\Video;
use App\Form\VideoType;
use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Model\SearchData;
use App\Form\SearchType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;

#[Route('/')]
class VideoController extends AbstractController
{
    #[Route('/', name: 'app_home', methods: ['GET'])]
    public function index(ManagerRegistry $doctrine, Request $request, VideoRepository $videoRepository, PaginatorInterface $paginator): Response
    {
        if ($this->getUser()) {
            if (!$this->getUser()->isVerified()) {
                $this->addFlash('info', 'Your email address is not verified.');
            }
        }

        //pagination
        $pagination = $paginator->paginate(
            $videoRepository->paginationQuery(),
            $request->query->get('page', 1),
            9
        );

        $search = false;

        //barre de rechercher
        $searchData = new SearchData();
        $form = $this->createForm(SearchType::class, $searchData);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // dd($searchData->query);
            $searchData->page = $request->query->getInt('page', 1);
            
            $pagination = $paginator->paginate(
                $videoRepository->findBySearch($searchData),
                $request->query->get('page', 1),
                6
            );
            $search = true;
            return $this->render('video/index.html.twig', [
                'form' => $form,
                'pagination' => $pagination,
                'search' => $search,
                'searchData' => $searchData->query,
                'videos' => $videoRepository->findBySearch($searchData)
            ]);
        }
 
        return $this->render('video/index.html.twig', [
            'form' => $form->createView(),
            'pagination' => $pagination,
            'search' => $search
            // 'form' => $form->createView(),
            // 'videos' => $videoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_video_new', methods: ['GET', 'POST'])]
    public function new(Request $request, VideoRepository $videoRepository, EntityManagerInterface $em): Response
    {
        if ($this->getUser()){
            if ($this->getUser()->isVerified() == false) {
                $this->addFlash('error', 'Vous devez confirm your email pour créer une video!');
                return $this->redirectToRoute('app_home');
            } 
        }else{
            $this->addFlash('error', 'Vous devez vous loguer pour créer une Vidéo!');
            return $this->redirectToRoute('app_login');
        }
        $video = new Video();
        $form = $this->createForm(VideoType::class, $video);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $video->setUser($this->getUser());
            $em->persist($video);
            $em->flush();
            $this->addFlash('success', 'Vidéo créée avec succes !');
            $videoRepository->save($video, true);

            return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('video/new.html.twig', [
            'video' => $video,
            'form' => $form,
        ]);
    }


    #[Route('/video/{id}', name: 'app_video_show', methods: ['GET'])]
    public function show(Video $video): Response
    {
        if($video->isPremiumVideo()){
        if ($this->getUser()) {
            if ($this->getUser()->isVerified() == false) {
                $this->addFlash('error', 'Vous devez confirmer votre email pour avoir accés aux vidéo premium');
                return $this->redirectToRoute('app_home');
            }
        } else {
            $this->addFlash('error', 'vous devez vous enregistrer pour avoir accés aux vidéo premium!');
            return $this->redirectToRoute('app_register');
        }
    }
        return $this->render('video/show.html.twig', [
            'video' => $video,
        ]);
}

    #[Route('/video/{id}/edit', name: 'app_video_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Video $video, VideoRepository $videoRepository): Response
    {
        if ($this->getUser()) {
            if ($this->getUser()->isVerified() == false) {
                $this->addFlash('error', 'Vous devez confirmer votre email pour éditer la video!');
                return $this->redirectToRoute('app_home');
            } else if ($video->getUser()->getEmail() !== $this->getUser()->getEmail()) {
                $this->addFlash('error', 'Vous devez etre utilisateur ' . $video->getUser()->getFirstname() . ' pour éditer cette Voiture !');
                return $this->redirectToRoute('app_home');
            }
        } else {
            $this->addFlash('error', 'Vous devez vous logguer poure éditer la Voiture!');
            return $this->redirectToRoute('app_login');
        }
        $form = $this->createForm(VideoType::class, $video);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $voitureRepository->save($video, true);

            return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('video/edit.html.twig', [
            'video' => $video,
            'form' => $form,
        ]);
    }

    #[Route('/video/{id}', name: 'app_video_delete', methods: ['POST'])]
    public function delete(Request $request, Video $video, VideoRepository $videoRepository): Response
    {
        if ($this->getUser()) {
            if ($this->getUser()->isVerified() == false) {
                $this->addFlash('error', 'Vous devez confirmer votre email pour supprimer la video!');
                return $this->redirectToRoute('app_home');
            }else if ($video->getUser()->getEmail() !== $this->getUser()->getEmail()) {
                $this->addFlash('error', 'Vous devez etre utilisateur ' . $video->getUser()->getFirstname() . ' pour supprimer cette video !');
                return $this->redirectToRoute('app_home');
            }
        } else {
            $this->addFlash('error', 'Vous devez vous loguer pour supprimer video!');
            return $this->redirectToRoute('app_login');
        }
        if ($this->isCsrfTokenValid('delete'.$video->getId(), $request->request->get('_token'))) {
            $videoRepository->remove($video, true);
       
        }
        $this->addFlash('info', 'vidéo supprimée avec succes');

        return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
    }
}

