@extends('template')
@section('title')
    خانه
@endsection
@section('home') text-purple-700 border-purple-700 @endsection
@section('topic') border-transparent @endsection
@section('quiz') border-transparent @endsection
@section('profile') border-transparent @endsection
@section('todo') border-transparent @endsection
@section('content')

    <div class="grid grid-cols-3 md:m-5 " >
        <div class="col-span-3 lg:col-span-2 bg-white border-dashed border-2 border-purple-600 p-3 rounded-md m-5" >
            <h2 class="md:text-3xl text-lg m-3 text-purple-700">آخرین آزمون ها :</h2>
            @foreach($quizzes as $quiz)


            <a href="{{ route('quiz.quizDescription', ['quiz' => $quiz->id]) }}"  class="w-full  gird grid-cols-2 flex bg-white items-center">
                <img src="@php echo \App\Services\BaseService::get_image($quiz->category->id) @endphp" alt="" class="md:h-[200px] md:w-[150px] h-[100px] w-[75px] m-2 rounded-md" >
                <div class="w-full p-3">
                    <h1 class="md:text-2xl text-md m-3">   {{ $quiz->title }}</h1>
                    <h4 class="md:text-sm text-xs text-purple-700">{{ $quiz->creator->name }}</h4>
                    <div class="relative overflow-x-auto border-2 rounded-md">
                        <table class="w-full md:text-sm text-xs text-gray-500 text-center">
                            <thead class="text-2xs md:text-xs text-gray-700 uppercase bg-gray-100">
                            <tr>
                                <th scope="col" class=" md:px-6 px-3  md:py-3 py-2 text-2xs md:text-xs">تعداد سوالات</th>
                                <th scope="col" class=" md:px-6 px-3  md:py-3 py-2 text-2xs md:text-xs">دسته بندی</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="bg-white">
                                <th scope="row" class=" md:px-6 px-3  md:py-4 py-2 font-medium text-gray-900 whitespace-nowrap text-2xs md:text-xs">{{ $quiz->total_questions }} </th>
                                <th scope="row" class=" md:px-6 px-3  md:py-4 py-2 font-medium text-gray-900 whitespace-nowrap  text-2xs md:text-xs">{{ $quiz->category->title }}</th>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </a>
                <div class="border-dashed m-2 border-b-2 bg-white mx-16 border-purple-600"></div>
            @endforeach



        </div>
        <div class="col-span-3 lg:col-span-1">
            <div class="border-dashed border-2 bg-white border-purple-600 p-3 rounded-md m-5">
                <h2 class="md:text-3xl text-lg m-3 text-purple-700">آخرین وظیفه ها :</h2>

                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">

                        <tbody>
                        @if($todos !== [])
                        @foreach($todos as $todo)
                        <tr class="bg-white text-xs md:text-sm">
                            <th scope="col" class="md:px-6 px-3 md:py-3 p-2 rounded-s-lg">{{ $todo->title }}</th>
                            <th scope="row" class="md:px-6 px-3 md:py-4 p-2 font-medium text-gray-900 whitespace-nowrap">{{ $todo->from }} تا {{ $todo->to }} </th>
                        </tr>
                        @endforeach
                        @else
                            <h1 class="text-2xl lg:m-12 md:m-8 m-6 text-center text-purple-700">هنوز <span class="font-bold border-b-2 border-purple-600 pb-2">گروهی</span> نداری !</h1>
                        @endif
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="border-dashed border-2 bg-white border-purple-600 p-3 rounded-md m-5">
                <h2 class="md:text-3xl text-lg m-3 text-purple-700">آخرین پرسش ها :</h2>

@foreach($topices as $topic)
                <a href="/topics/show/{{$topic->id}}" class="border-2 m-2 p-2  flex items-center">
                    <img src="{{ asset('images/icons8-decision-48.png') }}" class="rounded-full m-2 w-[30px] h-[30px] col-span-1" alt="">
                    <div class="justify-right">
                        <h4 class="md:text-lg text-sm align-middle whitespace-nowrap overflow-hidden w-[150px]" style="text-overflow: ellipsis;">
                            {{$topic->title}}</h4>
                        <span class="md:text-sm text-2xs text-gray-600"> بازدید : 123</span>
                        <span class="md:text-sm text-2xs text-gray-600"> ریپلای :         @php
                                echo App\Models\Replay::where("topic_id" , $topic->id)->count();
                            @endphp</span>
                        <span class="md:text-sm text-2xs text-gray-600"> لایک :         @php
                                echo App\Models\Like::where("topic_id" , $topic->id)->count() - App\Models\disLike::where("topic_id" , $topic->id)->count();
                            @endphp</span>
                    </div>
                </a>
                @endforeach

            </div>
        </div>
    </div>


    </div>



    <div class="md:m-32 m-6">
        <div id="default-carousel" class="relative w-full" data-carousel="slide">
            <!-- Carousel wrapper -->
            <div class="relative md:h-96 h-56 overflow-hidden rounded-lg ">
               @foreach($carousels as $csrousel)
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{ asset('storage/'.$csrousel->address)}}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 h-full" alt="...">
                </div>
                   @endforeach
            </div>
            <!-- Slider indicators -->
            <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                @php
$i = 0
 @endphp
                @foreach($carousels as $c)
                    @php
                        $i++
                    @endphp
                <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide {{$i}}" data-carousel-slide-to="{{$i}}"></button>
                @endforeach
            </div>
            <!-- Slider controls -->
            <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30  group-hover:bg-white/50  group-focus:ring-4 group-focus:ring-white  group-focus:outline-none">
            <svg class="w-4 h-4 text-black  rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
            </svg>
            <span class="sr-only">Previous</span>
        </span>
            </button>
            <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50  group-focus:ring-4 group-focus:ring-white  group-focus:outline-none">
            <svg class="w-4 h-4 text-black  rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
            <span class="sr-only">Next</span>
        </span>
            </button>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
</div>

@endsection
