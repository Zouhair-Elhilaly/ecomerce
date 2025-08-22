@extends('admin.designe')

<base href="/public">
@section('add_category')

             @if (session('success'))
                <div style="color:rgb(30, 255, 0)">{{session('success')}}</div>
            @endif

    <div class="container-fluid">
        <form action="{{route('admin.StoreCAtegory')}}" method="POST">
            @csrf
            <input type="text" name="name_category" value="{{ old('name_category')}}" id="" placeholder="Enter Category name">
            @error('name_category')
                <div style="color:red">{{$message}}</div>
            @enderror
            @if (session('error'))
                <div style="color:red">{{session('error')}}</div>
            @endif
            <input type="submit" value="Add Category" name="submit">
        </form>
    </div>
@endsection
