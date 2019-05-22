<?php

namespace FormBM\BMBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FormBM\BMBundle\Form\AvisType;
use FormBM\BMBundle\Entity\Avis;


class AvisController extends Controller
{
    public function ajouteravisAction(Request $query)
    {
       
	$avis = new Avis();

	
    $form = $this->createForm(AvisType::class, $avis);


	if ($query->isMethod('POST')) {
	$form->handleRequest($query);

	if ($form->isValid()) {
	$em = $this->getDoctrine()->getManager();
	$em->persist($avis);
	$em->flush();
	$query->getSession()->getFlashBag()->add('notice', 'Avis enregistré.');
        return $this->redirect('/avis/ajouter');

	}
}
	return $this->render('FormBMBMBundle:BM:vueAvis.html.twig',
	array('form' => $form->createView(),));
	}
  }
