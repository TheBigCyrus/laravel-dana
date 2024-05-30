@extends('template')
@section('title') پروفایل @endsection
@section('profile') text-purple-700 border-b-2 border-purple-700 @endsection
@section('home') border-transparent @endsection
@section('quiz') border-transparent @endsection
@section('topic') border-transparent @endsection
@section('todo') border-transparent @endsection
@section('addressBar')
    <li>
        <div class="flex items-center">
            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
            <a href="#" class="ms-1 md:text-sm text-2xs font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">پروفایل</a>
        </div>
    </li>

@endsection
@section('content')


    <div class="md:m-20 md:mx-32 m-10">
        <div class="flex items-center gap-4 flex-wrap">
            <img class="w-[150px] h-[150px] rounded-full mx-auto md:mx-2" src="{{ asset('storage/'.$user->profileImage) }}" alt="">
            <div class="font-medium text-center md:text-right mx-auto md:mx-2">
                <div class="text-2xl">{{ Auth::user()->name }}</div>

                <div class="flex flex-wrap ">

                    <span class="m-2  text-gray-500 text-center my-2"> پرسش ها : {{$topic_number}}</span>
                    <span class="m-2  text-gray-500 text-center my-2"> آزمون ها : {{$countQuizAction}}</span>
                </div>
            </div>
        </div>

        <div class="bg-gray-200 rounded-xl p-1 m-2 inline-block">
            <button class="bg-white text-blue rounded-xl p-3 " id="quiz_btn">آزمون ها</button>
            <button class="bg-gray-200 text-blue rounded-xl p-3 " id="topic_btn">پرسش ها</button>
            <button class="bg-gray-200 text-blue rounded-xl p-3 " id="ticket_btn">تیکت(بیان مشکلات)</button>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5 ">

            <table class="w-full col-span-2 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" id="quiz">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        نام آزمون
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            تاریخ
                            <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                                </svg></a>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            نمره
                            <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                                </svg></a>
                        </div>
                    </th>


                </tr>
                </thead>
                <tbody class="">
                @foreach($QuizAction as $Quiz)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$Quiz->quiz->title}}
                    </th>
                    <td class="px-6 py-4">
                        {{ time2str($Quiz->updated_at) }}
                    </td>
                    <td class="px-6 py-4">
                        {{$Quiz->score}}
                    </td>


                </tr>
                @endforeach
                </tbody>
            </table>
            <table class="w-full hidden text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" id="topic">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                <tr>
                    <th scope="col" class="px-6 py-3">
                         عنوان پرسش
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            تاریخ
                            <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                                </svg></a>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            دسته بندی
                            <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                                </svg></a>
                        </div>
                    </th>     <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            تعداد نظرات
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            وضعیت

                        </div>
                    </th>

                </tr>
                </thead>
                <tbody class="">
                @foreach($topics as $topic)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$topic->title}}
                        </th>
                        <td class="px-6 py-4">
                            {{$topic->created_at}}
                        </td>
                        <td class="px-6 py-4">
                            {{$topic->category->title}}
                        </td>
                        <td class="px-6 py-4">
                            {{$topic->replays->count()}}
                        </td>

                        <td class="px-6 py-4 text-right">
                            @if($topic->status == 'Pending')
                                <span class="text-yellow-600 m-2 text-md">انتظار</span>
                            @elseif($topic->status == 'Active')
                                <a href="/topics/show/{{$topic->id}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">دیدن</a>
                            @elseif($topic->status == 'Suspend')
                                <span class="text-red-600 m-2 text-md">رد شده</span>
                            @endif
                              </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div id="ticket" class="hidden">


                <!-- Modal toggle -->
                <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                    ارسال تیکت(بیان مشکلات)
                </button>

                <!-- Main modal -->
                <div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                    ارسال تیکت(بیان مشکلات) جدید
                                </h3>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <form class="p-4 md:p-5" method="post" action="{{route('user.add.ticket')}}">
                                @csrf
                                <div class="grid gap-4 mb-4 grid-cols-2">
                                    <div class="col-span-2">
                                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">عنوان تکیت</label>
                                        <input type="text" name="title" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="عنوان تیکت(بیان مشکلات) من هست ..." required="">
                                    </div>

                                    <div class="col-span-2">
                                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">متن تیکت(بیان مشکلات)</label>
                                        <textarea id="description" name="body" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="متن تیکت(بیان مشکلات) من ..."></textarea>
                                    </div>
                                </div>
                                <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                                    ارسال تیکت(بیان مشکلات)
                                </button>
                            </form>
                        </div>
                    </div>
                </div>



            <table class="w-full  text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" >

                <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        عنوان تیکت(بیان مشکلات)
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            تاریخ

                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            متن

                        </div>

                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            پاسخ

                        </div>
                    </th>

                </tr>
                </thead>
                <tbody class="">
                @foreach($tickets as $ticket)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <p class="text-md text-gray-800 m-4  whitespace-nowrap overflow-hidden w-[100px]" style="text-overflow:ellipsis">                 {{$ticket->title}}</p>
                        </th>
                        <td class="px-6 py-4">
                            {{$ticket->created_at}}
                        </td>
                        <td class="px-6 py-4 " >


                            <p class="text-md text-gray-800 m-4  whitespace-nowrap overflow-hidden w-[200px]" style="text-overflow:ellipsis">{{$ticket->body}}</p>


                        </td>
                        <td class="px-6 py-4 text-right">

