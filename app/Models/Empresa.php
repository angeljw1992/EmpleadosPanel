<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresa extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'empresas';

    public static $searchable = [
        'businessname',
        'ruc',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'businessname',
        'ruc',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function unidadDeNegocioEmpleados()
    {
        return $this->hasMany(Empleado::class, 'unidad_de_negocio_id', 'id');
    }
}
