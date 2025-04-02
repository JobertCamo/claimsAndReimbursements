<?php

namespace App\Models;

use App\Models\User;
use App\Models\Claim;
use Illuminate\Database\Eloquent\Model;

class ApprovedClaims extends Model
{
    protected $guarded = ['id'];

    public function claim()
    {
        return $this->belongsTo(Claim::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
