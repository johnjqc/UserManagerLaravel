<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model 
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'level'];
    
	public function user() {
        return $this->belongsTo(User::class);
    }
}