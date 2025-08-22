@extends('admin.designe')
@section('link')
{{route('search_Prd')}}
@endsection
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

<h1>Product Table</h1>
{{$data->links()}}
<table id="customers">
    <tr>
        <td style="border:none" colspan="8" style="padding: 10px auto">
            <center>
                @if (session('success'))
                <div style="color:white; background-color: green;" >{{session('success')}}</div>
                 @elseif (session('error'))
                <div style="color:white; background-color: rgb(201, 24, 62);" >{{session('error')}}</div>
                @endif
                <div></div></center>
        </td>
    </tr>
  <tr>
    <th>Id</th>
    <td>Image</td>
    <th>Title Product</th>
    <td>Description</td>
    <td>stock</td>
    <td>price</td>
    <th>Created_at</th>
    <th colspan="2" >Modification</th>
  </tr>
  <tbody class="tbody">
  @if (isset($data) && !empty($data))
  @foreach ($data as $item)


  <tr>
    <td>{{$item->id}}</td>
    <td><img style="width: 100px;height:100px;background-size:cover" src="uploads/{{$item->product_image}}" alt=""></td>
    <td>{{$item->name}}</td>
    <td>{{ Str::limit($item->description,10,'.....')}}</td>
    <td>{{$item->stock}}</td>
    <td>{{$item->price}}</td>
    <td>{{$item->created_at}}</td>
    <td >
        <a style=" margin: 5px; background-color: red; color:white"  href="{{route('admin.deletePrd',$item->id)}}" onclick="return confirm('are you sure for delete this product?')">Delete </a>
    </td>
    <td >
        <a style=" margin: 5px;background-color: rgb(47, 255, 0); color:rgb(14, 13, 13)" href="{{route('admin.updatePrd',$item->id)}}">Update </a>
    </td>
  </tr>

   @endforeach
   @else
    <tr>
        <td colspan="3" >
        <center><div style="color:red;font-weight: bold;text-shadow:white">Aucun Product exist</div></center>
        </td>
    </tr>
  @endif
 </tbody>

</table>

</body>
</html>



@endsection
