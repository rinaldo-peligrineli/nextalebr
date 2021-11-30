<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Midia extends Model
{
    use HasFactory;

    protected $fillable = ['url_midia', 'user_id', 'story_id', 'is_enabled'];
     /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function story()
    {
        return $this->belongsTo('App\Models\Story');
    }

     /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
