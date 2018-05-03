<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\Product;
use Doctrine\ORM\EntityManager;


class ProductType extends AbstractType
{

    protected $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

//    public function getRoles() {
//        $roleRepository = $this->em->getRepository(Role::class);
//        return $roleRepository->findAll();
//    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('name', TextType::class, [
                'label' => 'Nombre',
                'label_attr' => ['class' => ''],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'e.g. producto 1',
                ],
            ])
            ->add('code', TextType::class, [
                'label' => 'Código',
                'label_attr' => ['class' => ''],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '0000999',
                ],
            ])
            ->add('stock', IntegerType::class, [
                'label' => 'stock',
                'required' => false,
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'stock',
                ],
                'error_bubbling' => true
            ])
            ->add('image', TextType::class, [
                'label' => 'image',
                'required' => true,
                'data' => 'http://www.free-icons-download.net/images/product-icon-27962.png',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'http://www.free-icons-download.net/images/product-icon-27962.png',
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
            'data_class' => Product::class
        ]);
    }

}
