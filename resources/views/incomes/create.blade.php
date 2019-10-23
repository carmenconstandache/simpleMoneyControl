@extends('index')

@section('content')
<div class="card mt-5 ml-5 mx-auto" style="width: 18rem;">
<div class="card-body">
<form action="{{route('incomes.store')}}" method="post">
@csrf
  <div class="form-group">
    <label for="note">Note</label>
    <input type="text" class="form-control" id="note" name="note" >
  </div>
  <div class="form-group">
    <label for="amount">Amount</label>
    <input type="text" class="form-control" id="amount" name="amount">
  </div>
  <div class="form-group">
    <label for="added_on">Added on</label>
    <input type="date" class="form-control" id="added_on" name="added_on" >
  </div>
  
  <button type="submit" class="btn btn-primary">Add</button>
</form>
</div>
</div>


@endsection