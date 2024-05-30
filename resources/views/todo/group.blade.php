@extends('template')  @section('todo') text-purple-700 border-b-2 border-purple-700 @endsection
@section('home') border-transparent @endsection
@section('quiz') border-transparent @endsection
@section('profile') border-transparent @endsection
@section('topic') border-transparent @endsection
@section('addressBar')

    <li>
        <div class="flex items-center">
            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
            <a href="/topics/all" class="ms-1 md:text-sm text-2xs font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">پرسش ها</a>
        </div>
    </li>
    <li>
        <div class="flex items-center">
            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
            <a href="#" class="ms-1 md:text-sm text-2xs font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">پرسش</a>
        </div>
    </li>
@endsection
@section('content')

    <div class="   m-5 rounded-2xl shadow-2xl">
        <div class="bg-white rounded-2xl  p-4 grid grid-cols-12 relative">
            @if($thisUser->admin == '1')
            <button type="button" data-modal-target="crud-modal" data-modal-toggle="crud-modal"  class="bg-blue-600 text-lg font-bold rounded-full p-2 mr-10 col-span-1  w-[50px] h-[50px]">+</button>
            @else
                <img src="{{ asset('images/pngkit_team-icon-png_1891753 (1).png') }}" data-modal-target="crud-modal"  class="bg-orange-500 text-lg font-bold rounded-full p-1 mr-10 col-span-1  w-[50px] h-[50px]">

            @endif
                <div class="col-span-10 mr-2">
        <span class="text-lg text-black p-1 font-bold">{{ $group->title }}</span>
                @php
$countOfMember = 0 ;
 @endphp
                @foreach($group->members as $memberCount)
                @if($memberCount->status == 'accepted')
                        @php
                            $countOfMember++ ;
                        @endphp
                @endif
                        @endforeach
                    <div class=" flex">
        <span class="text-sm text-gray-700 p-1 ">{{ $countOfMember }} مشترک</span>
                    <span class="text-sm text-gray-500 p-1 "> {{ $group->code }}#</span>
                </div>

                @if($thisUser->admin == '1')
                <button type="button"  id="dropdownNotificationButton" data-dropdown-toggle="dropdownNotification" class="top-[20px] absolute left-[20px] col-span-1 inline-flex items-center p-3 text-sm font-medium text-left text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                        <path d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z"/>
                        <path d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z"/>
                    </svg>
                    <span class="sr-only">Notifications</span>
                    <div class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -end-2 dark:border-gray-900">{{$pendingMembers->count()}}</div>
                </button>

                <!-- Dropdown menu -->

                <div id="dropdownNotification" class="z-20 hidden w-full max-w-sm bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-800 dark:divide-gray-700" aria-labelledby="dropdownNotificationButton">
                    <div class="block px-4 py-2 font-medium text-center text-gray-700 rounded-t-lg bg-gray-50 dark:bg-gray-800 dark:text-white">
                        پیام ها
                    </div>
                    <div class="divide-y divide-gray-100 dark:divide-gray-700">
@foreach($pendingMembers as $pendingMember)
                        <a href="#" class="flex px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700">

                            <div class="w-full ps-3 ">
                                <div class="flex items-center">
                                <img class="rounded-full w-11 h-11" src="{{ asset('images/profile.png')}}" alt="Joseph image">

                                <div class="text-gray-500 text-sm mb-1.5 dark:text-gray-400"><span class="font-semibold text-gray-900 dark:text-white">{{ $pendingMember->user->name }}</span>  میخواهد در گروه شما عضو شود</div>
                            </div><a href="/todo/accept/{{ $pendingMember->id }}" class="text-xs text-white bg-green-600 p-1 m-1 ml-0 inline-block rounded-md ">قبول کردن</a>
                                <a href="/todo/fail/{{ $pendingMember->id }}" class="text-xs text-white bg-red-600 p-1 m-1 mr-0 inline-block rounded-md ">رد کردن</a>
                            </div>
                        </a>
    @endforeach
                    </div>

                </div>
                @endif
            </div>
        </div>
        <div  class="h-[500px] flex flex-col-reverse z-0 rounded-2xl rounded-t-none overflow-auto bg-[url({{ asset('images/telegram_background.jpg') }})]">
@foreach($todos as $todo)
            <div class="block">
                <div class=" shadow-2xl shadow-blue-300  bg-gradient-to-br from-white to-blue-100 p-2 rounded-2xl rounded-br-none m-4 inline-block">
                    <h3 class="text-md m-2 mb-1 text-black font-bold w-[300px]">{{ $todo->title }} </h3>
                    <p class="text-xs m-2 mt-1 text-gray-700 w-[300px]">{{ $todo->body }}<p>
                    <span class="bg-gradient-to-l text-2xs from-purple-400 to-purple-800 ml-1 w-[30px] text-white font-semibold rounded-full p-1 m-2">از : {{ $todo->from }} مهلت ارسال</span>
                    <span class="bg-gradient-to-r text-2xs from-purple-400 mr-1 to-purple-800 w-[30px] text-white font-semibold rounded-full p-1 m-2">تا : {{ $todo->to }} </span>
                        <span class="bg-blue-500 text-2xs mr-1 to-purple-800 w-[30px] text-white  rounded-full p-1 m-2">{{ $todo->creator->name }} </span>
                        <span class="bg-red-500 text-2xs mr-1 to-purple-800 w-[30px] text-white font-semibold rounded-full p-1 m-2">درس : {{ $todo->subject }} </span>

                </div>
            </div>
    @endforeach
                <!-- Main modal -->
            <div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                ارسال وظیفه
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <form class="p-4 md:p-5" method="post" action="{{route('todo.make.todo')}}">
                            <div class="grid gap-4 mb-4 grid-cols-2">
                                <div class="col-span-2">
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">عنوان وظیفه</label>
                                    <input type="text" name="title" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name" required="">
                                </div>
                                <input type="hidden" value="{{$group->id}}" name="group_id" id="name" required>
@csrf
                                <div class="col-span-2">
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> مهلت ارسال از :</label>
                                    <input type="text" name="from" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="20 آذر" required="">
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">تا :</label>
                                    <input type="text" name="to" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="25 آذر" required="">

                                </div>

                                <div class="col-span-2 sm:col-span-1">
                                    <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">درس</label>
                                    <select id="category" name="subject" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        <option  value="riazy" >ریاضی</option>
                                        <option value="physic"   >فیزیک</option>
                                        <option value="hendese"  >هندسه</option>
                                        <option value="shimi"   >شیمی</option>
                                    </select>
                                </div>
                                <div class="col-span-2">
                                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">توضیحات وظیفه</label>
                                    <textarea id="description" name="body" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write product description here"></textarea>
                                </div>
                            </div>
                            <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                                ارسال وظیفه
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
