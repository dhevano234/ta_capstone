<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    use HasFactory;

    protected $table = 'antrian';

    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'gender',
        'no_antrian',
        'urutan',
        'poli',
        'doctor_id',
        'tanggal',
        'status',
        'jam_antrian',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'jam_antrian' => 'datetime:H:i',
    ];

    protected $attributes = [
        'status' => 'menunggu',
    ];

    // ============================================================================
    // RELATIONSHIPS
    // ============================================================================

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'doctor_id');
    }

    // ============================================================================
    // STATIC METHODS
    // ============================================================================

    public static function generateNoAntrian($poli, $tanggal)
    {
        $prefix = $poli === 'Umum' ? 'U' : 'K';
        $date = date('ymd', strtotime($tanggal));
        
        $lastAntrian = self::where('poli', $poli)
                          ->where('tanggal', $tanggal)
                          ->orderBy('no_antrian', 'desc')
                          ->first();
        
        if ($lastAntrian) {
            $lastNumber = (int) substr($lastAntrian->no_antrian, -3);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        
        return $prefix . $date . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }

    public static function generateUrutan($poli, $tanggal)
    {
        $lastUrutan = self::where('poli', $poli)
                         ->where('tanggal', $tanggal)
                         ->max('urutan');
        
        return $lastUrutan ? $lastUrutan + 1 : 1;
    }

    // ============================================================================
    // HELPER METHODS
    // ============================================================================

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'menunggu' => 'warning',
            'dipanggil' => 'info',
            'selesai' => 'success',
            'dibatalkan' => 'danger',
            default => 'secondary'
        };
    }

    public function getFormattedTanggalAttribute()
    {
        return $this->tanggal->format('d/m/Y');
    }

    public function canEdit()
    {
        return $this->status === 'menunggu' && $this->tanggal >= today();
    }

    public function canCancel()
    {
        return $this->status === 'menunggu' && $this->tanggal >= today();
    }
}