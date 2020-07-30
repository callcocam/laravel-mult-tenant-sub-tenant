<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Tenant\Http\AbstractController;

class PostController extends AbstractController
{


    protected $model = Post::class;
    protected $route = "posts";
    protected $template= "posts";
    protected $relationship= 'user.tenant';

    public function store(PostRequest $request)
    {
        return parent::_store($request);
    }


    public function update(PostRequest $request, $id)
    {
        return parent::_update($request, $id);
    }
}
