<?php
declare(strict_types=1);

namespace App\Services;

use App\Article;
use Illuminate\Pagination\LengthAwarePaginator;

final class NewsService
{
    /**
     * Creates article from data array.
     */
    public function createArticle(array $data): Article
    {
        /** @var \App\Article $article */
        $article = Article::create($data);

        return $article;
    }

    /**
     * List articles with pagination.
     */
    public function listArticles(array $data): LengthAwarePaginator
    {
        $page = isset($data['page']) ? $data['page'] : 1;
        $perPage = isset($data['perPage']) ? $data['perPage'] : 25;

        /** @var \Illuminate\Pagination\LengthAwarePaginator $paginator */
        $paginator = Article::query()->paginate($perPage);

        $paginator->forPage($page, $perPage);

        return $paginator;
    }
}
