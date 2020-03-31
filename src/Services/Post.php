<?php


namespace App\Services;


use Exception;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Post
 * @package App\Services
 */
class Post
{
    /**
     * @var string
     */
    private string $title;

    /**
     * @var string
     */
    private string $text;

    /**
     * @var string
     */
    private string $imagem;

    /**
     * @var array
     */
    private array $categorias;

    /**
     * @var string
     */
    private string $slug;

    /**
     * @var string
     */
    private string $thumbnail;

    /**
     * @var string
     */
    private string $createdAt;

    /**
     * @var string
     */
    private string $updatedAt;

    private string $excerpt;

    /**
     * Post constructor.
     * @param string $title
     * @param string $text
     * @param string $imagem
     * @param array $categorias
     * @param string $slug
     * @param string $thumbnail
     * @param string $createdAt
     * @param string $updatedAt
     */
    public function __construct(string $title, string $text, string $imagem, array $categorias, string $slug, string $thumbnail, string $createdAt, string $updatedAt, string $excerpt)
    {
        $this->title = $title;
        $this->text = $text;
        $this->imagem = $imagem;
        $this->categorias = $categorias;
        $this->slug = $slug;
        $this->thumbnail = $thumbnail;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->excerpt = $excerpt;
    }

    /**
     * @return ResponseInterface
     */
    public function store(): ResponseInterface
    {
        $formParams = [
            'titulo' => $this->title,
            'texto' => $this->text,
            'imagem' => $this->imagem,
            'categorias[]' => $this->categorias,
            'slug' => $this->slug,
            'thumbnail' => $this->thumbnail,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
            'excerpt' => $this->excerpt
        ];

        try {
            return (new Client)->post('https://construtoraplaneta.com.br/blogpost', [
                'form_params' => $formParams
            ]);
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }

    }
}