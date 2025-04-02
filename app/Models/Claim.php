<?php

namespace App\Models;

use App\Models\FailedClaim;
use App\Models\ApprovedClaims;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Claim extends Model
{
    /** @use HasFactory<\Database\Factories\ClaimFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function failed_claims()
    {
        return $this->hasMany(FailedClaim::class);
    }

    public function approved_claims()
    {
        return $this->hasMany(ApprovedClaims::class);
    }
}
