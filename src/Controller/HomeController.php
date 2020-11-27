<?php
declare(strict_types=1);

namespace App\Controller;

use App\Api\WeatherApiInterface;
use App\Entity\Location;
use App\Form\LocationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class HomeController
 *
 * @author C. Boissieux.
 */
class HomeController extends AbstractController
{
    /**
     * @param Request $request
     * @param FormFactoryInterface $formFactory
     * @param WeatherApiInterface $weatherApi
     * @param Environment $twig
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function index(
        Request $request,
        FormFactoryInterface $formFactory,
        WeatherApiInterface $weatherApi,
        Environment $twig
    ): Response
    {
        $apiResponse = null;
        $location = new Location();
        $form = $formFactory->create(LocationType::class, $location);
        $form->add('submit', Type\SubmitType::class, ['label' => 'Valider', 'attr' => ['class' => 'submit'],]);
        $form->add('reset', Type\ButtonType::class, ['label' => 'Reset', 'attr' => ['class' => 'reset'],]);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /** var Location $location */
            $location= $form->getData();
            if ($location->getlongitude() !== null && $location->getLatitude() !== null) {
                $apiResponse = $weatherApi->getWeatherForGivenCoordinates($form->getData());
            } else {
                $apiResponse = $weatherApi->getWeatherForGivenCity($form->getData());
            }
        }

        return new Response($twig->render('home.html.twig', [
            'hasData' => $location->getCity() !== null || ($location->getLongitude() !== null && $location->getLatitude() !== null),
            'weatherResult' => $apiResponse,
            'LocationForm' => $form->createView()
        ]));
    }

}
