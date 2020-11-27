<?php
declare(strict_types=1);

namespace App\Form;

use App\Entity\Location;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class LocationType
 *
 * @author C. Boissieux.
 */
class LocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('city', Type\TextType::class, [
                'label' => 'weather.form.city_label',
                'attr' => [
                    'class' => 'form-control',
                    'name'=> 'locatation-helper',
                    'onFocus' => 'geolocate()'
                ],
                'required' => false,
            ])
            ->add('longitude', Type\NumberType::class, [
                'label' => 'weather.form.longitude_label',
                'attr' => ['class' => 'form-control'],
                'required' => false,
            ])
            ->add('latitude', Type\NumberType::class, [
                'label' => 'weather.form.latitude_label',
                'attr' => ['class' => 'form-control'],
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Location::class,
            'translation_domain' => 'weather',
        ]);
    }
}
