@extends('admin.designe')
@section('dashboard')



             @if (session('success'))
                <div style="color:rgb(30, 255, 0)">{{session('success')}}</div>
            @endif
     @if (isset($data))


    <div class="container-fluid">
        <form action="{{route('admin.storeUpdate')}}" method="POST">
            @csrf
            <input type="text" name="name_category" value="{{ old('name_category',$data['name'])}}" id="" placeholder="Enter Category name">
            @error('name_category')
                <div style="color:red">{{$message}}</div>
            @enderror
            @if (session('error'))
                <div style="color:red">{{session('error')}}</div>
            @endif
            <input type="hidden" name="id_category" value="{{$data['id']}}">
            <input type="submit" value="Add Category" name="submit">
        </form>
    </div>

    @else
        <div>Erreur</div>
    @endif

@endsection
