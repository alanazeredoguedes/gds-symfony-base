<?php

namespace App\Bundle\SettingBundle\Service;

use App\Application\Internit\EmpresaBundle\Entity\Empresa;
use App\Application\Project\SettingBundle\Entity\SmtpEmail;
use Doctrine\Persistence\ManagerRegistry;
use PHPMailer\PHPMailer\PHPMailer;

class ServiceEmail
{

    public function __construct(
        protected ManagerRegistry $managerRegistry
    )
    {}

    public function getEmail(): PHPMailer
    {
        $smtpEmail = $this->managerRegistry->getRepository(SmtpEmail::class)->find(1);

        /** Configurações Gerais */
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->isHTML(true);
        $mail->CharSet = "UTF-8";
        $mail->Encoding = 'base64';

        /** Configurações SMTP */
        $mail->Host = $smtpEmail->getHost();
        $mail->SMTPAuth = true;
        $mail->Username = $smtpEmail->getUsername();
        $mail->Password = $smtpEmail->getPassword();
        $mail->Port = $smtpEmail->getPort();
        $mail->setFrom($smtpEmail->getFromEmail(), $smtpEmail->getFromName());

        if($smtpEmail->getTypeSecurity() == 'disabled'){
            $mail->SMTPAutoTLS = False;
        }else{
            $mail->SMTPSecure = $smtpEmail->getTypeSecurity();
        }

        if($smtpEmail->getDebug()){
            $mail->SMTPDebug = 2;
        }

        return $mail;
    }

    public function getEmpresa(): ?Empresa
    {
        return $this->managerRegistry->getRepository(Empresa::class)->find(1);
    }
}