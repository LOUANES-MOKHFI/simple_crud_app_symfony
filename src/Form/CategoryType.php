<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('slug', HiddenType::class)
           
            ->add('is_active', CheckboxType::class, [
                'required' => false,
                'label' => 'Status',
                'attr' => [
                    'value' => (bool) $builder->getData()->getIsActive(),
                ]
            ]);
        ;
        $builder->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
            $data = $event->getData();
            $slug = $this->generateSlug($data['name']);
            $data['slug'] = $slug;
            
            
            $event->setData($data);
        });
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }

    private function generateSlug(string $title): string
    {
        $slug = iconv('UTF-8', 'ASCII//TRANSLIT', $title);
        $slug = strtolower($slug);
        $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);

        // Remove any trailing or leading dashes
        $slug = trim($slug, '-');
        return $slug;
    }
}
