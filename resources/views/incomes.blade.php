@extends('index')

@section('content')


<div class="card mx-auto mb-5" style="width:80rem;">
<div class="card-header">
<form action="{{route('filterIncomes')}}" method="post">
@csrf
 <div class="form-inline" >
   
   <div class="form-group">
    <label for="year">Year</label>
    <select class="form-control input-sm" style="width: 100px" id="year" name="year">
    @foreach($years as $year)
    <option> {{$year['year']}} </option>
    @endforeach
    </select>
    </div>

    
    <div class="form-group ml-2">
    <label for="month">Month</label>
     <select class="form-control input-sm" style="width: 100px" id="month" name="month">
      @for ($i=1; $i<=12; $i++) 
       <option value="{{$i}}"> {{date('F', mktime(0,0,0,$i))}}</option>
      @endfor
    </select>
    </div>
  
   

   <button type="submit" class="btn btn-primary btn-sm ml-2">Filter</button> 

   <h6 class="ml-4">
    Total incomes: {{$sum}}
   </h6>
   
  
<a href="{{route('incomes.create')}}" class="btn btn-primary ml-5 btn-sm ">Add income</a> 


  </div>
  </form>
</div>
  

  <ul class="list-group list-group-flush">
   @foreach($incomes as $inc)
    <li class="list-group-item">Note: {{$inc->note}} <p>Amount: {{$inc->amount}} </p> <p>Added on: {{date('d-M-Y', strtotime($inc->added_on))}} </p> <div class="form-inline"> <a href="{{route('incomes.edit',$inc->id)}}" class="btn btn-primary  btn-sm">Edit</a> <form action="{{route('incomes.destroy', $inc->id)}}" method="post">@method('DELETE') @csrf  <button type="submit" class="btn btn-primary btn-sm ml-2">Delete</button> </form> </div> </li>
   @endforeach 
  </ul>
</div>




@endsection