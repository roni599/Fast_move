<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'business_name' => ['required', 'string', 'max:255'],
            'merchant_name' => ['required', 'string', 'max:255'],
            'pick_up_location' => ['required', 'string', 'max:255'],
            'phone' => ['required'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
            'nid_front' => ['required'],
            'nid_back' => ['required'],
            'profile_img' => ['required', 'max:2048'], // Assuming profile is an image file and not exceeding 2MB
        ])->validate();

        $user = User::create([
            'business_name' => $input['business_name'],
            'merchant_name' => $input['merchant_name'],
            'pick_up_location' => $input['pick_up_location'],
            'phone' => $input['phone'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'nid_front' => '',
            'nid_back' => '',
            'profile_img' => '',
        ]);

        if (isset($input['nid_front'])) {
            $nid_front = $input['nid_front']->move('merchant/nid-photos/'. $user->id, $user->merchant_name.'_'.$input['nid_front']->getClientOriginalName(), '');
            $user->update(['nid_front' => $nid_front]);
        }

        if (isset($input['nid_back'])) {
            $nid_back = $input['nid_back']->move('merchant/nid-photos/'. $user->id, $user->merchant_name.'_'.$input['nid_back']->getClientOriginalName(), '');
            $user->update(['nid_back' => $nid_back]);
        }

        if (isset($input['profile_img'])) {
            $profile_img = $input['profile_img']->move('merchant/profile-photos/'. $user->id, $user->merchant_name.'_'.$input['profile_img']->getClientOriginalName(), '');
            $user->update(['profile_img' => $profile_img]);
        }

        return $user;
    }
}
