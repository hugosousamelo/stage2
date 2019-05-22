<?php

namespace FormBM\BMBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FormBM\BMBundle\Form\FicheType;
use FormBM\BMBundle\Entity\Fiche;
use FormBM\BMBundle\Entity\Avis;

use FormBM\BMBundle\Entity\Entreprise;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\HttpFoundation\Session\Session;







class FicheController extends Controller
{
    public function ajouterFicheAction(Request $query)
    {
        $repoFiche = $this->getDoctrine()->getRepository('FormBMBMBundle:Fiche');

		$fiche = new Fiche();

		
	    $form = $this->createForm(FicheType :: class, $fiche);


		
		$form->handleRequest($query);

		if ($form -> isSubmitted () && $form -> isValid ()) {
            $lib_st= $form->get('SousTheme')->getData()->getLibelle();
            $etp = $form->get('entreprise')->getData()->getID();
            $id_theme = $form->get('theme')->getData()->getID();
            $verif = $repoFiche->verificationST($lib_st,$etp,$id_theme);

            if($verif == null){
                $em = $this->getDoctrine()->getManager();
                $em->persist($fiche);
                $em->flush();
                $verifnbTheme = $repoFiche->verifnbTheme($etp);

                if($verifnbTheme[0]["nbTheme"]>8){
                    $em = $this->getDoctrine()->getManager();
                    $em->remove($fiche);
                    $em->flush();
                    return new Response("Il y a déjà 8 thèmes enregistrés pour cette entreprise, vous ne pouvez en ajouter plus.");

                }


            }else {
                return new Response("Pourcentage déjà défini pour ce sous-thème.");
            }


            $query->getSession()->getFlashBag()->add('notice', 'Fiche enregistré.');
            return $this->redirect('/fiche/ajouter');


	    }

	return $this->render('FormBMBMBundle:BM:vueFiche.html.twig',
	array('form' => $form->createView())
	);
	}


	public function choisirEntrepriseAction(Request $query){
		$session = new Session();
		$form = $this->createFormBuilder()
		->add('entreprise', EntityType::class,array('class'=>Entreprise::class,
				'query_builder' => function(\Doctrine\ORM\EntityRepository $entityRepository)
                {
                    return $entityRepository->listeEtp();
                },'choice_label'=>'nom','placeholder'=>'Selectionner une entreprise'))


		->add('statut',ChoiceType::class, array(
    'choices'  => array(
        'Public'=>'Public',
    'Privé'=>'Privé',),'placeholder'=>'Selectionner un statut'))

        ->add("DescriptionEtp",TextareaType::class,array('label'=>"Description de l'entreprise",'attr'=>array("maxlength"=>300)))
        ->add("avisPerso",TextareaType::class,array('label'=>"Avis BoostMakers",'attr'=>array("maxlength"=>310)))
        ->add("Commentaire",TextareaType::class,array('label'=>'Commentaire sur l\'entreprise (rapport privé)','attr'=>array("maxlength"=>1500)))

		->add('Enregistrer',SubmitType::class)
        ->add("Badge",ChoiceType::class,array(
            'placeholder'=>'Selectionner le type de badge','choices'=>array(
                'Or / Argent / Bronze'=>'OR','AAA / BBB / CCC'=>'AAA')
        ))
            ->getForm();
		      



           
		

		if($query->isMethod('POST')){
			$form->handleRequest($query);
		}
		if($form->isSubmitted()){

			$data = $query->request->get('form');

			$statut = $data['statut'];

			$DescriptionEtp = $data['DescriptionEtp'];
			$avisPerso = $data['avisPerso'];
            $com = $data['Commentaire'];
            $badge = $data['Badge'];

			$session->set('badge',$badge);
			$session->set('DescriptionEtp',$DescriptionEtp);
			$session->set('avisPerso',$avisPerso);
			$session->set('com',$com);
			$id_entreprise = $data['entreprise'];
			if($statut =='Public'){
				return $this->redirect('/rapport/public/'.$id_entreprise);

			}else {
				return $this->redirect('/rapport/prive/'.$id_entreprise);
			}
		}
		return $this->render('FormBMBMBundle:BM:vueChoisirEntreprise.html.twig',
	array('form' => $form->createView())
	);

	}



