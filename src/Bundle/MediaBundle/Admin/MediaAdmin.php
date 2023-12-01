<?php
namespace App\Bundle\MediaBundle\Admin;

use App\Bundle\MediaBundle\Entity\Media;
use App\Bundle\SettingBundle\Admin\Base\BaseAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollectionInterface;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


final class MediaAdmin extends BaseAdmin
{

    public function toString(object $object): string
    {
        return $object instanceof Media ? (string) $object->getId() : '';
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
            'label' => 'Name:',
            'required' => true,
        ]);

    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid->add('name');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list->addIdentifier('name');
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
                    'label' => 'Name:',
                ]);

            $show->end();
        $show->end();


    }
}


