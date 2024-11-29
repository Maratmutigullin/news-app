<?php
declare(strict_types=1);

namespace App\Controller;


use App\Service\NewsService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;


class NewsController extends AbstractController
{
    #[Route('/news', name: 'news')]
    public function action(NewsService $service): Response
    {
        $date = new \DateTimeImmutable();
        $news = $service->saveAllNews($date);
        // Рендеринг шаблона с новостями
        return $this->render('news/index.html.twig', [
            'news' => $news,
        ]);
    }
}
