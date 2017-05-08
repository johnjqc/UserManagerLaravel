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

    public function user()
    {

        return $this->belongsTo('App\Models\User');

    }
}
