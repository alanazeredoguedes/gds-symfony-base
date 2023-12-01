<?php

namespace App\Bundle\SecurityBundle\Admin;

use App\Bundle\SecurityBundle\Entity\User;
use App\Bundle\SettingBundle\Admin\Base\BaseAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

final class UserAdmin extends BaseAdmin
{
    public function toString(object $object): string
    {
        return $object instanceof User ? (string) $object->getId() : '';
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $isEdit = $this->isCurrentRoute('edit') == 'edit';
        $passwordRequired = ! $isEdit;
        $passwordOptions = array(
            'type' => PasswordType::class,
            'required' => $passwordRequired,
            'invalid_message' => 'The password fields must be the same.',
            'first_options' => array('label' => 'Password'),
            'second_options' => array('label' => 'Confirm Password')
        );
        if ($passwordRequired) {
            $passwordOptions['constraints'] = array(
                new NotBlank(array('message' => 'You must enter a password.')),
                new Length(array('min' => 5, 'minMessage' => 'The password must be longer than 5 characters.'))
            );
        }

        $form->add('name', TextType::class);
        $form->add('email', TextType::class);
        $form->add('password', RepeatedType::class, array(
            'type' => PasswordType::class,
            'first_options' => array('label' => 'Password',),
            'second_options' => array('label' => 'Confirm Password',),
            'required' => true,
        ));
        $form->add('password', RepeatedType::class,
            $passwordOptions
        );
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid->add('name');
        $datagrid->add('email');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list->addIdentifier('name');
        $list->addIdentifier('email');
        $list->add(ListMapper::NAME_ACTIONS, ListMapper::TYPE_ACTIONS, [
            'actions' => [
                'show' => [],
                'edit' => [],
                'delete' => [],
            ]
        ]);
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->tab('Geral');
            $show->with('General Info', [
                'class'       => 'col-md-12',
                'box_class'   => 'box box-solid box-primary',
                'description' => 'General Info',
            ]);

                $show->add('name');
                $show->add('email');

            $show->end();
        $show->end();
    }

    /** @param User $object */
    protected function prePersist(object $object): void
    {
        $object->setPassword( $this->passwordHasher->hashPassword( $object, $object->getPassword() ) );
    }

    /** @param User $object */
    protected function preUpdate(object $object): void
    {
        if($this->passwordHasher->needsRehash($object))
            $object->setPassword( $this->passwordHasher->hashPassword( $object, $object->getPassword() ) );
    }
}