<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Model\Role;

class User extends Authenticatable
{

  use Notifiable;

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'users';

  /**
   * The attributes that are not mass assignable.
   *
   * @var array
   */
  protected $guarded = ['id'];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'name',
      'email',
      'phone',
      'password',
      'activated',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
      'password',
      'remember_token',
      'activated',
  ];

  protected $dates = [
      'deleted_at'
  ];

  /**
   * Build Social Relationships
   *
   * @var array
   */
  public function social()
  {
      return $this->hasMany('App\Models\Social');
  }

    public function roles() {
        return $this->belongsToMany(Role::class);
    }
}
