<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\NewsCategory;
use App\Message\NewsCategoryMessage;
use App\Service\NewsService;
use DateTimeImmutable;
use Exception;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsCommand(
    name: 'app:check-news',
    description: 'Отправка в очередь',
    aliases: ['app:check-news'],
    hidden: false
)]
class SaveNewsCommand extends Command
{
    public function __construct(private readonly MessageBusInterface $messageBus, private readonly NewsService $newsService)
    {
        parent::__construct();
    }
    protected function configure(): void
    {
        $this->addArgument('date', InputArgument::OPTIONAL, 'Дата');
        parent::configure();
    }
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        //Создание объекта SymfonyStyle для улучшенного вывода в консоль php bin/console app:check-news 2024-06-25
        $io = new SymfonyStyle($input, $output);
        //получаем аргумент переданный команде
        $date = $input->getArgument('date');

        $dt = null;
        if ($date) {
            try {
                $dt = new DateTimeImmutable($date);
            } catch (Exception $error) {
                $output->writeln(sprintf('<error>Ошибка валидации: %s</error>', $error->getMessage()));
                return Command::FAILURE;
            }
        }

        $categories = $this->newsService->getCategories();

        // Отправляем каждую категорию в очередьz
        /**
         * @var NewsCategory $category
         */
        foreach ($categories as $category) {
            $message = new NewsCategoryMessage($category->getTitle());
            $this->messageBus->dispatch($message);
            $output->writeln(sprintf('Категория "%s" отправлена в очередь.', $category->getTitle()));
        }


        //$this->newsService->saveAllNews($dt);

        return Command::SUCCESS;
    }
}
