<?php


namespace App\Authenticator;

use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;

class CustomAuthenticator extends AbstractAuthenticator
{
    public function __construct(
        private Security $security
    ) {
    }

    /**
     * Called on every request to decide if this authenticator should be
     * used for the request. Returning `false` will cause this authenticator
     * to be skipped.
     */
    public function supports(Request $request): ?bool
    {
        return $request->cookies->has('X-Auth-Keploy');
    }

    public function authenticate(Request $request): Passport
    {
//        return new Passport(
//            new UserBadge("test@test.com", function (string $userIdentifier): ?UserInterface {
//                return $this->userRepository->findOneBy(['email' => "test@test.com]);
//            }),
//            new PasswordCredentials("testtest")
//        );
        
        return new SelfValidatingPassport(
            new UserBadge($request->cookies->get('X-Auth-Keploy'))
        );
//        return new Passport(
//            new UserBadge('test@test.com'),
//            new CustomCredentials(   function (string $credentials, UserInterface $user): bool {
//                return true;
//            },
//
//                // The custom credentials
//                "test@test.com"
//            )
//        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        $data = [
            // you may want to customize or obfuscate the message first
            'message' => strtr($exception->getMessageKey(), $exception->getMessageData())

            // or to translate this message
            // $this->translator->trans($exception->getMessageKey(), $exception->getMessageData())
        ];

        return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);
    }
}
