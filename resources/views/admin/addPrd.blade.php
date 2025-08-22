@extends('admin.designe')

<base href="/public">
@section('add_category')

             @if (session('success'))
                <div style="color:rgb(255, 255, 255);width:90%;
                padding:4px;background-color:green;margin:4px auto;text-align:center">{{session('success')}}</div>
            @endif

    <div class="container-fluid">
        <form style="display: flex;justify-content:center;align-items:centre;flex-direction:column;gap:4px" action="{{route('admin.StoreProduct')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" name="name" value="{{ old('name')}}" id="" placeholder="Enter Product name">
            @error('name')
                <div style="color:red">{{$message}}</div>
            @enderror
            @if (session('error'))
                <div style="color:red">{{session('error')}}</div>
            @endif


            <textarea style="max-height: 300px" name="description" id="" placeholder="Enter description name">{{ old('description')}}</textarea>
            @error('description')
                <div style="color:red">{{$message}}</div>
            @enderror


            <input type="text" name="stock" value="{{ old('stock')}}" id="" placeholder="Enter stock ">
            @error('stock')
                <div style="color:red">{{$message}}</div>
            @enderror


            <select name="id_category" id="">
                 <option value="" style="color:grey">shoos your product</option>
                @if (isset($category))
                @foreach ($category as $item)
                     <option {{old('id_category') == $item->id ? 'selected' : '' }} value="{{$item->id}}">{{$item->name}}</option>
                @endforeach

                @endif
            </select>
            @error('id_category')
                <div style="color:red">{{$message}}</div>
            @enderror

             <input type="file" name="product_image" value="{{old('product_image')}}" id="">
             @error('product_image')
                <div style="color:red">{{$message}}</div>
            @enderror

            <input type="text" placeholder="Enter price ..." name="price" value="{{old('price')}}" id="">
             @error('price')
                <div style="color:red">{{$message}}</div>
            @enderror

            <input type="submit" value="Add Product" name="submit">
        </form>
    </div>
@endsection
