<?php

namespace App\Security;

use App\Entity\User;
use App\Security\UserChecker;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Http\Util\TargetPathTrait;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAccountStatusException;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;

class AppCustomAuthenticator extends AbstractLoginFormAuthenticator
{
    use TargetPathTrait;

    public const LOGIN_ROUTE = 'app_login';

    private $doctrine , $security;


    public function __construct(Security $security, private UrlGeneratorInterface $urlGenerator , ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
        $this->security = $security;
    }

    public function authenticate(Request $request): Passport
    {
        $username = $request->request->get('username', '');

        $request->getSession()->set(Security::LAST_USERNAME, $username);



        $user = $this->doctrine->getRepository(User::class)->findOneByUsername($username);
        $userCheck = new UserChecker();

        // dd($userCheck->checkPreAuth($user));
        if(!$userCheck->checkPreAuth($user)){
            // dd('hi');

            $pass = new Passport(
                new UserBadge($username),
                new PasswordCredentials($request->request->get('password', '')),
                [
                    new CsrfTokenBadge('authenticate', $request->request->get('_csrf_token')),
                ]
            );
            // dd($pass);

            return $pass;

        } 
        
    }



    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        $user = $this->security->getUser();
        if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName)) {
            
            // $userRoutes=[];

            // foreach($user->getPActions() as $action){
            //     array_push($userRoutes,$action->getPSubModule()->getRouteName());
            // }

            // if(in_array($user->getRouteName(),$userRoutes)){

                return new RedirectResponse($this->urlGenerator->generate('app_global'));
            // }
            // else{
            //     return new RedirectResponse($this->urlGenerator->generate('app_logout'));
            // }
        }
        else{
            return new RedirectResponse($this->urlGenerator->generate('app_logout'));

        }

        // For example:
        // return new RedirectResponse($this->urlGenerator->generate('listUsers'));
        throw new \Exception('TODO: provide a valid redirect inside '.__FILE__);
    }

    protected function getLoginUrl(Request $request): string
    {
        return $this->urlGenerator->generate(self::LOGIN_ROUTE);
    }
}
