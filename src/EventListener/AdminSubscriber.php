<?php


namespace App\EventListener;


use Doctrine\Common\EventSubscriber;
use EasyCorp\Bundle\EasyAdminBundle\Event\EasyAdminEvents;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class AdminSubscriber implements EventSubscriberInterface
{
    private $logger;
    private $session;
    protected $requestStack;

    public function __construct(LoggerInterface $logger, Session $session, RequestStack $requestStack)
    {
        $this->logger = $logger;
        $this->session = $session;
        $this->requestStack = $requestStack;
    }

    public static function getSubscribedEvents()
    {
        return [
            EasyAdminEvents::PRE_UPDATE => 'setBlogPostSlug',
            KernelEvents::REQUEST => 'onKernelRequest'
        ];
    }

    public function onKernelRequest($event)
    {
        $this->logger->info('Yea, it totally works!');
    }

    public function setBlogPostSlug(GenericEvent  $event)
    {
        $request = $this->requestStack->getCurrentRequest();
        $referer = $request->headers->get('referer');
        $this->session->getFlashBag()->add("success", "This is a success message");
        $response = new RedirectResponse($referer);
        //exit(dump($referer));

        return new RedirectResponse('admin_dashboard');
        return;
        $entity = $event->getSubject();
        $this->logger->info('WORKING EVENT LISTENR !');
    }




}