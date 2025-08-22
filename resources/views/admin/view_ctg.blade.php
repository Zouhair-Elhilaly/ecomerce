@extends('admin.designe')
@section('dashboard')

<!DOCTYPE html>
<html>
<head>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
</style>
</head>
<body>

<h1>Category Table</h1>

<table id="customers">
    <tr>
        <td colspan="5" style="padding: 10px auto">
            <center>
                @if (session('success'))
                <div style="color:white; background-color: green;" >{{session('success')}}</div>
                 @elseif (session('error'))
                <div style="color:white; background-color: rgb(201, 24, 62);" >{{session('success')}}</div>
                @endif
                <div></div>
            </center>
        </td>
    </tr>
  <tr>
    <th>Id</th>
    <th>Contact</th>
    <th>Created_at</th>
    <th colspan="2" >Modification</th>
  </tr>
  @if (isset($data) && !empty($data))
  @foreach ($data as $item)


  <tr>
    <td>{{$item->id}}</td>
    <td>{{$item->name}}</td>
    <td>{{$item->created_at}}</td>
    <td >
        <a style=" margin: 5px; background-color: red; color:white"  href="{{route('admin.deleteCtg',$item->id)}}">Delete </a>
    </td>
    <td >
        <a style=" margin: 5px;background-color: rgb(47, 255, 0); color:rgb(14, 13, 13)" href="{{route('admin.updateCtg',$item->id)}}">Update </a>
    </td>
  </tr>

   @endforeach
   @else
    <tr>
        <td colspan="3" >
        <center><div style="color:red;font-weight: bold;text-shadow:white">Aucun Categorie exist</div></center>
        </td>
    </tr>
  @endif

</table>

</body>
</html>



@endsection
