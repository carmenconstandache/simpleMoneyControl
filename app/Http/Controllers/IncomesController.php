<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Income;
use App\Cost;
class IncomesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sumCosts = Cost::sum('amount');
        $sum = Income::sum('amount');
        $years = Income::selectRaw('year(added_on) as year')->distinct()->get();
        $incomes = Income::paginate(4);
        return view('incomes')->with(compact('incomes', 'sum', 'years', 'sumCosts'));
    }


    public function filter(Request $request)
    {           $sum = 0;
         
        $sumCosts = Cost::sum('amount');

        if($request->year && $request->month)
         {   
             $years = Income::selectRaw('year(added_on) as year')->distinct()->get();
             $incomes = Income::select('id','note','amount', 'added_on')
             ->selectRaw('year(added_on) as year')->having('year', '=',$request->year)
             ->selectRaw('month(added_on) as month')->having('month', '=',$request->month)
             ->get();

             foreach($incomes as $inc)
                $sum += $inc->amount;
             
                
        }
        return view('incomes')->with(compact('incomes', 'sum', 'years', 'sumCosts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('incomes.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $income = new Income;
        $income->note = $request->note;
        $income->amount = $request->amount;
        $income->added_on = $request->added_on;
        $income->save();
        return redirect()->route('incomes.index');

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
        $income = Income::findOrFail($id);

        return view('incomes.edit')->with(compact('income'));
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
         $income = Income::findOrFail($id);
         $income->note = $request->note;
         $income->amount = $request->amount;
         $income->added_on = $request->added_on;

         $income->save();
         return redirect()->route('incomes.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $income = Income::findOrFail($id);
        $income->delete();
        return redirect()->route('incomes.index');
    }
}
