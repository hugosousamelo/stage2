<?php

namespace FormBM\BMBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FormBM\BMBundle\Form\EntrepriseType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use FormBM\BMBundle\Entity\Entreprise;


class EntrepriseController extends Controller
{	

    public function ajouterEntrepriseAction(Request $query)
    {
       	$repoEtp = $this->getDoctrine()->getRepository('FormBMBMBundle:Entreprise');

        $val = 	$repoEtp->getMaxIdEtp();
        $val = $val[0][1];
        if ($val == null){
        	$val = 510136;
        	$repoEtp->resetInc();
        }
        else {
        	$val = $val+1;
        }
        $id = dechex($val);
        $l1 = chr (random_int(65, 90));
        $l2 = chr (random_int(65, 90));
        $l3 = chr (random_int(65, 90));
        $code = $l1.$l2.$l3; 
        $numUnique = "BM".$id.$code."TRUSTIN";
    	$entreprise = new Entreprise();

    	
        $form = $this->createForm(EntrepriseType::class, $entreprise);


    	if ($query->isMethod('POST')) {
    	   $form->handleRequest($query);

    		if ($form->isValid()) {
        		$em = $this->getDoctrine()->getManager();
        		$entreprise->setNumUnique($numUnique);
        		$em->persist($entreprise);
        		$em->flush();
        		$query->getSession()->getFlashBag()->add('notice', 'Entreprise enregistrée.');
                return $this->redirect('/fiche/ajouter');

	       }
        }
	return $this->render('FormBMBMBundle:BM:vueEntreprise.html.twig',
	array('form' => $form->createView(),));
	}

    public function listeEtpAction($choix){
        $repoEtp = $this->getDoctrine()->getRepository('FormBMBMBundle:Entreprise');
        $listeEtp = $repoEtp->ListeEntreprise();
        return $this->render('FormBMBMBundle:BM:vueListeEtp.html.twig',
            array('listeEtp'=>$listeEtp,'choix'=>$choix));
    }
    public function editerEtpAction(Request $query,Entreprise $id_entreprise){
        $form = $this->createForm(EntrepriseType::class,$id_entreprise);

        $form->handleRequest($query);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->flush();
        }

        return $this->render('FormBMBMBundle:BM:vueEntreprise.html.twig',
            array('form' => $form->createView(),));

    }


    public function supprimerEtpAction($id_entreprise){

        $repoFiche  = $this->getDoctrine()->getRepository('FormBMBMBundle:Fiche');
        $repoAvis = $this->getDoctrine()->getRepository('FormBMBMBundle:Avis');
        $repoEtp = $this->getDoctrine()->getRepository('FormBMBMBundle:Entreprise');


        $repoAvis->supAvisEtp($id_entreprise);
        $repoFiche->supFicheEtp($id_entreprise);
        return new Response ('Les pourcentages et les avis de l\'entreprise ont été supprimés');
    }
}