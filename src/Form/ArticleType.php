<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('contenu')
            ->add('photo', FileType::class, [
                'data_class' => null,
                'label' => 'charger une image',//enregistrement des images surle serveur pas sur la BDD
                'required' => false,//ce champ n'est pas obligatoire
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',

            ]) //le formulaire essaie d'afficher un string au lieu d'un objet donc on a une erreur
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
