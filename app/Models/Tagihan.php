<?php

namespace App\Models;

use App\Models\User;
use App\Models\Siswa;
use App\Traits\HasFormatRupiah;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tagihan extends Model
{
    use HasFactory;
    use HasFormatRupiah;
    protected $guarded = [];
    protected $dates = ['tanggal_tagihan','tanggal_jatuh_tempo'];
    

    /**
     * Get the user that owns the Tagihan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function siswa(): BelongsTo {
        return $this->belongsTo(Siswa::class);
    }
    protected static function booted()
    {
        static::creating(function($tagihan) {
            $tagihan->user_id=auth()->user()->id;
        });
        static::updating(function($tagihan) {
            $tagihan->user_id=auth()->user()->id;
        });
    }
}
