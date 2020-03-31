<?php


namespace App\Commands;


use App\Services\Posts;
use App\Services\WordpressAPI;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MigrateCommand extends Command
{
    protected static $defaultName = 'migrate';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        foreach (range(1,2) as $page) {

            $output->writeln('<comment> Requesting to ' . WordpressAPI::getUrl($page) . '</comment>');
            $response = WordpressAPI::getPosts($page);

            $posts = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

            (new Posts($posts, $output))->parse();

        }

        $output->writeln('<info> Migration completed successfully </info>');

        return 1;
    }
}