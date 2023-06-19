@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#game">
                        Add New Game
                    </button>
                    <h5 class="text-center">{{ __('Games Table') }}</h5>

                </div>

                <div class="card-body">
                    <!-- games table -->
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Game Name</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($games) > 0)
                            @foreach($games as $game)
                            <tr>
                                <th scope="row">{{$game->id}}</th>
                                <td>{{$game->name}}</td>
                                <td>
                                    <a href="{{route('game.results',$game->id)}}" class="btn btn-primary btn-sm">View Results</a>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan='3'>No Game added Yet!</td>
                            </tr>
                            @endif
                   
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Add game Modal -->
<div class="modal fade" id="game" tabindex="-1" aria-labelledby="game" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Game</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form action="{{route('game.store')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="game_name" class="form-label">Name of Game</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="game_name" name="name" aria-describedby="game_name" placeholder="Enter Name of Game" required>
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Save Game</button>
                </div>
            </form>
      </div>
      <div class="modal-footer">
      
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection
