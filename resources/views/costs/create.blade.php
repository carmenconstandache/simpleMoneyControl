@extends('index')

@section('content')
<div class="card mt-5 ml-5 mx-auto" style="width: 18rem;">
<div class="card-body">
<form action="{{route('costs.store')}}" method="post">
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
    <label for="category_id">Category</label>
    <select class="form-control" id="category" name="category_id">
    @foreach($categories as $cat)
      <option value="{{$cat->id}}">{{$cat->name}}</option>
    @endforeach
    </select>
  </div>
  
  <div class="form-group">
    <label for="added_on">Added on</label>
    <input type="date" class="form-control" id="added_on" name="added_on" >
  </div>
  
  <div class="form-group">
    <label for="image">Image</label>
    <input type="file" class="form-control" id="image" name="image">
  </div>

  <button type="submit" class="btn btn-primary">Add</button>
</form>
</div>
</div>


@endsection