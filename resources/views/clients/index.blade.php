@extends('layout')

@section('content')
<h1>Clients</h1>

<ul>
    @foreach($clients as $client)
        <li>{{ $client->name }} <em class = "text-muted">{{ $client->entreprise->name }} </em></li>
    @endforeach
</ul>
<hr>
<form action="clients" method="POST">
    @csrf
    <div class="form-group">
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder ="Rentrez un pseudo...">
        @error('name')
            <div class="invalid-feedback">
                {{$errors->first('name')}}
            </div>
        @enderror
    </div>
    <div class="form-group">
        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder = "Rentrez un email">
        @error('email')
        <div class="invalid-feedback">
            {{$errors->first('email')}}
        </div>
        @enderror
    </div>
    <div class="form-group">
        <select class="custom-select @error('status') is-invalid @enderror" name="status">
            <option value="1">Actif</option>
            <option value="0">Inactif</option>
        </select>
        @error('status')
        <div class="invalid-feedback">
            {{$errors->first('status')}}
        </div>
        @enderror
    </div>
    <div class="form-group">
        <select class="custom-select @error('entreprise_id') is-invalid @enderror" name="entreprise_id">
            @foreach($entreprises_ as $entreprise)
        <option value="{{ $entreprise->id }}">{{ $entreprise->name }}</option>
            @endforeach
        </select>
        @error('entreprise_id')
        <div class="invalid-feedback">
            {{$errors->first('entreprise_id')}}
        </div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Ajouter le client</button>
</form>
@endsection