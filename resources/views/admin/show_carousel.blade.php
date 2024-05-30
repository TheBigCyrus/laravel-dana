@extends('admin.template')

@section('title')
پیشخوان
@endsection
@section('carousel')
bg-gray-200
@endsection


@section('content')

    <div class="grid grid-cols-4 gap-4">
        @foreach($carousels as $carousel)
        <div>
            <img src="{{ asset('storage/'.$carousel->address) }}" alt="" class="m-2 w-[300px] h-[150px]">
            <a href="/admin/carousel/delete/{{$carousel->id}}" type="button" class="bg-red-600 text-white p-2 rounded-lg w-100 m-2">حذف</a>
        </div>
        @endforeach

    </div>

    <h1 class="h1 text-gray-300 m-2 ">افزودن عکس به اطلاعیه سایت</h1>

    <form action="/admin/carousel/create" method="post" enctype="multipart/form-data">
        @csrf

            <input  type="file" name="image" class="bg-white" />
        <label>
            در کدام قسمت سایت باشد؟
            <select name="type" >
                <option value="top">بالا</option>
                <option value="center">وسط</option>
            </select>
        </label>

        <button type="submit" class="bg-green-600 text-white p-2 rounded-lg w-100 m-2">ذخیره</button>
    </form>
@endsection
