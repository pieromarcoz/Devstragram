@extends('layouts.app')

@section('titulo')
    Página Princpal
@endsection

@section('contenido')

    <x-listar-post :posts="$posts"/>

@endsection
