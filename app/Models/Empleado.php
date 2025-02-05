<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Empleado extends Model implements HasMedia
{
    use InteractsWithMedia, Auditable, HasFactory;

    public $table = 'empleados';

    protected $appends = [
        'profilepic',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static $searchable = [
        'id_employee',
        'first_name',
        'last_names',
        'cedula',
    ];

    protected $fillable = [
        'id_employee',
        'first_name',
        'last_names',
        'cedula',
        'unidad_de_negocio_id',
        'contrato_desde_id',
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

    public function contratoContratos()
    {
        return $this->hasMany(Contrato::class, 'contrato_id', 'id');
    }

    public function empleadoDocumentos()
    {
        return $this->hasMany(Documento::class, 'empleado_id', 'id');
    }

    public function getProfilepicAttribute()
    {
        $file = $this->getMedia('profilepic')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function unidad_de_negocio()
    {
        return $this->belongsTo(Empresa::class, 'unidad_de_negocio_id');
    }

    public function contrato_desde()
    {
        return $this->belongsTo(Contrato::class, 'contrato_desde_id');
    }
}
