<?php

namespace App\Authenticator;

use http\Env\Request;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

// NOT SECURE AT ALL IT IS TO POC THE STATELESS INSTEAD OF USING A MOCKSESS ID
#[AsEventListener('kernel.response')]
class MockedTokenForKeployListener
{
    public function __construct(private readonly Security $security)
    {
    }

    public function __invoke(ResponseEvent $event): void
    {
        if ($this->security->isGranted('IS_AUTHENTICATED_FULLY')) {
            $response = $event->getResponse();
            $response->headers->setCookie(new Cookie(
                'X-Auth-Keploy',                      // Cookie name
                $this->security->getUser()->getUserIdentifier(),                                       // Cookie content
                (new \DateTime())->modify("+1 day"), // Expiration date
                "/",                                     // Path
                "localhost",                             // Domain
                $event->getRequest()->getScheme() === 'https',       // Secure
                false,                                   // HttpOnly
                true,                                    // Raw
                'lax'                                 // SameSite policy
            ));

            $event->setResponse($response);
        }
    }
}
