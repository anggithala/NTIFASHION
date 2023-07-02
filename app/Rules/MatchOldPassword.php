<?php

namespace App\Rules;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class MatchOldPassword implements Rule
{
    public function passes($attribute, $value)
    {
        return Hash::check($value, Auth::user()->password);
    }

    public function message()
    {
        return 'The current password is incorrect.';
    }
}
