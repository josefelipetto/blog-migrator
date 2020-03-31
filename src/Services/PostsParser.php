<?php


namespace App\Services;


use stdClass;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class Posts
 * @package App\Services
 */
class PostsParser
{
    /**
     * @var array
     */
    private array $posts;

    /**
     * @var OutputInterface
     */
    private OutputInterface $output;

    /**
     * Posts constructor.
     * @param array $posts
     * @param OutputInterface $output
     */
    public function __construct(array $posts, OutputInterface $output)
    {
        $this->posts = $posts;
        $this->output = $output;
    }

    /**
     * Parses out posts
     */
    public function parse(): void
    {

        foreach ($this->posts as $post) {

            $categories = $this->extractPostCategories($post['categories']);

            $imageUrl = '';

            if (is_array($post['_links']['wp:featuredmedia'])) {
                $imageUrl = MediaUrlFixer::fix(
                    FeaturedMediaParser::get($post['_links']['wp:featuredmedia'])
                );
            }

            $content = MediaUrlFixer::fix($post['content']['rendered'], false);

            $content = LinkUrlFixer::fix($content);

            $postModel = new Post(
                $post['title']['rendered'],
                $content,
                $imageUrl,
                $categories,
                $post['slug'],
                $imageUrl,
                $post['date'],
                $post['modified'],
                $post['excerpt']['rendered']
            );

            $outcome = $postModel->store()->getStatusCode();

            if ($outcome === 201) {
                $this->output->writeln("<info> Post {$post['link']} successfully migrated </info>");
                continue;
            }

            $this->output->writeln("<error> Post {$post['link']} couldnt be migrated. </error>");
        }

    }

    /**
     * @param $categories
     * @return array
     */
    private function extractPostCategories($categories): array
    {
        $extractedCategories = [];

        foreach ($categories as $category) {
            $extractedCategories[] = CategoriesDefinitions::getOctoberCategoryId($category);
        }

        return $extractedCategories;
    }

}