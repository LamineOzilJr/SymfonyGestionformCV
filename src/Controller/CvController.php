<?php

namespace App\Controller;

use App\Repository\CvRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Cv;
use App\Form\CvType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CvController extends AbstractController
{
    #[route('/Cv/liste', name: 'cv_liste')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $em= $doctrine->getManager();
       
        $c = new Cv();
        
        $form = $this->createForm(CvType::class, $c, 
                                                array('action' => $this->generateUrl('cv_add'))
                                            );
        $data['form'] = $form->createView();
        
        $data['cvs'] = $em->getRepository(Cv::class)->findAll();
        return $this->render('cv/liste.html.twig', $data);
    }

    #[route('/Cv/edit/{id}', name: 'cv_edit')]
    public function getcv($id): Response
    {
        return $this->render('cv/liste.html.twig');
    }

    #[route('/Cv/add', name: 'cv_add')]
    public function add(ManagerRegistry $doctrine, Request $request ): Response
    {
        $c = new Cv();
        $form = $this->createForm(CvType::class, $c);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $c= $form->getData();
            $em = $doctrine->getManager();
            $em->persist($c);
            $em->flush();

            
        }
     
        return $this->redirectToRoute('cv_liste');
    }

    #[route('/Cv/delete/{id}', name: 'cv_delete')]
    public function delete($id, ManagerRegistry $doctrine)
    {
        $em = $doctrine->getManager();
        $cv = $em->getRepository(Cv::class)->find($id);
        if ($cv != null) {
            $em->remove($cv);
            $em->flush();
        }
        return $this->redirectToRoute('cv_liste');
       

    }

    #[route('/Cv/edit/{id}', name: 'cv_edit')]
    public function edit($id, ManagerRegistry $doctrine)
    {
        $em = $doctrine->getManager();
        $c = $em->getRepository(Cv::class)->find($id);
     
       
        $form = $this->createForm(CvType::class, $c, 
                                                array('action' => $this->generateUrl('cv_update', ['id' => $id]))
                                            );
        $data['form'] = $form->createView();
        
        $data['cvs'] = $em->getRepository(Cv::class)->findAll();
        return $this->render('cv/liste.html.twig', $data);
      
    }

    #[route('/Cv/update/{id}', name: 'cv_update')]
    public function update($id, ManagerRegistry $doctrine, Request $request ): Response
    {
        $c = new Cv();
        $form = $this->createForm(CvType::class, $c);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $c = $form->getData();
           // $c->setUser($this->getUser()); // en cas de blem delete this line 
            $c->getId($id);
            $em = $doctrine->getManager();
            $cv = $em->getRepository(Cv::class)->find($id);
            $cv->setNom($c->getNom());
            $cv->setPrenom($c->getPrenom());
            $cv->setAge($c->getAge());
            $cv->setAdresse($c->getAdresse());
            $cv->setEmail($c->getEmail());
            $cv->setTelephone($c->getTelephone());
            $cv->setSpecialite($c->getSpecialite());
            $cv->setDiplome($c->getDiplome());
            $cv->setExperience($c->getExperience());

            $em->flush();


        }
       
        return $this->redirectToRoute('cv_liste');
    }
}
