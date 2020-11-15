@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Articulo
                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form action="{{ route('post.store')}}" method="POST" enctype="multipart/form-data">

                        @csrf
                        <div class="form-group">
                            <label>Titulo *</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Imagen</label>
                            <input name="file" type="file">
                        </div>
                        <div class="form-group">
                            <label>Contenido *</label>
                            <textarea name="body" rows="6" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Contenido embebido</label>
                            <textarea name="iframe" class="form-control"></textarea>
                        </div>
                        <div class="form-group">

                            <input type="submit" value="Enviar" class="btn btn-sm btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection