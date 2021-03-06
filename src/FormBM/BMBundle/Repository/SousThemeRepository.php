<?php

namespace FormBM\BMBundle\Repository;

/**
 * SousThemeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SousThemeRepository extends \Doctrine\ORM\EntityRepository
{

	public function listeDesSousThemes($theme_id){
		return $this->createQueryBuilder('s')
		->select('s.libelle,s.id')
		->where('s.theme = :param')
		->setParameter('param',$theme_id)
		->getQuery()
		->getResult();

	}
}
