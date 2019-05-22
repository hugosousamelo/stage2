<?php

namespace FormBM\BMBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FormBM\BMBundle\Form\ThemeType;
use FormBM\BMBundle\Entity\Theme;


class ThemeController extends Controller
{
    public function ajouterThemeAction(Request $query)
    {
       
	$theme = new Theme();

	
    $form = $this->createForm(ThemeType::class, $theme);


	if ($query->isMethod('POST')) {
	$form->handleRequest($query);

	if ($form->isValid()) {
	$em = $this->getDoctrine()->getManager();
	$em->persist($theme);
	$em->flush();
	$query->getSession()->getFlashBag()->add('notice', 'Thème enregistré.');
        return $this->redirect('/theme/ajouter');
	}
}
	return $this->render('FormBMBMBundle:BM:vueTheme.html.twig',
	array('form' => $form->createView(),));
	}


	public function listerThemeAction($choix){
		$repository = $this->getDoctrine()->getRepository('FormBMBMBundle:Theme');

		$theme = $repository->findAll();

		return $this->render('FormBMBMBundle:BM:vueListerTheme.html.twig',
	array('Themes'=>$theme,'choix'=>$choix));
	}


	public function editThemeAction(Request $query,Theme $theme){
		$form = $this->createForm(ThemeType::class,$theme);

		$form->handleRequest($query);

		if($form->isSubmitted() && $form->isValid()){
			$em = $this->getDoctrine()->getManager();
			$em->flush();
		}
	
		return $this->render('FormBMBMBundle:BM:vueTheme.html.twig',
		array('form' => $form->createView(),));

	}
  }
