<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }

    /**
     * @todo text
     * @throws \Exception
     * @return void
     */
    public function registere()
    {
        $command = Create\Command::fromRequest($this);

        try {
            $user = $this->create->handle($command);
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }

        event(new Registered($user));

        Auth::login($user);
    }

}
