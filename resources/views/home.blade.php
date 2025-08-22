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
 <section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Latest Products
        </h2>
      </div>
        <center>
                @if (session('success'))
                <div style="color:white; background-color: green;" >{{session('success')}}</div>
                 @elseif (session('error'))
                <div style="color:white; background-color: rgb(201, 24, 62);" >{{session('success')}}</div>
                @endif
                <div></div>
        </center>
      <div class="row">




             @if (isset($data))
            @foreach ($data as $item)


        <div class="col-sm-6 col-md-4 col-lg-3">



          <div class="box">
            <a href="{{route('details',$item->id)}}">
              <div class="img-box">
                <img src="{{asset('uploads/'.$item->product_image)}}" alt="">
              </div>


              <div class="detail-box">

                <h6>
                 {{$item->name}}
                </h6>

                <h6>
                  Stock
                  <span>
                    {{$item->stock}}
                  </span>
                </h6>
                <br>
                <h6>
                    price
                  <span>
                    ${{$item->price}}
                  </span>
                </h6>
              </div>
              <p style="color:grey;font-family:arial" >
                    {{Str::limit($item->description,'100')}}
                </p>
              <div class="new">
                <span>
                  New
                </span>
              </div>
            </a>
            <a style="background-color:rgba(53, 152, 252, 0.787);color:white;border-radius:4px;padding:2px 5px" href="{{route('addCard',$item->id)}}">
                ADD To Card
            </a>
            <a style="background-color:rgba(208, 30, 252, 0.787);color:white;border-radius:4px;padding:2px 5px;float:right" href="{{route('stripe2',$item->price)}}">
                Pay Now
            </a>
          </div>
        </div>

         @endforeach

            @endif
{{--
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="box">
            <a href="">
              <div class="img-box">
                <img src="home/images/p2.png" alt="">
              </div>
              <div class="detail-box">
                <h6>
                  Watch
                </h6>
                <h6>
                  Price
                  <span>
                    $300
                  </span>
                </h6>
              </div>
              <div class="new">
                <span>
                  New
                </span>
              </div>
            </a>
          </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="box">
            <a href="">
              <div class="img-box">
                <img src="home/images/p3.png" alt="">
              </div>
              <div class="detail-box">
                <h6>
                  Teddy Bear
                </h6>
                <h6>
                  Price
                  <span>
                    $110
                  </span>
                </h6>
              </div>
              <div class="new">
                <span>
                  New
                </span>
              </div>
            </a>
          </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="box">
            <a href="">
              <div class="img-box">
                <img src="home/images/p4.png" alt="">
              </div>
              <div class="detail-box">
                <h6>
                  Flower Bouquet
                </h6>
                <h6>
                  Price
                  <span>
                    $45
                  </span>
                </h6>
              </div>
              <div class="new">
                <span>
                  New
                </span>
              </div>
            </a>
          </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="box">
            <a href="">
              <div class="img-box">
                <img src="home/images/p5.png" alt="">
              </div>
              <div class="detail-box">
                <h6>
                  Teddy Bear
                </h6>
                <h6>
                  Price
                  <span>
                    $95
                  </span>
                </h6>
              </div>
              <div class="new">
                <span>
                  New
                </span>
              </div>
            </a>
          </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="box">
            <a href="">
              <div class="img-box">
                <img src="home/images/p6.png" alt="">
              </div>
              <div class="detail-box">
                <h6>
                  Flower Bouquet
                </h6>
                <h6>
                  Price
                  <span>
                    $70
                  </span>
                </h6>
              </div>
              <div class="new">
                <span>
                  New
                </span>
              </div>
            </a>
          </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="box">
            <a href="">
              <div class="img-box">
                <img src="home/images/p7.png" alt="">
              </div>
              <div class="detail-box">
                <h6>
                  Watch
                </h6>
                <h6>
                  Price
                  <span>
                    $400
                  </span>
                </h6>
              </div>
              <div class="new">
                <span>
                  New
                </span>
              </div>
            </a>
          </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="box">
            <a href="">
              <div class="img-box">
                <img src="home/images/p8.png" alt="">
              </div>
              <div class="detail-box">
                <h6>
                  Ring
                </h6>
                <h6>
                  Price
                  <span>
                    $450
                  </span>
                </h6>
              </div>
              <div class="new">
                <span>
                  New
                </span>
              </div>
            </a>
          </div>
        </div> --}}
      </div>
      @if (isset($hidden) or (isset($length) and $length <= 8))
        <style>
            #btnHidden{
                display: none
            }
        </style>
       @endif
      <div id="btnHidden" class="btn-box">
        <a href="{{route('allPrd')}}">
          View All Products
        </a>
      </div>
    </div>
  </section>
@endsection
