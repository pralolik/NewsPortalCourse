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

    public function getNews(int $id)
    {
        $entityManager = $this->getEntityManager();
        $news = $entityManager->getRepository('AppBundle:News')->findOneById($id);
        $views = $news->getNumberOfViews();
        $news->setNumberOfViews(++$views);
        $entityManager->persist($news);
        $entityManager->flush();
        return $news;
    }

    public function getSimilarNewsFromDataBase(int $id)
    {
        $entityManager = $this->getEntityManager();
        $news = $entityManager->getRepository('AppBundle:News')->findOneById($id);
        return $news;
    }

    public function getLatestNews()
    {
        $entityManager = $this->getEntityManager();
        $result = $entityManager->getRepository('AppBundle:News')
            ->createQueryBuilder('p')
            ->orderBy('p.createdAt')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();;
        return $result;
    }

    public function deleteNewsFromDataBase(int $id)
    {
        $entityManager = $this->getEntityManager();
        $news = $entityManager->getRepository('AppBundle:News')->findOneById($id);
        $entityManager->remove($news);
        $entityManager->flush();
    }

    public function sendToDataBase(News $news)
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($news);
        $entityManager->flush();
    }


}
