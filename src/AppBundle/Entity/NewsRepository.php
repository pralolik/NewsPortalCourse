<?php

namespace AppBundle\Entity;

/**
 * NewsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class NewsRepository extends \Doctrine\ORM\EntityRepository
{

    public function getNews(string $id)
    {
        $entityManager = $this->getEntityManager();
        $category = $entityManager->getRepository('AppBundle:News')->findOneById($id);
        return $category;
    }


}
