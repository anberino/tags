<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <title>{{config('app.name', 'LSAPP')}}</title>
    </head>
    <h1>Criar nova Tag</h1>
    {!! Form::open(['action' => 'TagsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('name', 'Nome')}}
            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Nome'])}}
        </div>
        <div class="form-group">
            {{Form::label('descricao', 'Descrição')}}
            {{Form::text('description', '', ['class' => 'form-control', 'placeholder' => 'Descrição'])}}
        </div>
        <div class="form-group">
            {{Form::label('categoria', 'Categoria')}}
            {{Form::text('category', '', ['class' => 'form-control', 'placeholder' => 'Categoria'])}}

        <div class="form-group">
            {{Form::label('equivalencia', 'Equivalência')}}
            {{Form::text('is', '', ['class' => 'form-control', 'placeholder' => 'Equivalência'])}}

            
        </div>
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}