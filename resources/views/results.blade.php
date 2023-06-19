@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#results">
                        Add Results
                    </button>
                    <h5 class="text-center">{{$game->name}} Results</h5>

                </div>

                <div class="card-body">
                <table class="table">
                    <!-- <thead>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>Action</th>

                    </thead> -->
                    <tbody id="results_tb">
                        <!-- older results -->
                        @if(count($older_weeks) > 0)
                        @foreach($older_weeks as $result)
                        <tr>
                            @foreach($result->results as $key => $value)
                                @if(in_array($result->results[$key], $current_week->results))
                                <td class="text-success">{{$result->results[$key]}}</td>
                            
                                @elseif(in_array($result->results[$key], $last_week->results))
                                <td class="text-warning">{{$result->results[$key]}}</td>
                            
                                @elseif(in_array($result->results[$key], $two_weeks->results))
                                <td class="text-danger">{{$result->results[$key]}}</td>
                                @else
                                    <td>{{$result->results[$key]}}</td>
                                @endif
                            @endforeach
                            <td
                                data-id="{{$result->id}}" 
                                data-gameid="{{$result->game_id}}" 
                                data-result1="{{$result->results[0]}}"
                                data-result2="{{$result->results[1]}}"
                                data-result3="{{$result->results[2]}}"
                                data-result4="{{$result->results[3]}}"
                                data-result5="{{$result->results[4]}}"
                            >
                                <a href="#" class="btn btn-primary">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                        @endif

                        <!-- two weeks -->
                        @if(!empty($two_weeks))
                        <tr>
                            <td class="text-danger">{{$two_weeks->results[0]}}</td>
                            <td class="text-danger">{{$two_weeks->results[1]}}</td>
                            <td class="text-danger">{{$two_weeks->results[2]}}</td>
                            <td class="text-danger">{{$two_weeks->results[3]}}</td>
                            <td class="text-danger">{{$two_weeks->results[4]}}</td>
                            <td
                                data-id="{{$two_weeks->id}}" 
                                data-gameid="{{$two_weeks->game_id}}" 
                                data-result1="{{$two_weeks->results[0]}}"
                                data-result2="{{$two_weeks->results[1]}}"
                                data-result3="{{$two_weeks->results[2]}}"
                                data-result4="{{$two_weeks->results[3]}}"
                                data-result5="{{$two_weeks->results[4]}}"
                            >
                                <a href="#" class="btn btn-primary">Edit</a>
                            </td>
                        </tr>
                        @endif

                        <!-- one week -->
                        @if(!empty($last_week))
                        <tr>
                            <td class="text-warning">{{$last_week->results[0]}}</td>
                            <td class="text-warning">{{$last_week->results[1]}}</td>
                            <td class="text-warning">{{$last_week->results[2]}}</td>
                            <td class="text-warning">{{$last_week->results[3]}}</td>
                            <td class="text-warning">{{$last_week->results[4]}}</td>
                            <td
                                data-id="{{$last_week->id}}"
                                data-gameid="{{$last_week->game_id}}"  
                                data-result1="{{$last_week->results[0]}}"
                                data-result2="{{$last_week->results[1]}}"
                                data-result3="{{$last_week->results[2]}}"
                                data-result4="{{$last_week->results[3]}}"
                                data-result5="{{$last_week->results[4]}}"
                            >
                                <a href="#" class="btn btn-primary">Edit</a>
                            </td>
                        </tr>
                        @endif

                        <!-- current week -->
                        @if(!empty($current_week))
                        <tr>
                            <td class="text-success">{{$current_week->results[0]}}</td>
                            <td class="text-success">{{$current_week->results[1]}}</td>
                            <td class="text-success">{{$current_week->results[2]}}</td>
                            <td class="text-success">{{$current_week->results[3]}}</td>
                            <td class="text-success">{{$current_week->results[4]}}</td>
                            <td    
                                data-id="{{$current_week->id}}" 
                                data-gameid="{{$current_week->game_id}}" 
                                data-result1="{{$current_week->results[0]}}"
                                data-result2="{{$current_week->results[1]}}"
                                data-result3="{{$current_week->results[2]}}"
                                data-result4="{{$current_week->results[3]}}"
                                data-result5="{{$current_week->results[4]}}"
                            >
                                <a href="#" class="btn btn-primary">Edit</a>
                            </td>
                        </tr>
                        @endif
                    
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Add Results Modal -->
<div class="modal fade" id="results" tabindex="-1" aria-labelledby="results" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Results</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
      <div class="modal-body">
            <form action="{{route('result.store',$game->id)}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="game_name" class="form-label">Enter Results</label>
                    <div class="row">
                        <div class="col-sm-2">
                            <input type="number" class="form-control @error('results1') is-invalid @enderror" min="0" name="results1" aria-describedby="game_name" required>
                            @error('results1')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-2">
                            <input type="number" class="form-control @error('results2') is-invalid @enderror" min="0" name="results2" aria-describedby="game_name" required>
                            @error('results2')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-2">
                            <input type="number" class="form-control @error('results3') is-invalid @enderror" min="0" name="results3" aria-describedby="game_name" required>
                            @error('results3')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-2">
                            <input type="number" class="form-control @error('results4') is-invalid @enderror" min="0" name="results4" aria-describedby="game_name" required>
                            @error('results4')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-2">
                            <input type="number" class="form-control @error('results5') is-invalid @enderror" min="0" name="results5" aria-describedby="game_name"  required>
                            @error('results5')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
               
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Save Result</button>
                </div>
            </form>
      </div>
      <div class="modal-footer">
      
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Edit Results Modal -->
<div class="modal fade" id="edit_results" tabindex="-1" aria-labelledby="edit_results" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Results</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
      <div class="modal-body">
            <form action="{{route('result.update')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="game_name" class="form-label">Add Results</label>
                    <div class="row">
                        <div class="col-sm-2">
                            <input type="number" class="results1 form-control @error('results1') is-invalid @enderror" min="0" name="results1" aria-describedby="game_name" required>
                            @error('results1')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-2">
                            <input type="number" class="results2 form-control @error('results2') is-invalid @enderror" min="0" name="results2" aria-describedby="game_name" required>
                            @error('results2')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-2">
                            <input type="number" class="results3 form-control @error('results3') is-invalid @enderror" min="0" name="results3" aria-describedby="game_name" required>
                            @error('results3')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-2">
                            <input type="number" class="results4 form-control @error('results4') is-invalid @enderror" min="0" name="results4" aria-describedby="game_name" required>
                            @error('results4')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-2">
                            <input type="number" class="results5 form-control @error('results5') is-invalid @enderror" min="0" name="results5" aria-describedby="game_name"  required>
                            @error('results5')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <!-- hidden id -->
                            <input type="text" class="results_id" name="id" hidden>
                            <input type="text" class="game_id" name="gameid" hidden>

                        </div>

                    </div>
               
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Update Result</button>
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
