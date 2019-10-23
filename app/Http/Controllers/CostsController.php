<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cost;
use App\Category;
class CostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $sum = Cost::sum('amount');
        $costs = Cost::paginate(4);
        $years = Cost::selectRaw('year(added_on) as year')->distinct()->get();
        return view('costs')->with(compact('costs', 'sum', 'years'));
    }

    public function filter(Request $request)
    {           $sum = 0;
         

        if($request->year && $request->month)
         {   
             $years = Cost::selectRaw('year(added_on) as year')->distinct()->get();
             $costs = Cost::select('id','note','amount', 'added_on', 'category_id')
             ->selectRaw('year(added_on) as year')->having('year', '=',$request->year)
             ->selectRaw('month(added_on) as month')->having('month', '=',$request->month)
             ->get();

             foreach($costs as $c)
                $sum += $c->amount;
         
                
        }
        return view('costs')->with(compact('costs', 'sum', 'years'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
     
        return view('costs.create')->with(compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $cost = new Cost;
        $cost->note = $request->note;
        $cost->amount = $request->amount;
        $cost->category_id = $request->category_id;
        $cost->added_on = $request->added_on;
        $cost->image = $request->image;
        $cost->save();
        return redirect()->route('costs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cost = Cost::findOrFail($id);
        return view('costs.edit')->with(compact('cost'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cost = Cost::findOrFail($id);
        $cost->note = $request->note;
        $cost->amount = $request->note;
        $cost->category_id = $request->category_id;
        $cost->image = $request->image;


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cost = Cost::findOrFail($id);
        $cost->delete();
        return redirect()->route('costs.index');

    }
}
