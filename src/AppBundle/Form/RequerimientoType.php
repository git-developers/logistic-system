<?php

namespace AppBundle\Form;

//use Doctrine\DBAL\Types\DateTimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\Requerimiento;
use Doctrine\ORM\EntityManager;


class RequerimientoType extends AbstractType
{

    protected $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function findLastOne() {
        $findLastOne = $this->em->getRepository(Requerimiento::class)->findLastOne();

        if(is_null($findLastOne)){
            return 1;
        }

        return preg_replace('/[^0-9]/', '', $findLastOne);
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('compania', ChoiceType::class, [
                'label' => 'Compañia',
                'choices' => [
                    'Compañia 1' => 'Compañia 1',
                    'Compañia 2' => 'Compañia 2',
                    'Compañia 3' => 'Compañia 3'
                ],
                'label_attr' => ['class' => ''],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '',
                ],
            ])
            ->add('numero', TextType::class, [
                'label' => 'numero',
                'data' => $this->findLastOne(),
                'label_attr' => ['class' => ''],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '00000',
                    'readonly' => true,
                ],
            ])
            ->add('prioridad', ChoiceType::class, [
                'label' => 'Compañia',
                'choices' => [
                    'Alta' => 'Alta',
                    'Media' => 'Media',
                    'Baja' => 'Baja',
                ],
                'label_attr' => ['class' => ''],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '',
                ],
            ])
            ->add('almacen', ChoiceType::class, [
                'label' => 'Almacen',
                'choices' => [
                    'Almacen 1' => 'Almacen 1',
                    'Almacen 2' => 'Almacen 2',
                    'Almacen 3' => 'Almacen 3',
                ],
                'label_attr' => ['class' => ''],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '',
                ],
            ])
            ->add('fechaRequerida', DateType::class, [
                'label' => 'Fecha Requerida',
                'widget' => 'single_text',
                'label_attr' => ['class' => ''],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Guardar',
                'attr' => [
                    'class' => 'btn bg-olive margin',
                ],
            ])
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Requerimiento::class
        ]);
    }

}
