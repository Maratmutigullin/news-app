<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\News;
use App\Entity\NewsCategory;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use jcobhams\NewsApi\NewsApi;
use jcobhams\NewsApi\NewsApiException;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class NewsService
{
    public function __construct(public HttpClientInterface $client, public EntityManagerInterface $entityManager)
    {
    }

    const BUSINESS = 'business';
    const ENTERTAIMENT = 'entertainment';
    const GENERAL = 'general';
    const HEALTH = 'health';
    const SCIENCE = 'science';
    const SPORTS = 'sports';
    const TECHNOLOGY = 'technology';


    /**
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws NewsApiException
     * @var DateTimeImmutable $date
     */
    public function saveAllNews($date): true
    {
        //$u = 'https://newsapi.org/v2/everything?q=apple&from=2024-07-30&to=2024-07-30&sortBy=popularity&apiKey=d75fa55b9f344772ac939e584107aea6';

        //d75fa55b9f344772ac939e584107aea6
        $newsapi = new NewsApi('d75fa55b9f344772ac939e584107aea6');

//        $languages = $newsapi->getLanguages();
//        $countries = $newsapi->getCountries();
        $categories = $newsapi->getCategories();
        dump($categories);die();
//        $data = $newsapi->getEverything(self::BUSINESS);
//        dump($data);die();
//        dump($data->articles);die();
        $dt = $date->format('Y-m-d');
        $lastDayOfMonth = $date->modify('last day of this month')->format('Y-m-d');
        $data = $newsapi->getEverything('business', '', '', '', $dt, $lastDayOfMonth, 'ru');
        $news = [];

        foreach ($data->articles as $item) {
            $news[] = [
                'author' => $item->author,
                'title' => $item->title,
                'url' => $item->url,
                'urlToImage' => $item->urlToImage
            ];
        }
        $this->save($news);
        return true;
        #324 ▼
//            +"source": {#243 ▶}
//            +"author": "Сергей Максименков"
//            +"title": "Business Insider собрал 12 мужских вещей, которые в 2024 году считаются наиболее статусными"
//            +"description": "Сомнительно, но окей."
//            +"url": "https://lifehacker.ru/statusnye-muzhskie-veshhi-2024/"
//            +"urlToImage": "https://cdn.lifehacker.ru/wp-content/uploads/2024/07/MyCollages_1720601153.jpg"
//            +"publishedAt": "2024-07-10T08:47:41Z"
//            +"content": """
//    Business Insider , 2024 , . : , .
//     . Business Insider . Casio, - 1980- , Patek Philippe, , Golden Ellipse, 2024 .
//     Patek Philippe Golden Ellipse
//    Suitsupply, . Dior Sauvage, .
//     Suitsupply
//    Herman … [+243 chars]
//    """

//        $response = $this->client->request('GET', self::NEWS_URL);
//        if ($response->getStatusCode() !== 200) {
//            return new Response('Нет новостей ', Response::HTTP_INTERNAL_SERVER_ERROR);
//        }
//        $crawler = new Crawler($content);
//        $items = $crawler->filter('channel > item');
//        $titles = [];
//        $items->each(function (Crawler $item) use (&$titles) {
//            $titles[] = $item->filter('title')->text();
//        });

    }

    /**
     * @return void
     */
    public function save($newsData)
    {

        //dump($newsData);die();
        foreach ($newsData as $item) {
            $news = new News();
            $news->setAuthor($item['author']);
            $news->setTitle($item['title']);
            $news->setUrl($item['url']);
            $news->setUrlToImage($item['urlToImage'] ?: '');
            $news->setDateCreate(new DateTimeImmutable());
            $this->entityManager->persist($news);
        }
        $this->entityManager->flush();
    }

    /**
     * @return array
     */
    public function getCategories(): array
    {
        return $this->entityManager->getRepository(NewsCategory::class)->findAll();
    }
}
