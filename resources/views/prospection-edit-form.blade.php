@extends('layouts.master')

@section('content')
<div class="pro-form">
    <h3>Modification de la prospection #{{ $prospection->id }}</h3>

    <form method="POST" action="{{ route('prospections.update', ['prospection' => $prospection->id]) }}"
        class="row g-3 w-75 needs-validation" novalidate>
        @csrf
        <input type="hidden" name="_method" value="PUT">

        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            @foreach ($errors->all() as $error)
            {{ $error.'. ' }}
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session()->get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if(session()->has('failure'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session()->get('failure') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="col-12">
            <label for="agent_name" class="form-label">Nom de l'agent</label>
            <input type="text" class="form-control" name="agent_name" id="agent_name"
                value="{{ $prospection->agent_name }}" placeholder="John Doe" required>
            <div class="invalid-feedback">
                Veuillez remplir ce champs.
            </div>
        </div>
        <div class="col-12">
            <label for="client_name" class="form-label">Nom du client</label>
            <input type="text" class="form-control" name="client_name" id="client_name"
                value="{{ $prospection->client_name }}" placeholder="John Doe" required>
            <div class="invalid-feedback">
                Veuillez remplir ce champs.
            </div>
        </div>
        <div class="col-12">
            <label for="address" class="form-label">Adresse du client</label>
            <input type="text" class="form-control" name="address" id="address" value="{{ $prospection->address }}"
                placeholder="Cotonou, Carré 000" required>
            <div class="invalid-feedback">
                Veuillez remplir ce champs.
            </div>
        </div>
        <div class="col-12">
            <label for="date" class="form-label">Date</label>
            <input type="date" class="form-control" name="date" id="date" value="{{ $prospection->date }}"
                placeholder="dd/MM/YYYY" required>
            <div class="invalid-feedback">
                Veuillez remplir ce champs.
            </div>
        </div>
        <div class="col-6">
            <label for="start_time" class="form-label">Heure de début</label>
            <input type="time" class="form-control" name="start_time" id="start_time"
                value="{{ $prospection->start_time }}" placeholder="hh:mm" required>
            <div class="invalid-feedback">
                Veuillez remplir ce champs.
            </div>
        </div>
        <div class="col-6">
            <label for="end_time" class="form-label">Heure de fin</label>
            <input type="time" class="form-control" name="end_time" id="end_time" value="{{ $prospection->end_time }}"
                placeholder="hh:mm" required>
            <div class="invalid-feedback">
                Veuillez remplir ce champs.
            </div>
        </div>
        <div class="col-12">
            <label for="duration" class="form-label">Durée</label>
            <input type="time" class="form-control" name="duration" id="duration" value="{{ $prospection->duration }}"
                placeholder="0" aria-label="readonly input" readonly required>
            <div class="invalid-feedback">
                Veuillez remplir ce champs.
            </div>
        </div>
        <div class="col-12">
            <label for="product" class="form-label">Produit</label>
            <select class="form-select" name="product" id="product">
                <option value="table" {{ $prospection->product === 'table' ? 'selected' : ''}}>Table</option>
                <option value="chaise" {{ $prospection->product === 'chaise' ? 'selected' : ''}}>Chaise</option>
                <option value="ordinateur" {{ $prospection->product === 'ordinateur' ? 'selected' : ''}}>Ordinateur
                </option>
                <option value="ecran" {{ $prospection->product === 'ecran' ? 'selected' : ''}}>Ecran</option>
            </select>
        </div>
        <div class="col-12">
            <label for="observation">Observations</label>
            <textarea class="form-control" name="observation" id="observation" value="{{ $prospection->observation }}"
                placeholder="Observations du client"></textarea>
        </div>
        <div class="form-check col-12 ms-2">
            <input class="form-check-input" type="checkbox" name="is_sold" id="is_sold" {{ $prospection->is_sold ?
            'checked' : '' }}>
            <label class="form-check-label" for="is_sold">
                Vente conclue ?
            </label>
        </div>

        <div class="col-12 mt-4">
            <button type="submit" class="btn btn-primary">Soumettre</button>
            <a href="{{ route('prospections.index') }}" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div>
@endsection