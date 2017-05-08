<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Social extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'social_accounts';

    protected $fillable = ['user_id', 'provider_user_id', 'provider'];

    public function user()
    {

        return $this->belongsTo('App\User');

    }
}
