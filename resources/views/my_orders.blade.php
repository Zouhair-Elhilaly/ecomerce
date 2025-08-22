@extends('layouts.navigation')

<style>
    .main{
        width: 80%;
        margin: 20px auto
    }
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
<center style="padding: 20px "><h2>All Orders</h2></center>
<div class="main">

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
    {{-- <th>Name User</th> --}}
    {{-- <th>Address User </th> --}}
    {{-- <th>Phone User</th> --}}
    <td>Product name</td>
    <th>Created_at</th>
    <td>status</td>

  </tr>
  <tbody class="tbody">
  @if (isset($data) && !empty($data))
  @foreach ($data as $item)


  <tr>
    <td>{{$item->id}}</td>
    {{-- <td><img style="width: 100px;height:100px;background-size:cover" src="uploads/{{$item->image}}" alt=""></td> --}}
    {{-- <td>{{$item->address}}</td>
    <td>{{$item->phone}}</td> --}}
    <td>{{$item->name_p}}</td>
    <td>{{$item->created_at}}</td>
    <td >

        @if ($item->status == 'pending')
        <div style=" padding: 6px; border-radius: 3px; margin: 5px; background-color: rgb(247, 185, 13); color:rgb(20, 0, 0)"  >Pending</div>

        @elseif ($item->status == 'Accept')
        <div style=" padding: 6px; border-radius: 3px; margin: 5px; background-color: rgb(111, 247, 13); color:rgb(20, 0, 0)"  >Confirmed</div>
        @else
                <div style=" padding: 6px; border-radius: 3px; margin: 5px; background-color: rgb(247, 13, 13); color:rgb(227, 225, 225)"  >Rejected</div>
        @endif
    </td>


  </tr>

   <style>
        td{
            text-align: center
        }
    </style>

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

</div>


