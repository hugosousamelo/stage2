<?php

namespace FormBM\BMBundle\Repository;

/**
 * EntrepriseRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EntrepriseRepository extends \Doctrine\ORM\EntityRepository
{
    public function listeEntreprise()
    {
        return $this->createQueryBuilder('e')
            ->select('e')
            ->orderBy('e.nom','ASC')
            ->getQuery()
            ->getResult();


    }
    public function supEtp($id_entreprise)
    {
        return $this->createQueryBuilder('e')
            ->delete('FormBMBMBundle:Entreprise e')
            ->Where('e.id =?1')
            ->setParameter(1,$id_entreprise)
            ->getQuery()
            ->execute();
    }



	public function logoEntreprise($id_entreprise){
		return $this->createQueryBuilder('e')
			->select('l.nom')
			->leftJoin('e.logo', 'l')
            ->where("e.id= ?1")
            ->setParameter(1, $id_entreprise)
            ->getQuery()
            ->getResult();
	}

	public function infoEntreprise($id_entreprise){
		return $this->createQueryBuilder('e')
			->select('e.nom,e.ville, e.codePostal, e.siteWeb, e.nomDirigeant, e.numTel, e.mail, e.numUnique')
            ->where("e.id= ?1")
            ->setParameter(1, $id_entreprise)
            ->getQuery()
            ->getResult();
          
        }
    public function listeEtp()
		{
		return $this->createQueryBuilder('e')
		->select('e')
		->orderBy('e.nom','ASC');


	}

	public function getMaxIdEtp()
		{
		return $this->createQueryBuilder('e')
		->select('max(e.id)')
		->getQuery()
        ->getResult();

	}
	public function resetInc()
		{
		$rawSql = "alter table entreprise auto_increment=510136";

    $stmt = $this->getEntityManager()->getConnection()->prepare($rawSql);
    $stmt->execute([]);

	}


}
