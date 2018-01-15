<?php

namespace App;

<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 0bd903a789ae00d439b682e51c8d16accf9fd4d2

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract 
{
    use Authenticatable, CanResetPassword;
<<<<<<< HEAD
=======
=======
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
>>>>>>> 08a55450e173585e40593a58e731a854be991121
>>>>>>> 0bd903a789ae00d439b682e51c8d16accf9fd4d2

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 0bd903a789ae00d439b682e51c8d16accf9fd4d2
    
        /**
       * The database table used by the model.
       *
       * @var string
       */
    protected $table = 'users';
      
      // user has many posts
    public function reviews()
    {
      return $this->hasMany('App\Reviews','author_id');
    }
    // user has many comments
    public function comments()
    {
      return $this->hasMany('App\Comments','from_user');
    }
    public function can_post()
    {
      $role = $this->role;
      if($role == 'author' || $role == 'admin')
      {
        return true;
      }
      return false;
    }
    public function is_admin()
    {
      $role = $this->role;
      if($role == 'admin')
      {
        return true;
      }
      return false;
    }
<<<<<<< HEAD
=======
=======
>>>>>>> 08a55450e173585e40593a58e731a854be991121
>>>>>>> 0bd903a789ae00d439b682e51c8d16accf9fd4d2
}
