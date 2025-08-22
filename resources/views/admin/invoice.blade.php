<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

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
<center style="padding: 20px "><h2>Order</h2></center>
<div class="main">
<base href="/public">
<table id="customers">
  <tr>
    <th>Id</th>
    <th>Image Product</th>
    <th>Name </th>
    <th>Address </th>
    <th>Phone</th>
    <td>Product name</td>
  </tr>
  <tbody class="tbody">
  <tr>
    <td>{{$data->id}}</td>
    <td><img style="width:70px ;height:70px;background-size:cover;" src="uploads/{{$data->productName->product_image}}" alt=""></td>
    <td>{{$data->nameUser->name}}</td>
    <td>{{$data->address}}</td>
    <td>{{$data->phone}}</td>
    <td>{{$data->productName->name}}</td>
  </tr>

   <style>
        td{
            text-align: center
        }
    </style>


 </tbody>

</table>
<div class="signature">
    signature
</div>
</div>
<style>
    .signature{
        position: fixed;
        left:  2%;
        bottom: 2%;
        transform: translate(-50%,-50%)
    }
</style>
</body>
</html>
