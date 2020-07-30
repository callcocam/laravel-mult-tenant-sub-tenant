<?php

namespace Tenant\Http;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

abstract class AbstractController extends Controller
{
    /**
     * @var Post
     */
    protected $model;
    protected $prefix;
    protected $route;
    protected $template;
    protected $relationship;
    protected $results =[];
    protected $data =[];
    protected $nameImage = "image";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        if(is_string($this->model))
            $this->model = app($this->model)->query();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if($this->relationship )
            $this->results['rows'] = $this->model->with($this->relationship)->latest()->paginate();
        else
            $this->results['rows'] = $this->model->latest()->paginate();


        if($this->prefix)
          return view(sprintf('%s::%s.index',$this->prefix, $this->template), $this->results);

        return view(sprintf('%s.index', $this->template), $this->results);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if($this->prefix)
          return view(sprintf('%s::%s.create', $this->prefix, $this->template), $this->results);

        return view(sprintf('%s.create', $this->template), $this->results);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function _store($request)
    {
        if(!$this->data)
           $this->data = $request->all();

        $this->preEvent(null, $request);

        $upload = $this->uploads($request);

        if (!$upload)
            return redirect()
                ->back()
                ->with('errors', ['Falha no Upload'])
                ->withInput();

        $this->data['user_id'] = $request->user()->id;
        $model =  $this->model->create($this->data);
        $this->posEvent($model, $request);
        return redirect()
            ->route(sprintf("%s.index", $this->route))
            ->withSuccess('Cadastro realizado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$rows = $this->model->find($id))
            return redirect()->back();

        $this->results['rows'] = $rows;
        if($this->prefix)
          return view(sprintf('%s::%s.show', $this->prefix, $this->template), $this->results);

        return view(sprintf('%s.show', $this->template), $this->results);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$rows = $this->model->find($id))
            return redirect()->back();

        $this->results['rows'] = $rows;

        if($this->prefix)
         return view(sprintf('%s::%s.edit', $this->prefix, $this->template), $this->results);

        return view(sprintf('%s.edit', $this->template), $this->results);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function _update($request, $id)
    {
        if (!$model = $this->model->find($id))
            return redirect()->back()->withInput();
        if(!$this->data)
            $this->data = $request->all();

        $this->preEvent($model, $request);

        $upload = $this->uploads($request, $model);

        if (!$upload)
            return redirect()
                ->back()
                ->with('errors', ['Falha no Upload'])
                ->withInput();

        $model->update($this->data);


        $this->posEvent($model, $request);

        return redirect()
            ->route(sprintf("%s.index", $this->route))
            ->withSuccess('Atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$model = $this->model->find($id))
            return redirect()->back();

        $model->delete();

        return redirect()
            ->route(sprintf("%s.index", $this->route))
            ->withSuccess('Deletado com sucesso!');
    }

    protected function uploads($request,$model=null){

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Remove image if exists
            if ($model && $model->image) {
                if (Storage::exists(sprintf('%s/%s', $this->route,$model->image)))
                    Storage::delete(sprintf('%s/%s', $this->route,$model->image));
            }

            $name = Str::kebab($request->name);
            $extension = $request->image->extension();
            $nameImage = "{$name}.$extension";
            $this->data[$this->nameImage] = $nameImage;
            return $request->image->storeAs($this->route, $nameImage);
        }
        return true;
    }

    protected function posEvent($model , $request){

    }
    protected function preEvent($model , $request){

    }
}
