<?php


namespace App\Controller;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class AppController  extends AbstractController
{
    protected $em;

    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $ads = $this->em->createQueryBuilder()
            ->select('a', 'c')
            ->from("App:Ad", 'a')
            ->leftJoin("a.components", "c")
            ->andWhere("a.status = 1")
            ->getQuery()
            ->useQueryCache(true)
            ->useResultCache(true)
            ->getArrayResult();
        return $this->render('app/home.html.twig', compact('ads'));
    }

    /**
     * @Route("/admin/dashboard", name="admin_dashboard")
     */
    public function dashboardAction()
    {

        return $this->render('admin/dashboard.html.twig');
    }

}