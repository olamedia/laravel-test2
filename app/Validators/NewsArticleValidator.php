<?php
declare(strict_types=1);

namespace App\Validators;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

final class NewsArticleValidator
{
    /**
     * @var string[] validation rules for article creation
     */
    private $createRules = [
        'title' => 'required|string|max:255',
        'text' => 'required|string'
    ];

    private $listRules = [
        'page' => 'numeric',
        'perPage' => 'numeric|max:100'
    ];

    /**
     * Returns validation rules for article creation.
     */
    public function getCreateRules(): array
    {
        return $this->createRules;
    }

    /**
     * Validate data for article creation.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validateCreate(array $data): array
    {
        /** @var \Illuminate\Validation\Validator $validator */
        $validator = Validator::make($data, $this->createRules);

        return $validator->validate();
    }

    /**
     * Validate request data for article creation.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validateCreateRequest(Request $request): array
    {
        /** @var \Illuminate\Validation\Validator $validator */
        $validator = Validator::make($request->all(), $this->createRules);

        return $validator->validate();
    }

    /**
     * Validate request data for article creation.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validateListRequest(Request $request): array
    {
        /** @var \Illuminate\Validation\Validator $validator */
        $validator = Validator::make($request->all(), $this->listRules);

        return $validator->validate();
    }
}
