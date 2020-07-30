<?php

namespace Tenant;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Tenant extends Model
{
    protected $fillable = ['tenant_id','name','asset'];

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model){
            $model->uuid = Uuid::uuid4();
        });
    }

    public function users(){

        return $this->hasMany(User::class);
    }


    public function filiais(){

        return $this->hasMany(Tenant::class);
    }
}
