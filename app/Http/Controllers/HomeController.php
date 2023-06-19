<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Result;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home',[
            'games' =>  Game::all(),
        ]);
    }

    public function addGame(Request $request){
        $validate = $this->validate($request, [
            'name' => 'required|min:5',
        ]);

        if($validate){
            Game::create($request->all());
            return redirect()->route('home');
        }

        return back()->withErrors($validate);
    }

    public function addResults($id){
        $last_three_results = Result::where('game_id',$id)->latest()->take(3)->get();
        $older_weeks = Result::where('game_id',$id)->orderBy('id','Desc')->skip(3)->take(1000000)->get();
        // dd($last_three_results);
        $two_weeks = 0;
        $last_week = 0;
        $current_week = 0;
        if (count($last_three_results) >= 3) {

            $two_weeks = $last_three_results[2];
            $last_week = $last_three_results[1];
            $current_week = $last_three_results[0];
        }elseif (count($last_three_results) == 2) {

            $last_week = $last_three_results[1];
            $current_week = $last_three_results[0];
        }elseif (count($last_three_results) == 1) {
            $current_week = $last_three_results[0];
        }


        return view('results',[
            'game' => Game::findOrFail($id),
            'current_week' => $current_week,
            'last_week' => $last_week,
            'two_weeks' => $two_weeks,
            'older_weeks' => $older_weeks,

        ]);
    }

    public function storeResults(Request $request, $id){
        
        $validate = $this->validate($request, [
            'results1' => 'required',
            'results2' => 'required',
            'results3' => 'required',
            'results4' => 'required',
            'results5' => 'required',
        ]);
        if($validate){
            $results = [$request->results1,$request->results2,$request->results3,$request->results4,$request->results5];
            Result::create([
                'game_id' => $id,
                'results' => $results,
            ]);
            return redirect()->route('game.results',$id);
        }
        return back()->withErrors($validate);

    }

    public function updateResults(Request $request){

        $validate = $this->validate($request, [
            'results1' => 'required',
            'results2' => 'required',
            'results3' => 'required',
            'results4' => 'required',
            'results5' => 'required',
            'id' => 'required',
            'gameid' => 'required',
        ]); 
        if($validate){
            $results = [$request->results1,$request->results2,$request->results3,$request->results4,$request->results5];
            $result_item = Result::findOrFail($request->id);
            $result_item->update([
                'results' => $results,
            ]);
            return redirect()->route('game.results',$request->gameid);
        }
        return back()->withErrors($validate);
    }
}
