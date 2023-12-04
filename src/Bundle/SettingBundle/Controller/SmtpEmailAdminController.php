<?php

namespace App\Bundle\SettingBundle\Controller;
use App\Application\Project\ContentBundle\Attributes\Acl;

use App\Application\Project\ContentBundle\Controller\Base\BaseAdminController;
use App\Application\Project\SettingBundle\Entity\SmtpEmail;
use App\Application\Project\SettingBundle\Service\ServiceEmail;
use Sonata\AdminBundle\Datagrid\ProxyQueryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Email;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

#[ACL\Admin(enable: true, title: 'Smtp Email', description: 'Permissões do modulo Smtp Email')]
class SmtpEmailAdminController extends BaseAdminController
{

    #[ACL\Admin(enable: true, title: 'Listar', description: '...')]
    public function listAction(Request $request): Response
    {
        $this->validateAccess("listAction");

        $em = $this->managerRegistry->getManager();

        $data = $em->getRepository(SmtpEmail::class)->find(1);
        if(!$data){
            $data = new SmtpEmail();
            $em->persist($data);
            $em->flush();
        }

        return $this->redirectToRoute('admin_project_setting_smtpemail_edit', ['id' => $data->getId()]);

        return parent::listAction($request);
    }

    #[ACL\Admin(enable: true, title: 'Visualizar', description: '...')]
    public function showAction(Request $request): Response
    {
        $this->validateAccess("showAction");

        return parent::showAction($request);
    }

    #[ACL\Admin(enable: true, title: 'Criar', description: '...')]
    public function createAction(Request $request): Response
    {
        $this->validateAccess("createAction");

        return parent::createAction($request);
    }

    #[ACL\Admin(enable: true, title: 'Editar', description: '...')]
    public function editAction(Request $request): Response
    {
        $this->validateAccess("editAction");

        return parent::editAction($request);
    }

    #[ACL\Admin(enable: true, title: 'Excluir', description: '...')]
    public function deleteAction(Request $request): Response
    {
        $this->validateAccess("deleteAction");

        return parent::deleteAction($request);
    }

    #[ACL\Admin(enable: true, title: 'Excluir em Lote', description: '...')]
    public function batchActionDelete(ProxyQueryInterface $query): Response
    {
        $this->validateAccess("batchActionDelete");

        return parent::batchActionDelete($query);
    }

    public function batchAction(Request $request): Response
    {
        $this->validateAccess("batchActionDelete");

        return parent::batchAction($request);
    }

    #[ACL\Admin(enable: true, title: 'Exportar', description: '...')]
    public function exportAction(Request $request): Response
    {
        $this->validateAccess("exportAction");

        return parent::exportAction($request);
    }

    #[ACL\Admin(enable: true, title: 'Auditoria', description: '...')]
    public function historyAction(Request $request): Response
    {
        $this->validateAccess("historyAction");

        return parent::historyAction($request);
    }

    public function historyViewRevisionAction(Request $request, string $revision): Response
    {
        $this->validateAccess("historyAction");

        return parent::historyViewRevisionAction($request, $revision);
    }

    public function historyCompareRevisionsAction(Request $request, string $baseRevision, string $compareRevision): Response
    {
        $this->validateAccess("historyAction");

        return parent::historyCompareRevisionsAction($request, $baseRevision, $compareRevision);
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