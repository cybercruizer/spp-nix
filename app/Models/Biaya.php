<?php

namespace App\Models;

use App\Traits\HasFormatRupiah;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Biaya extends Model
{
    use HasFactory;
    use HasFormatRupiah;
    protected $guarded = [];
    protected $append = ['nama_biaya_full'];

    protected function namaBiayaFull(): Attribute
    {
        return Attribute::make(
            get: fn ($value)=>$this->nama . ' --- ' . $this->formatRupiah('jumlah'),
        );
    }

    /**
     * Get the user that owns the Biaya
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected static function booted()
    {
        static::creating(function($biaya) {
            $biaya->user_id=auth()->user()->id;
        });
        static::updating(function($biaya) {
            $biaya->user_id=auth()->user()->id;
        });
    }
}
