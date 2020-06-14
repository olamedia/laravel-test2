<?php
declare(strict_types=1);

namespace App\Validators;

use Illuminate\Validation\Validator;

final class UserValidator
{
    /**
     * @var string[] validation rules for user creation
     */
    private $createRules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string',
        'password' => 'required|string'
    ];

    /**
     * Returns validation rules for user creation.
     */
    public function getCreateRules(): array
    {
        return $this->createRules;
    }

    /**
     * Validate data for user creation.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validateCreate(array $data): array
    {
        /** @var \Illuminate\Validation\Validator $validator */
        $validator = Validator::make($data, $this->createRules);

        return $validator->validate();
    }
}
