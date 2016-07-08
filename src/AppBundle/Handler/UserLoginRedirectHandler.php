<?php
namespace AppBundle\Handler;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

class UserLoginRedirectHandler implements AuthenticationSuccessHandlerInterface
{

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var AuthorizationChecker
     */
    private $authorizationChecker;

    public function __construct(RouterInterface $r, AuthorizationChecker $authorizationChecker)
    {
        $this->router = $r;
        $this->authorizationChecker = $authorizationChecker;
    }

    /**
     * This is called when an interactive authentication attempt succeeds. This
     * is called by authentication listeners inheriting from
     * AbstractAuthenticationListener.
     *
     * @param Request $request
     * @param TokenInterface $token
     *
     * @return Response never null
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        if ($this->authorizationChecker->isGranted('ROLE_SUPER_ADMIN')) {
            $response = new RedirectResponse($this->router->generate('sonata_admin_dashboard'));
        } else {
            $response = new RedirectResponse($this->router->generate('transaction_index'));
        }
        return $response;
    }
}