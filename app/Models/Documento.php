<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Documento extends Model implements HasMedia
{
    use InteractsWithMedia, HasFactory;

    public $table = 'documentos';

    protected $appends = [
        'carne_verde',
        'carne_blanco',
    ];

    protected $dates = [
        'fecha_vencimiento_verde',
        'fecha_vencimiento_blanco',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'empleado_id',
        'fecha_vencimiento_verde',
        'fecha_vencimiento_blanco',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }

    public function getCarneVerdeAttribute()
    {
        return $this->getMedia('carne_verde')->last();
    }

    public function getFechaVencimientoVerdeAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setFechaVencimientoVerdeAttribute($value)
    {
        $this->attributes['fecha_vencimiento_verde'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getCarneBlancoAttribute()
    {
        return $this->getMedia('carne_blanco')->last();
    }

    public function getFechaVencimientoBlancoAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setFechaVencimientoBlancoAttribute($value)
    {
        $this->attributes['fecha_vencimiento_blanco'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
}
