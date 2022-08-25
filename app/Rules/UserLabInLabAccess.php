<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UserLabInLabAccess implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(protected array|null $labAccess)
    {}

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if ($this->labAccess === null) 
            return true;
        
        return in_array($value, $this->labAccess);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El laboratorio asociado debe estar seleccionado en acceso a laboratorios.';
    }
}
