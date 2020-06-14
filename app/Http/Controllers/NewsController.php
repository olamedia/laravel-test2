<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Article;
use App\Services\NewsService;
use App\Validators\NewsArticleValidator;
use Illuminate\Http\Request;

final class NewsController extends Controller
{
    /**
     * @var \App\Services\NewsService
     */
    private $newsService;

    /**
     * @var \App\Validators\NewsArticleValidator
     */
    private $newsValidator;

    /**
     * NewsController constructor.
     */
    public function __construct(NewsService $newsService, NewsArticleValidator $newsValidator)
    {
        $this->newsService = $newsService;
        $this->newsValidator = $newsValidator;
    }

    /**
     * Creates new article.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function add(Request $request)
    {
        $validatedData = $this->newsValidator->validateCreateRequest($request);

        $article = $this->newsService->createArticle($validatedData);

        return response()->json($article->jsonSerialize());
    }

    /**
     * List articles with pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function list(Request $request)
    {
        $validatedData = $this->newsValidator->validateListRequest($request);

        $paginator = $this->newsService->listArticles($validatedData);

        return response()->json([
            'meta' => [
                'page' => [
                    'current-page' => $paginator->currentPage(),
                    'per-page' => $paginator->perPage(),
                    'from' => $paginator->firstItem(),
                    'to' => $paginator->lastItem(),
                    'total' => $paginator->total(),
                    'last-page' => $paginator->lastPage()
                ]
            ],
            'data' => [
                'articles' => $paginator->items()
            ]
        ]);
    }
}
