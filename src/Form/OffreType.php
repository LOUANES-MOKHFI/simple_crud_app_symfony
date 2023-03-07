<?php

namespace App\Form;

use App\Entity\Offre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Competances;
class OffreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('intitule')
            ->add('slug', HiddenType::class)
            ->add('number', HiddenType::class)
            ->add('category')
            ->add('competances', EntityType::class, [
                'class' => Competances::class, // Add the class option here
                'by_reference' => false,
                'multiple' => true,
                'expanded' => true,
                'label' => 'Select competences',
            ])
            ->add('url_condidateur')
            ->add('description', TextareaType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'tinymce form-control', 'id'=>'tinymce'
                ]
            ])
        ;
        $builder->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
            $data = $event->getData();
           
            $slug = $this->generateSlug($data['intitule']);
            $number = $randomNumber = random_int(10000, 99999);;
            $data['slug'] = $slug;
            $data['number'] = $number;

            $event->setData($data);
        });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Offre::class,
        ]);
    }

    private function generateSlug(string $intitule): string
    {
        $slug = iconv('UTF-8', 'ASCII//TRANSLIT', $intitule);
        $slug = strtolower($slug);
        $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);

        // Remove any trailing or leading dashes
        $slug = trim($slug, '-');
        return $slug;
    }
}
