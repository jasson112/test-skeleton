<?php


namespace App\Controller;


use App\Entity\Image;
use App\Entity\Vacation;
use App\Entity\WorkCandidate;
use App\Form\BlogType;
use App\Form\ImageType;
use App\Form\ImageUploadType;
use App\Form\VacationFormType;
use App\Form\WorkUsFormType;
use App\Service\Utils;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Serializer\SerializerInterface;

class AppController  extends AbstractController
{
    protected $em;
    protected $util;
    protected $liipCacheManager;
    protected $serializer;
    protected $mailer;
    protected $producer;
    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('app/home.html.twig');
    }

    /**
     * @Route("/admin/dashboard", name="admin_dashboard")
     */
    public function dashboardAction()
    {
        return $this->render('admin/dashboard.html.twig');
    }

}