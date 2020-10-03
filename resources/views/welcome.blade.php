@extends('layouts.app')

@section('content')
<a class="btn btn-success" style="float: right" href="{{ url('add') }}">Add New</a>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Supplies</th>
      <th scope="col">Category</th>
      <th scope="col">Country</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php $i=1;?>
    @foreach($data as $row)
    <tr>
      <th scope="row">{{$i}}</th>
      <td>{{$row->name}}</td>
      <td>{{$row->category->name}}</td>
      @if($row->country_id !='') 
         <td>{{$row->country->name}}</td>
      @else
        <td>-</td>
      @endif     
      <td>
        <a href="{{ url('editSup', $row->id) }}" class="btn btn-primary">Edit</a>
        <meta name="csrf-token" content="{{ csrf_token() }}">
         <button type="button"  data-id="{{$row->id}}"  class="btn btn-danger">Delete</button>
      </td>
    </tr>
    <?php $i++;?>
    @endforeach
    
  </tbody>
</table>


<script type="text/javascript">
  
   $(document).ready(function() {
       $(".btn-danger").click(function(){
        var result = confirm("Want to delete?");
        if (result) {
        var id = $(this).data("id");
          var btn = $(this);
          var token = $("meta[name='csrf-token']").attr("content");
         
          $.ajax(
          {
              url: "deleteSup",
              type: 'POST',
              data: {
                  "id": id,
                  "_token": token,
              },
              success: function (data){
                if(data.message == 'Record deleted successfully'){
                    btn.closest('tr').remove();              }
              }
          });
      }
       
    });
       
    });
</script>

@endsection


