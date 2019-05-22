<?php

namespace FormBM\BMBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FormBM\BMBundle\Form\SousThemeType;
use FormBM\BMBundle\Entity\SousTheme;
use FormBM\BMBundle\Repository\SousThemeRepository;


class SousThemeController extends Controller
{
    public function ajouterSousThemeAction(Request $query)
    {
       
	$st = new SousTheme();

	
    $form = $this->createForm(SousThemeType::class, $st);


	if ($query->isMethod('POST')) {
	$form->handleRequest($query);

	if ($form->isValid()) {
	$em = $this->getDoctrine()->getManager();
	$em->persist($st);
	$em->flush();
	$query->getSession()->getFlashBag()->add('notice', 'Sous theme enregistré.');
        return $this->redirect('/soustheme/ajouter');

	}
}
	return $this->render('FormBMBMBundle:BM:vueSousTheme.html.twig',
	array('form' => $form->createView(),));
	}




	public function listerSousThemeAction($theme_id){
		$repository = $this->getDoctrine()->getRepository('FormBMBMBundle:SousTheme');

		$result = $repository->listeDesSousThemes($theme_id);

		return $this->render('FormBMBMBundle:BM:vueListerSousTheme.html.twig',
	array('SousThemes'=>$result));
	}



	public function editSousThemeAction(Request $query,SousTheme $soustheme){
		$form = $this->createForm(SousThemeType::class,$soustheme);

		$form->handleRequest($query);

		if($form->isSubmitted() && $form->isValid()){
			$em = $this->getDoctrine()->getManager();
			$em->flush();
		}
	
		return $this->render('FormBMBMBundle:BM:vueSousTheme.html.twig',
		array('form' => $form->createView(),));

	}
  }
