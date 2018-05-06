<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @param array
     */
    protected $fillable = [
         'name', 'email', 'phoneNumber', 'ipAddress','profilePicture','source','password',
    ];

    /**param
     * The attributes that should be hidden for arrays.
     *
     * @param array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

     /**
     * get User with email
     *
     * @param email
    */
    public function findByEmail($email) {
        $user = User::where('email', $email)->first();
        return $user; 
    }

    /**
     * Function to update last login of the user
     * @param $email
    */
    public function updateLastLogin($email) {
        $date= date('Y-m-d h:i:s');
        $user = $this->findByEmail($email);
        $user->update(['updated_at' => $date]);
        return $user;
    }
}
