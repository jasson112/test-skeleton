<?php


namespace App\Controller;


use App\Entity\Component;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class AppController  extends AbstractController
{
    protected $em;

    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }

    /**
     * @Route("/components", name="components")
     * @param SerializerInterface $serializer
     * @return JsonResponse
     */
    public function componentsAction(SerializerInterface $serializer)
    {
        $components = $this->getDoctrine()
            ->getRepository(Component::class)
            ->findAllComponents();

        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
        $encoders = [new JsonEncoder()]; // If no need for XmlEncoder
        $normalizers = [new ObjectNormalizer($classMetadataFactory)];
        $serializer = new Serializer($normalizers, $encoders);

        $jsonContent = $serializer->serialize($components, 'json', [
            'groups' => [
                'component'
            ],
            'circular_reference_handler' => function ($object) {
                return $object->getId();
            }
        ]);

        return JsonResponse::fromJsonString($jsonContent);
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
            ->getResult();
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