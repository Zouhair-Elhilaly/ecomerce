@extends('index')
@section('section')
 <section class="slider_section">
      <div class="slider_container">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-7">
                    <div class="detail-box">
                      <h1>
                        Welcome To Our <br>
                        Gift Shop
                      </h1>
                      <p>
                        Sequi perspiciatis nulla reiciendis, rem, tenetur impedit, eveniet non necessitatibus error distinctio mollitia suscipit. Nostrum fugit doloribus consequatur distinctio esse, possimus maiores aliquid repellat beatae cum, perspiciatis enim, accusantium perferendis.
                      </p>
                      <a href="">
                        Contact Us
                      </a>
                    </div>
                  </div>
                  <div class="col-md-5 ">
                    <div class="img-box">
                      <img style="width:600px" src="home/images/image3.jpeg" alt="" />
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>

        </div>
      </div>
    </section>
@endsection
@section('product')

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
<center style="padding: 20px "><h2>List Orders</h2></center>
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
    <th>Image</th>
    <th>Product</th>
    <th>Price</th>
    <th>Description</th>
    <th>Created_at</th>
    <th>Modification</th>
  </tr>
  <tbody class="tbody">
     @php
         $data1 = 0
     @endphp
  @if (isset($data) && !empty($data))
  @foreach ($data as $item)

  <tr>
    <td>{{$item->id}}</td>
    <td><img style="width: 100px;height:100px;background-size:cover" src="uploads/{{$item->image}}" alt=""></td>
    <td>{{$item->name_pr}}</td>
    <td>{{$item->price }}</td>
    <td>{{ Str::limit($item->description,10,'.....')}}</td>
    <td>{{$item->created_at}}</td>
    <td >
        {{$item->status}}
        @if ($item->status == 'ordered')

        <a style=" padding: 6px; border-radius: 3px; margin: 5px; background-color: rgb(112, 253, 57); color:rgb(20, 0, 0)"  href="" >Confirmed </a>

        @else
        <a style=" padding: 6px; border-radius: 3px; margin: 5px; background-color: red; color:white"  href="{{route('User.deleteOrder',$item->id)}}" onclick="return confirm('are you sure for delete this product?')">Delete </a>

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

<div style="display: flex;justify-content:center;align-items:center;flex-direction:column;gap:10px;background-color:white;
padding:20px; border-radius: 10px; box-shadow:  1px 1px 2px black;margin-top:20px" id="form">
    <form style="width:100%;
    display: flex;justify-content:center;align-items:center;flex-direction:column; gap:10px  ;margin-top:20px"  action="{{route('confirmOrder')}}" method="POST">
    @csrf
        <h5><b>Total price </b> : {{$price}}$</h5>
    <input type="text" name="address" placeholder="Enter Your address"  style="width:80% ; margin: auto; padding: auto 10px;">
        @error('address')
        <div style="color:red" >{{$message}}</div>
        @enderror


        <input type="text" name="phone" placeholder="Enter Your Phone number"  style="width:80% ; margin: auto;padding: auto 10px;">
        @error('phone')
        <div style="color:red" >{{$message}}</div>
        @enderror
        <input type="submit" value="Confirm order" style="width:70% ; padding: 7px; color:white;background-color:rgb(0, 200, 255); border:none; margin: auto;">

    </form>
    <a style="background-color:rgba(208, 30, 252, 0.787);color:white;border-radius:4px;padding:2px 5px;text-align:center;width:40%" href="{{route('stripe',$price)}}">
                    Pay Now
    </a>
</div>
</div>


@endsection
