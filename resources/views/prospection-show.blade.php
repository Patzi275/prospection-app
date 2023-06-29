@extends('layouts.master')

@section('content')
<h3>Details de la prospection #{{ $prospection->id }}</h3>
<div class="my-4">
    <div class="mb-2">
        Créé le {{ $prospection->created_at }}
    </div>
    <div>
        <a href="{{ route('prospections.edit', $prospection->id) }}" class="btn btn-sm btn-primary">
            Modifier
        </a>
        <form action="{{ route('prospections.destroy', $prospection->id) }}" method="POST" class="d-inline">
            @csrf
            <input type="hidden" name="_method" value="DELETE">

            <button type="submit" class="btn btn-sm btn-danger">
                Supprimer
            </button>
        </form>
    </div>
</div>
@if(session()->has('failure'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session()->get('failure') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div>
    <table class="table table-bordered pros-details-table">
        <tbody>
            <tr>
                <th scope="col">Nom de l'agent</th>
                <td>{{ $prospection->agent_name }}</td>
            </tr>
            <tr>
                <th scope="col">Nom du client</th>
                <td>{{ $prospection->client_name }}</td>
            </tr>
            <tr>
                <th scope="col">Adresse</th>
                <td>{{ $prospection->address }}</td>
            </tr>
            <tr>
                <th scope="col">Date</th>
                <td>{{ $prospection->date }}</td>
            </tr>
            <tr>
                <th scope="col">Heure du début</th>
                <td>{{ $prospection->start_time }}</td>
            </tr>
            <tr>
                <th scope="col">Heure de fin</th>
                <td>{{ $prospection->end_time }}</td>
            </tr>
            <tr>
                <th scope="col">Durée</th>
                <td>{{ $prospection->duration }}</td>
            </tr>
            <tr>
                <th scope="col">Produit</th>
                <td>{{ $prospection->product}}</td>
            </tr>
            <tr>
                <th scope="col">Observation</th>
                <td>{{ $prospection->observation ? $prospection->observation : 'Aucune' }}</td>
            </tr>
            <tr>
                <th scope="col">Statut</th>
                <td>
                    {{ $prospection->is_sold ? 'Conclu' : 'Non conclu' }}
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection