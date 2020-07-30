<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Tenant\Traits\TenantTrait;

class Post extends Model
{
    use TenantTrait;

    protected $fillable = [
        'user_id','name', 'image','description',
    ];

    public function user(){

        return $this->belongsTo(User::class);
    }

    public function getCoverAttribute(){
      return  ($this->image) ? url("storage/tenant/{$this->user->tenant->uuid}/posts/{$this->image}") : url('imgs/posts/default.png');
    }
}
