<?php

namespace App\Bundle\SettingBundle\Controller;

use App\Bundle\SettingBundle\Controller\Base\BaseAdminController;
use App\Bundle\SettingBundle\Entity\SmtpEmail;
use App\Bundle\SettingBundle\Service\ServiceEmail;
use Sonata\AdminBundle\Datagrid\ProxyQueryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Email;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

##[ACL\Admin(enable: true, title: 'Smtp Email', description: 'Permissões do modulo Smtp Email')]
class ProjectAdminController extends BaseAdminController
{

    protected string $baseRouter = "admin_app_setting_smtpemail_";
    protected string $baseTemplate = "@BundleSetting/smtpEmail/";


    ##[ACL\Admin(enable: true, title: 'Listar', description: '...')]
    public function listAction(Request $request): Response
    {
        //$this->validateAccess("listAction");
        $em = $this->managerRegistry->getManager();

        $data = $em->getRepository(SmtpEmail::class)->find(1);
        if(!$data){
            $data = new SmtpEmail();
            $em->persist($data);
            $em->flush();
        }

        return $this->redirectToRoute($this->baseRouter . 'show', ['id' => $data->getId()]);

       //return parent::listAction($request);
    }

    public function testAction(ServiceEmail $serviceEmail)
    {
        $mail = $serviceEmail->getEmail();

        $mail->addAddress('alanguedes00@live.com');
        $mail->Subject = 'Assunto Teste';
        $bodyContent = "<h1> Conteudo Email </h1>";
        $mail->Body = $bodyContent;

        if($mail->send()) {
            return new JsonResponse([
                'status' => true,
                'message' => "Email enviado com sucesso!",
            ]);
        }else{
            return new JsonResponse([
                'status' => false,
                'message' => "Erro ao enviar email!",
            ]);
        }

    }

}