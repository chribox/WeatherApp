<?php
declare(strict_types=1);

namespace App\Controller;

use App\Api\WeatherApiInterface;
use App\Entity\Location;
use App\Form\LocationType;
use GuzzleHttp\Exception\ClientException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Contracts\Translation\TranslatorInterface;
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
     * @param TranslatorInterface $translator
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function index(
        Request $request,
        FormFactoryInterface $formFactory,
        WeatherApiInterface $weatherApi,
        Environment $twig,
        TranslatorInterface $translator
    ): Response
    {
        $apiResponse = null;
        $location = new Location();
        $form = $formFactory->create(LocationType::class, $location);
        $form->add('submit', Type\SubmitType::class, ['label' => $translator->trans('weather.form.submit_button', [], 'weather' ), 'attr' => ['class' => 'submit'],]);
        $form->add('reset', Type\ButtonType::class, ['label' => $translator->trans('weather.form.reset_button', [], 'weather' ), 'attr' => ['class' => 'reset'],]);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /** var Location $location */
            $location= $form->getData();
            try {
                    $apiResponse = $weatherApi->getCurrentForGivenCoordinates($form->getData());
            } catch (ClientException $e) {
               $this->addFlash('warning', $translator->trans('weather.error.no_result', [], 'weather' ));
            }

        }

        return new Response($twig->render('home.html.twig', [
            'hasData' => $location->getCity() !== null || ($location->getLongitude() !== null && $location->getLatitude() !== null),
            'weatherResult' => $apiResponse,
            'LocationForm' => $form->createView(),
        ]));
    }

}