	public function creerRapportPublicAction(Request $query,$id){
		$session = new Session();
		$session = $query->getSession();
		
		$DescriptionEtp = $session->get('DescriptionEtp');
		$avisPerso = $session->get('avisPerso');
		$badge = $session->get('badge');


		$repository = $this->getDoctrine()->getRepository('FormBMBMBundle:Fiche');
		$repoAvis = $this->getDoctrine()->getRepository('FormBMBMBundle:Avis');
		$repoEtp = $this->getDoctrine()->getRepository('FormBMBMBundle:Entreprise');


		$moyTot = $repository->moyTot($id);

		$moyTheme = $repository->moyTheme($id);

		$avis = $repoAvis->avisEntreprise($id);
		$Etp = $repoEtp->infoEntreprise($id);
		$logo = $repoEtp->logoEntreprise($id);
		$csv = $this->csv();

		if ($badge=="OR"){

		return $this->render('FormBMBMBundle:BM:vueRapportPublic1.html.twig',
			array('moyTot'=>$moyTot,'moyTheme'=>$moyTheme,'lesAvis'=>$avis,'infoEntreprise'=>$Etp,'logo'=>$logo,'DescriptionEtp'=>$DescriptionEtp,'avisPerso'=>$avisPerso,'csv'=>$csv));		}

		else {
			return $this->render('FormBMBMBundle:BM:vueRapportPublic2.html.twig',
	array('moyTot'=>$moyTot,'moyTheme'=>$moyTheme,'lesAvis'=>$avis,'infoEntreprise'=>$Etp,'logo'=>$logo,'DescriptionEtp'=>$DescriptionEtp,'avisPerso'=>$avisPerso,'csv'=>$csv));
		}

	}

	public function creerRapportPriveAction(Request $query,$id){
		$session = new Session();
		$avisPerso = $session->get('avisPerso');
		$badge = $session->get('badge');
		$messagePourcent = $this->csv();
        $com = $session->get('com');


        $repository = $this->getDoctrine()->getRepository('FormBMBMBundle:Fiche');
		$repoAvis = $this->getDoctrine()->getRepository('FormBMBMBundle:Avis');
		$repoEtp = $this->getDoctrine()->getRepository('FormBMBMBundle:Entreprise');


		$moyTot = $repository->moyTot($id);
		$moyTheme = $repository->moyTheme($id);
		$listeSousTheme = $repository->sousTheme($id);
		$avis = $repoAvis->avisEntreprise($id);
		$Etp = $repoEtp->infoEntreprise($id);
		$logo = $repoEtp->logoEntreprise($id);

        if ($badge=="OR"){

            return $this->render('FormBMBMBundle:BM:vueRapportPrive.html.twig',
                array('com'=>$com,'moyTot'=>$moyTot,'moyTheme'=>$moyTheme,'lesAvis'=>$avis,'infoEntreprise'=>$Etp,'logo'=>$logo,'listeSousTheme'=>$listeSousTheme,'messagePourcent'=>$messagePourcent,'avisPerso'=>$avisPerso));
        }

        else {
            return $this->render('FormBMBMBundle:BM:vueRapportPrive2.html.twig',
                array('com'=>$com,'moyTot'=>$moyTot,'moyTheme'=>$moyTheme,'lesAvis'=>$avis,'infoEntreprise'=>$Etp,'logo'=>$logo,'listeSousTheme'=>$listeSousTheme,'messagePourcent'=>$messagePourcent,'avisPerso'=>$avisPerso));
        }

	}


    public function csv(){
        $messagePourcent = array(); // Tableau qui va contenir les éléments extraits du fichier CSV
        $row = 0; // Représente la ligne
        // Import du fichier CSV 
        if (($handle = fopen("/var/www/html/FormBM/src/FormBM/BMBundle/Resources/messagePourcent.csv", "r")) !== FALSE) { // Lecture du fichier, à adapter
            while (($data = fgetcsv($handle, 2000, ";")) !== FALSE) { // Eléments séparés par un point-virgule, à modifier si necessaire
                $num = count($data); // Nombre d'éléments sur la ligne traitée
                $row++;
                for ($c = 0; $c < $num; $c++) {
                    $messagePourcent[$row] = array(
                            "message0à20" => $data[0],
                            "message20à40" => $data[1],
                            "message40à60" => $data[2],
                            "message60à80" => $data[3],
                            "message80à100" => $data[4],
                           
                    );
                }
            }
            fclose($handle); 
        return ($messagePourcent);

    }

    }



}
