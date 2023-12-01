<?php
namespace App\Bundle\SecurityBundle\Admin;

use App\Bundle\SecurityBundle\Entity\GroupUser;
use App\Bundle\SettingBundle\Admin\Base\BaseAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollectionInterface;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


final class GroupUserAdmin extends BaseAdmin
{

    public function toString(object $object): string
    {
        return $object instanceof GroupUser ? (string)$object->getId() : '';
    }

    protected function configureRoutes(RouteCollectionInterface $collection): void
    {
        parent::configureRoutes($collection);

        //$collection->add('listAllRoles');
    }

    /** @throws \ReflectionException */
    protected function configureFormFields(FormMapper $form): void
    {
        $form->add('name', TextType::class,[
            'label' => 'Group Name:',
            'required' => true,
        ]);

        $form->add('description', TextareaType::class,[
            'label' => 'Description:',
            'required' => false,
        ]);

        $form->add('roles', ChoiceType::class, [
            'label' => 'Roles',
            'required' => false,
            'multiple' => true,
            'expanded'=> false,
            'choices' => [],
            'attr' => [
                'class' => 'div-select-admin-roles',
                'style' => 'display:none;'
            ],
        ]);

    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid->add('name');
        $datagrid->add('description');
        $datagrid->add('roles');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list->addIdentifier('name');
        $list->addIdentifier('description');
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

                $show->add('name', null,[
                    'label' => 'Group Name:',
                ]);
                $show->add('description', null,[
                    'label' => 'Description:',
                ]);
                $show->add('roles', null,[
                    'label' => 'Permissions:',
                ]);

            $show->end();
        $show->end();


    }
}


