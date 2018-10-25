<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

//entidades
use App\Entity\Publicacion;
use App\Entity\Contacto;
use App\Entity\Documento;

class DefaultController extends Controller
{
    /**
     * @Route("/index", name="index")
     */
    public function index(Request $request)
    {
        $publicaciones = $this->getDoctrine()
        ->getRepository(Publicacion::class)
        ->findAll();
    
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $publicaciones, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            1/*limit per page*/
        );

        return $this->render('index.html.twig', [
            "publicaciones" => $publicaciones,
            "pagination" => $pagination
        ]);
    }

    /**
     * @Route("/lista_obras", name="obras")
     */
    public function obras()
    {
        $publicaciones = $this->getDoctrine()
        ->getRepository(Publicacion::class)
        ->findAll();
        return $this->render('obras.html.twig', [
            "publicaciones" => $publicaciones
        ]);
    }

    /**
     * @Route("/ver_obra/{id}", name="obra")
     */
    public function ver_obra($id)
    {
        $publicacion = $this->getDoctrine()
        ->getRepository(Publicacion::class)
        ->find($id);
        return $this->render('ver_obra.html.twig', [
            "publicacion" => $publicacion,
        ]);
    }

    /**
     * @Route("/contactos", name="contactos")
     */
    public function contactos()
    {
        $contactos = $this->getDoctrine()
        ->getRepository(Contacto::class)
        ->findAll();
        return $this->render('contactos.html.twig', [
            "contactos" => $contactos
        ]);
    }

    /**
     * @Route("/archivos", name="documentos")
     */
    public function documentos()
    {
        $documentos = $this->getDoctrine()
        ->getRepository(Documento::class)
        ->findAll();
        return $this->render('documentos.html.twig', [
            "documentos" => $documentos
        ]);
    }
}