<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contrato extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'contratos';

    public const CONTRATOESTADO_SELECT = [
        'enabled'  => 'Activo',
        'disabled' => 'Vencido',
    ];

    protected $dates = [
        'contratodesde',
        'contratohasta',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'contrato_id',
        'contratodesde',
        'contratohasta',
        'contratoestado',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function contrato()
    {
        return $this->belongsTo(Empleado::class, 'contrato_id');
    }

    public function getContratodesdeAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setContratodesdeAttribute($value)
    {
        $this->attributes['contratodesde'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getContratohastaAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setContratohastaAttribute($value)
    {
        $this->attributes['contratohasta'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
}
