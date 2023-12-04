<?php

namespace App\Bundle\SecurityBundle\Controller;

use App\Bundle\SecurityBundle\Entity\User;
use App\Bundle\SettingBundle\Controller\Base\BaseAdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AuthAdminConstroller extends BaseAdminController
{
    protected string $baseTemplate = "@BundleSecurity/auth/";


    /**
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function loginAction(AuthenticationUtils $authenticationUtils): Response
    {
        if($this->getUser())
            return $this->redirectToRoute('sonata_admin_dashboard');

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render($this->baseTemplate . 'auth/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }

    public function recoverPasswordAction(Request $request)
    {
        $em = $this->doctrine->getManager();

        dump('dasd');

        if($request->getMethod() === 'POST'){

            $email = $request->request->get('email');
            if(!$email)
                return $this->json([
                    'status' => false,
                    'message' => 'Please provide an email before continuing!',
                ], 400);

            $user = $em->getRepository(User::class)->findOneBy(['email' => $email]);
            if(!$user)
                return $this->json([
                    'status' => false,
                    'message' => 'User not found!',
                ], 400);

            $newPassword = $this->rand_string(8);

            $user->setPassword( $this->passwordHasher->hashPassword($user, $newPassword) );

            $mail = $this->serviceEmail->getEmail();
            $mail->addAddress($user->getEmail());
            $mail->Subject = 'Recover Password';

            $mail->Body = $this->renderTemplateEmail($this->baseTemplatesEmail . 'auth/recover_password.html.twig', [
                'user' => $user,
                'newPassword' => $newPassword
            ]);

            if($mail->send()) {
                $em->persist($user);
                $em->flush();

                return $this->json([
                    'status' => true,
                    'message' => 'A new one has been sent to your email!',
                ]);
            }else{
                return $this->json([
                    'status' => false,
                    'message' => 'Error creating new password!',
                ], 400);
            }

        }

        return $this->render($this->baseTemplate . 'auth/recover_password.html.twig', []);

    }

    public function logoutAction(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    public function accessDeniedAction(): Response
    {
        return $this->render($this->baseTemplate . 'error/error_403.html.twig');
    }

    protected function rand_string( $length ) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return substr(str_shuffle($chars),0,$length);
    }

}