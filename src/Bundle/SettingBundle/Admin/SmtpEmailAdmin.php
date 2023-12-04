<?php
namespace App\Bundle\SettingBundle\Admin;

use App\Application\Project\ContentBundle\Admin\Base\BaseAdmin;
use App\Application\Project\SettingBundle\Entity\SmtpEmail;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollectionInterface;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Choice;


final class SmtpEmailAdmin extends BaseAdmin
{
    public function toString(object $object): string
    {
        return $object instanceof SmtpEmail ? $object->getId() . ' - Configurações do SMTP' : '';
    }

    protected function configureRoutes(RouteCollectionInterface $collection): void
    {
        parent::configureRoutes($collection);

        /** Não Remove chamada - Faz controle de acesso painel admin */
        $collection->remove('delete');
        $collection->remove('create');
        $collection->add('test');
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form->tab('Geral');
        $form->with('Informações Gerais',[
            'class'       => 'col-md-12',
            'description' => 'Informações Gerais',
        ]);

        $form->add('host',  TextType::class, [
            'label' => 'Host',
            'required' =>  false,
        ]);

        $form->add('username',  TextType::class, [
            'label' => 'Username',
            'required' =>  false ,
        ]);

        $form->add('password',  PasswordType::class, [
            'label' => 'Password',
            'required' =>  false ,
        ]);

        $form->add('typeSecurity',  ChoiceType::class, [
            'label' => 'SMTP Security',
            'required' =>  false ,
            'choices'  => [
                'SSL' => 'SSL',
                'TLS' => 'TLS',
                'Disabled' => 'disabled',
            ],
        ]);

        $form->add('port',  NumberType::class, [
            'label' => 'Port',
            'required' =>  false,
        ]);

        $form->add('fromName',  TextType::class, [
            'label' => 'From Name',
            'required' =>  false ,
        ]);

        $form->add('fromEmail',  TextType::class, [
            'label' => 'From Email',
            'required' =>  false ,
        ]);

        $form->add('debug',  ChoiceType::class, [
            'label' => 'Show Debug',
            'required' =>  true ,
            'choices'  => [
                'False' => false,
                'True' => true,
            ],
        ]);




        $form->end();
        $form->end();

    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {}

    protected function configureListFields(ListMapper $list): void
    {

    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->tab('Geral');
        $show->with('Informações Gerais', [
            'class'       => 'col-md-12',
            'box_class'   => 'box box-solid box-primary',
            'description' => 'Informações Gerais',
        ]);

        $show->add('id', null, [
            'label' => 'Id',
        ]);

        $show->add('host', null, [
            'label' => 'Host',
        ]);

        $show->add('port', null, [
            'label' => 'Port',
        ]);

        $show->add('username', null, [
            'label' => 'Username',
        ]);

        $show->add('fromName', null, [
            'label' => 'From Name',
        ]);

        $show->add('fromEmail', null, [
            'label' => 'From Email',
        ]);

        $show->add('typeSecurity', null, [
            'label' => 'Tipo de Segurança',
        ]);

        $show->end();
        $show->end();

    }


    protected function preUpdate(object $object): void
    {
        //dump($object);
//        if($this->passwordHasher->needsRehash($object))
//            $object->setPassword( $this->passwordHasher->hashPassword( $object, $object->getPassword() ) );
    }
}