<?php

namespace FormBM\BMBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FormBM\BMBundle\Form\MotCleType;
use FormBM\BMBundle\Entity\MotCle;


class MotCleController extends Controller
{
    public function ajouterMotCleAction(Request $query)
    {
       
	$motcle = new MotCle();

	
    $form = $this->createForm(MotCleType::class, $motcle);


	if ($query->isMethod('POST')) {
	$form->handleRequest($query);

	if ($form->isValid()) {
	$em = $this->getDoctrine()->getManager();
	$em->persist($motcle);
	$em->flush();
	$query->getSession()->getFlashBag()->add('notice', 'Mot clé enregistré.');
	return $this->redirect("/motcle/ajouter");

	}
}
		return $this->render('FormBMBMBundle:BM:vueMotcle.html.twig',
	array('form' => $form->createView(),));
	}
  }
