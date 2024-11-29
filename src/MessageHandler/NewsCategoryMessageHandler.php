<?php
declare(strict_types=1);

namespace App\MessageHandler;

use App\Message\NewsCategoryMessage;
use App\Service\NewsService;
use jcobhams\NewsApi\NewsApi;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class NewsCategoryMessageHandler
{
    public function __construct(public NewsService $service )
    {
    }

    public function __invoke(NewsCategoryMessage $newsCategoryMessage)
    {
        $category = $newsCategoryMessage->getCategory();
        $newsapi = new NewsApi('d75fa55b9f344772ac939e584107aea6');
        //$dt = $date->format('Y-m-d');
        //$lastDayOfMonth = $date->modify('last day of this month')->format('Y-m-d');
        $data = $newsapi->getEverything($category, '', '', '', '2024-08-01', '2024-08-22', 'ru');
        $news = [];

        foreach ($data->articles as $item) {
            $news[] = [
                'author' => $item->author,
                'title' => $item->title,
                'url' => $item->url,
                'urlToImage' => $item->urlToImage
            ];
        }
        $this->service->save($news);
    }
}