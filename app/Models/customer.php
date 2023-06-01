<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    protected $table = 'customers';
    protected $primarykey = 'id';
    public  $timestamps = true;
    protected $fillable = [
        'nama_restoran',
        'nama_pelanggan',
        'email_pelanggan',
        'tanggal_booking',
        'jenis_makanan',
        'nomor_meja',
        'status_booking',
    ];
}
