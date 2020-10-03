@extends('layouts.app')

@section('content')        
<ul>
          @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
        @if(session('success'))
            <h1 style="color:green">{{session('success')}}</h1>
        @endif

        @if(session('error'))
            <h1 style="color:red">{{session('error')}}</h1>
        @endif
      
<form method="POST" action="" autocomplete="off">
  <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Name</label>
      <input type="text" name='name' value="{{$data->name}}" class="form-control" id="inputEmail4" placeholder="Name">
    </div>
    <div class="form-group col-md-6">
     <label for="inputState">Country</label>
      <select  name='country_id' id="inputState" class="form-control">
      <option  value="">Choose...</option>
         @foreach($countries as $country)
        <option {{ $country->id == $data->country_id ? 'selected' : '' }} value="{{$country->id}}">{{$country->name}}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="inputState">Category</label>
      <select name='category_id' id="inputState" class="form-control">
        <option  value="">Choose...</option>
        @foreach($categories as $category)
        <option  {{ $category->id == $data->category_id ? 'selected' : '' }}  value="{{$category->id}}">{{$category->name}}</option>
        @endforeach
      </select>
  </div>
  <input type="hidden" name="id" value="{{$data->id}}">
  
  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
  <a class="btn btn-danger" href="{{ url('/') }}">Back</a>

</form>
@endsection