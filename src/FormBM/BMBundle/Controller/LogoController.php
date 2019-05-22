<?php

namespace FormBM\BMBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FormBM\BMBundle\Form\LogoType;
use FormBM\BMBundle\Entity\Logo;


class LogoController extends Controller
{
    public function ajouterlogoAction(Request $query)
    {
       
		$logo = new Logo();

		
	    $form = $this->createForm(LogoType::class, $logo);


		if ($query->isMethod('POST')) {
			$form->handleRequest($query);

			if ($form->isValid()) {
				$em = $this->getDoctrine()->getManager();
				$em->persist($logo);
				$em->flush();
				$query->getSession()->getFlashBag()->add('notice', 'Logo enregistré.');
                return $this->redirect('/entreprise/ajouter');

			}
		}
		return $this->render('FormBMBMBundle:BM:vueLogo.html.twig',
		array('form' => $form->createView(),));
	}






}
