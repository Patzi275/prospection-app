@extends('layouts.master')

@section('title', 'Prospection - liste')

@section('content')
<div>
  <h3>Liste des prospections</h3>
  <div class="my-5">
    <form action="{{ route('prospections.index') }}" method="GET">
      @csrf
      <div class="d-flex flex-wrap">
        <div>
          <label class="visually-hidden" for="first_date">Début</label>
          <input type="date" class="form-control-sm" id="first_date" value="{{ $first_date }}" name="first_date" placeholder="">
        </div>
        <span class="mx-3">à</span>
        <div>
          <label class="visually-hidden" for="last_date">Fin</label>
          <input type="date" class="form-control-sm" id="last_date" value="{{ $last_date }}" name="last_date" placeholder="">
        </div>
      </div>
      <input type="submit" class="btn btn-sm btn-primary mt-3" value="Appliquer">
    </form>

  </div>
  
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

  <div class="card">
    <div class="card-header d-flex justify-content-between">
      <div class="fw-bold">{{ $prospections->total() ? ('Page '.$prospections->currentPage().' sur '.$prospections->lastPage()) : '' }}</div>
      <form action="{{ route('prospections.export') }}" method="GET">
        @csrf
          <input type="date" class="form-control-sm" id="first_date_exp" value="{{ $first_date }}" name="first_date_exp" hidden >
        
          <input type="date" class="form-control-sm" id=last_date_exp" value="{{ $last_date }}" name="last_date_exp" hidden >
        <input type="submit" class="btn btn-sm btn-success" value="Exporter excel">
      </form>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nom du client</th>
              <th scope="col">Date</th>
              <th scope="col">Produit</th>
              <th scope="col">Statut</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            @if($prospections->total())
            @foreach ($prospections as $prospection)
            <tr>
              <th scope="row">{{ $prospection->id }}</th>
              <td>{{ $prospection->client_name }}</td>
              <td>{{ $prospection->date }}</td>
              <td>{{ $prospection->product }}</td>
              <td>
                @if ($prospection->is_sold)
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                  class="feather feather-check-square">
                  <polyline points="9 11 12 14 22 4"></polyline>
                  <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                </svg>
                @else
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                  class="feather feather-square">
                  <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                </svg>
                @endif
              </td>
              <td>
                <a href="{{ route('prospections.show', $prospection->id) }}" class="btn btn-sm btn-light">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-eye">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                    <circle cx="12" cy="12" r="3"></circle>
                  </svg>
                </a>
                <a href="{{ route('prospections.edit', $prospection->id) }}" class="btn btn-sm btn-light">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-edit">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                  </svg>
                </a>
                <form action="{{ route('prospections.destroy', $prospection->id) }}" method="POST" class="d-inline">
                  @csrf
                  <input type="hidden" name="_method" value="DELETE">
  
                  <button type="submit" class="btn btn-sm btn-light">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                      class="feather feather-trash">
                      <polyline points="3 6 5 6 21 6"></polyline>
                      <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                    </svg>
                  </button>
                </form>
              </td>
            </tr>
            @endforeach
            @else
              <tr>
                <td colspan="6" class="text-center py-4">Vide</td>
              </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <nav aria-label="pagination" class="mt-3">
    {{ $prospections->links() }}
    <!-- <ul class="pagination justify-content-center">
      <li class="page-item {{ $prospections->onFirstPage() ? 'disabled' : '' }}">
        <a href="{{ $prospections->previousPageUrl() }}" class="page-link">Précédent</a>
      </li>
      <li class="page-item"><a class="page-link" href="#">1</a></li>
      <li class="page-item"><a class="page-link" href="#">2</a></li>
      <li class="page-item"><a class="page-link" href="#">3</a></li>
      <li class="page-item {{ $prospections->lastPage() == $prospections->currentPage() ? 'disabled' : '' }}">
        <a href="{{ $prospections->nextPageUrl() }}" class="page-link" href="#">Suivant</a>
      </li>
    </ul> -->
  </nav>
</div>
@endsection