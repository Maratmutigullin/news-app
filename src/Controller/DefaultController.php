<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Message\NewsCategoryMessage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_default')]
    public function index(MessageBusInterface $bus): Response
    {
        //$bus->dispatch(new NewsCategoryMessage('Look! I created a message!'));
        return $this->render('base.html.twig', []);
    }
}
