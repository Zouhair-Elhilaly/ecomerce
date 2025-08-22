@extends('index')

<base href="/public">
@section('product')

@if (isset($data))

    <style>


        .product-container {
            width: 100%;
            max-width: 1200px;
            padding: 20px;
            display: flex;
            justify-content: center;
        }

        .col-sm-6 {
            width: 100%;
            max-width: 300px;
        }

        .box {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
            position: relative;
        }

        .box:hover {
            transform: translateY(-5px);
        }

        .img-box {
            width: 100%;
            height: 200px;
            overflow: hidden;
        }

        .img-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .box:hover .img-box img {
            transform: scale(1.05);
        }

        .detail-box {
            padding: 15px;
        }

        .detail-box h6 {
            margin: 5px 0;
            font-size: 16px;
            color: #333;
        }

        .detail-box h6 span {
            font-weight: bold;
            color: #2c3e50;
        }

        .description {
            color: grey;
            font-family: Arial, sans-serif;
            padding: 0 15px 15px;
            font-size: 14px;
            line-height: 1.4;
        }

        .new {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #e74c3c;
            color: white;
            padding: 3px 10px;
            border-radius: 3px;
            font-size: 12px;
            font-weight: bold;
        }
    </style>

    <div class="product-container" style="display:flex;flex-direction:column;justify-content:center;align-items:center;" >
        <a style=" margin:20px 0;padding: 20px auto !important;" href="{{route('allPrd')}}"><- Go to home page</a>

         <center>
                @if (session('success'))
                <div style="color:white; background-color: green;" >{{session('success')}}</div>
                 @elseif (session('error'))
                <div style="color:white; background-color: rgb(201, 24, 62);" >{{session('success')}}</div>
                @endif
                <div></div>
        </center>

        <div class="col-sm-6 col-md-4 col-lg-3 border-r-8 border-x-slate-200" style="box-shadow: 1px 0 2px #2c3e50;padding:7px;border-radius:10px">
            <div class="box">
                <div class="img-box">
                     <img src="{{asset('uploads/'.$data['product_image'])}}" alt="">

                </div>
            </div>

                <div class="detail-box">
                    <h6> {{$data['name']}}</h6>
                    <h6>
                        Stock
                        <span>{{$data['stock']}}</span>
                    </h6>
                </div>

                <p class="description">
                  {{$data['description']}}
                </p>

                <div class="new">
                    <span>New</span>
                </div>
                <a style="background-color:rgba(53, 152, 252, 0.787);color:white;border-radius:4px;padding:2px 5px" href="{{route('addCard',$data['id'])}}">
                ADD To Card
            </a>
            <a style="background-color:rgba(208, 30, 252, 0.787);color:white;border-radius:4px;padding:2px 5px;float:right" href="{{route('stripe2',$data['price'])}}">
                Pay Now
            </a>
        </div>
    </div>
    {{-- </div> --}}

        {{-- <div class="col-sm-6 col-md-4 col-lg-3">



          <div class="box">              <div class="img-box">
                <img src="{{asset('uploads/'.$data['product_image'])}}" alt="">
              </div>


              <div class="detail-box">

                <h6>
                 {{$data['name']}}
                </h6>

                <h6>
                  Stock
                  <span>
                    {{$data['stock']}}
                  </span>
                </h6>
              </div>
              <p style="color:grey;font-family:arial" >
                    {{Str::limit($data['description'],'100')}}
                </p>
              <div class="new">
                <span>
                  New
                </span>
              </div>

          </div>
        </div> --}}
@endif

@endsection
