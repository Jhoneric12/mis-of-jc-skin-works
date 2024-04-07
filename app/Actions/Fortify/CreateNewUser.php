<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

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
        $validator = Validator::make($input, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'birthdate' => ['required', 'date', 'before_or_equal:today'],
            'age' => ['required', 'integer'],
            'skintype' => ['required', 'string', 'max:255'], 
            'civilstatus' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
            'homeaddress' => ['required', 'string'], 
            'contactnumber' => ['required', 'string', 'min:11', 'max:20'],
            // 'username' => ['required', 'string', 'min:8', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ]);

        if ($validator->fails()) {
            throw new \Illuminate\Validation\ValidationException($validator);
        }

        return User::create([
            'first_name' => strtoupper($input['firstname']),
            'middle_name' => strtoupper($input['middlename']),
            'last_name' => strtoupper($input['lastname']),
            'name' => $input['firstname'] . ' ' . $input['middlename'] . ' ' . $input['lastname'],
            'birth_date' => $input['birthdate'],
            'age' => $input['age'],
            'skin_type' => $input['skintype'],
            'civil_status' => $input['civilstatus'],
            'gender' => $input['gender'],
            'home_address' =>  strtoupper($input['homeaddress']),
            'contact_number' => $input['contactnumber'],
            'religion' =>  strtoupper($input['religion']),
            // 'username' => $input['username'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
