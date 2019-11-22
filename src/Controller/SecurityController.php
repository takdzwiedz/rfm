<?php

namespace App\Controller;

use App\QueryLogic\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    /**
     * @Route("/security", name="analysis_security")
     */
    public function logIn(Request $request, Security $security, Session $session)
    {
        $username = $request->request->get('username');
        $password = $request->request->get('password');

        $sec = $security->verifyUser($username, $password);

        if ($sec) {
            $session->set('logged', true);
            $session->set('user', $sec[0]['username']);
            $session->set('name', $sec[0]['imie_nazwisko']);
            $session->set('test', 'test');
            return $this->redirect('group-order-all');
        } else {
            return $this->render('security/index.html.twig');
        }
    }

    /**
     * @Route("/logout", name="analysis_security_logout")
     */

    public function logOut(Session $session)
    {
        $session->remove('logged');
        return $this->redirect('security');
    }
}