@if( $ticket->answer == null)
    <span class="text-red-700 text-lg font-bold">هنوز پاسخ ندادند</span>
                            @else

                            <!-- Modal toggle -->
                            <button data-modal-target="default-modal" data-modal-toggle="default-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                دیدن پاسخ
                            </button>

                            <!-- Main modal -->
                            <div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-2xl max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <!-- Modal header -->
                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                پاسخ ادمین به تکت شما
                                            </h3>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="p-4 md:p-5 space-y-4">
                                            <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                                {{$ticket->answer}}
                                            </p>

                                        </div>
                                        <!-- Modal footer -->
                                        <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                            <button data-modal-hide="default-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I accept</button>
                                            <button data-modal-hide="default-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Decline</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
    @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            </div>
        </div>
        <button id="profileImage" class="bg-blue-500 rounded-xl p-2 m-2">تعویض عکس پروفایل</button>
        <form action="/addProfileImage" class="hidden bg-blue-500 rounded-xl" id="profileForm" method="post" enctype="multipart/form-data">
            @csrf
            <label class="m-2 text-lg"> عکس پروفایل :</label>
            <input type="file" class="bg-white border-2 border-black rounded-lg  m-2 " placeholder="عکس" name="profileImage">
            <button type="submit" class="bg-green-600 p-2 m-2">تایید</button>
        </form>
    </div>
    <script >
        let quiz = document.getElementById('quiz')
        let topic = document.getElementById('topic')
        let ticket = document.getElementById('ticket')
        let quiz_btn = document.getElementById('quiz_btn')
        let topic_btn = document.getElementById('topic_btn')
        let ticket_btn = document.getElementById('ticket_btn')
        let profileForm = document.getElementById('profileForm')
        let profileImage = document.getElementById('profileImage')
        topic_btn.addEventListener('click' , function (){
            ticket_btn.classList.remove('bg-white')
            ticket_btn.classList.add('bg-gray-200')
            quiz_btn.classList.remove('bg-white')
            quiz_btn.classList.add('bg-gray-200')
            topic_btn.classList.add('bg-white')
            topic_btn.classList.remove('bg-gray-200')
            quiz.classList.add('hidden')
            ticket.classList.add('hidden')
            topic.classList.remove('hidden')
        })
        quiz_btn.addEventListener('click' , function (){
            ticket_btn.classList.remove('bg-white')
            ticket_btn.classList.add('bg-gray-200')
            topic_btn.classList.remove('bg-white')
            topic_btn.classList.add('bg-gray-200')
            quiz_btn.classList.add('bg-white')
            quiz_btn.classList.remove('bg-gray-200')
            quiz.classList.remove('hidden')
            ticket.classList.add('hidden')
            topic.classList.add('hidden')
        })
        profileImage.addEventListener('click' , function (){

            profileForm.classList.remove('hidden')

        })
        ticket_btn.addEventListener('click' , function (){
            ticket_btn.classList.add('bg-white')
            ticket_btn.classList.remove('bg-gray-200')
            topic_btn.classList.remove('bg-white')
            topic_btn.classList.add('bg-gray-200')
            quiz_btn.classList.remove('bg-white')
            quiz_btn.classList.add('bg-gray-200')
            quiz.classList.add('hidden')
            ticket.classList.remove('hidden')
            topic.classList.add('hidden')
        })
    </script>
@endsection
