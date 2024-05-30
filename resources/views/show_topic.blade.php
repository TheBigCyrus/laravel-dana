@extends('template')
@section('title') پرسش و پاسخ @endsection
@section('topic') text-purple-700 border-b-2 border-purple-700 @endsection
@section('home') border-transparent @endsection
@section('quiz') border-transparent @endsection
@section('profile') border-transparent @endsection
@section('todo') border-transparent @endsection
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


    <div class="md:px-24 px-4">
        <div class="px-2 pt-2 pb-8 mt-5 mb-6 bg-gray-100 shadow-lg rounded-2xl md:px-16">
            <div class="mb-8">
                <div class="flex flex-col items-start justify-between md:flex-row">
                    <div class="flex m-2  flex-nowrap items-center ">
                        @if($topic->users->profileImage == null)
                            <img src="{{ asset('images/profile.png')}}" class="md:w-[60px] md:h-[60px] w-[40px] h-[40px] rounded-full border-4 md:m-2 m-1 border-gray-100" alt="">
                        @else
                            <img src="{{ asset('storage/'.$topic->users->profileImage)}}" class="md:w-[60px] md:h-[60px] w-[40px] h-[40px] rounded-full border-4 md:m-2 m-1 border-gray-100" alt="">
                        @endif <div class="ml-auto">
                            <h3 class="md:text-2xl text-lg md:m-2  font-bold" >{{$topic->users->name}}</h3>
                            <span class="md:text-sm text-2xs block md:m-2 "><span class="text-blue-600 font-bold">{{ time2str($topic->created_at) }}</span> توسط <span class="text-blue-600 font-bold">{{$topic->users->name}}</span> مطرح شد</span>
                        </div>
                        <div class="flex items-center justify-left mr-auto text-left left-0">
                            <a href="#replies-list" class="flex items-center md:px-5 text-purple-600 px-2 md:py-1.5 py-0.5 rounded-lg bg-white md:mr-3 border border-opacity-0 border-white text-gray-450 group font-normal md:text-lg text-sm mr-auto justify-center transition duration-200 hover:text-gray-50 hover:bg-purple-500">
                                <img src="{{ asset('images/icons8-reply-arrow-24.png')}}" class="w-[20px] h-[20px]" alt="">
                                @php
                                    echo App\Models\Replay::where("topic_id" , $topic->id)->count();
                                @endphp
                            </a>
                        </div>
                            <div class="flex items-center justify-left mr-auto text-left left-0">
                                <a data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="flex p-2 m-2 bg-white rounded-full cursor-pointer transition duration-200 hover:bg-red-700">
                                    <img src="{{ asset('images/icons8-error-48.png')}}" class="w-[20px] h-[20px]" alt="">
                                    {{$topic->reports}}

                                </a>
                                <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                            <div class="p-4 md:p-5 text-center">
                                                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                </svg>
                                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">آیا واقعا میخوای این تاپیک رو گزارش کنی ؟</h3>
                                                <a href="/topics/report/{{$topic->id}}" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                    بله , به نظرم اطمیان دارم
                                                </a>
                                                <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">نه , بیخیال</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="flex items-center self-end justify-center w-full sm:self-center sm:justify-end sm:w-auto">
                        <div class="flex space-x-3 space-x-reverse">
                        </div>

                    </div>
                </div>
            </div>
            <div class="mb-6  text-right">
                <h1 class="mb-5 font-bold text-gray-800 dark:text-white md:text-4xl text-xl text-28 md:leading-68">
                    {{$topic->title}}
                </h1>
                <div class="px-8 py-2 text-gray-800 bg-gray-200 rounded-lg content-area dark:bg-dark-910">
                    <p>{{$topic->body}}</p>
                </div>
            </div>
            <hr class="mb-5 border-gray-300 border-opacity-20">
            <div class="flex flex-col items-center justify-between lg:flex-row">
                <div class="flex flex-col items-center justify-center mb-5 space-y-2 sm:space-x-2 sm:space-y-0 sm:space-x-reverse lg:mb-0 sm:flex-row ">
                </div>
            </div>


            @foreach($topic->replays as $replay)
                <div id="{{ $replay->id }}">
                    <div class="flex items-center px-4 md:mr-16 mr-6 pb-6 bg-white shadow-lg rounded-xl pt-9 mt-5">
                        <div class="w-full">
                            <div class="flex m-2  flex-nowrap items-center ">
                                @if($replay->creators->profileImage == null)
                                    <img src="{{ asset('images/profile.png')}}" class="md:w-[60px] md:h-[60px] w-[40px] h-[40px] rounded-full border-4 md:m-2 m-1 border-gray-100" alt="">
                                @else
                                    <img src="{{ asset('storage/'.$replay->creators->profileImage)}}" class="md:w-[60px] md:h-[60px] w-[40px] h-[40px] rounded-full border-4 md:m-2 m-1 border-gray-100" alt="">
                                @endif <div class="ml-auto">
                                    <h3 class="md:text-2xl text-lg md:m-2  font-bold" >{{$replay->creators->name}}</h3>
                                    <span class="md:text-sm text-2xs block md:m-2 "><span class="text-blue-600 font-bold">{{ time2str($replay->created_at) }}</span> توسط <span class="text-blue-600 font-bold">{{$replay->creators->name}}</span> مطرح شد</span>
                                </div>

                            </div>
                            <div class="flex items-center">
                                <div class="flex flex-col items-center">
                                    <div>
                                        <div class="flex flex-col items-center p-3 pt-5 pr-0 space-y-2 text-xl">
                                            <button type="button" onclick="AddLike({{ $replay->id }})" class="flex">

                                                <span id="like{{$replay->id}}">@php echo App\Models\ReplayLike::where('replay_id' , $replay->id)->count() @endphp </span>
                                                <img src="{{ asset('images/icons8-like-48.png') }}" class="w-[30px] h-[30px] cursor-pointer" alt="">

                                            </button>

                                            <button type="button"  onclick="AddDisLike({{ $replay->id }})" class="flex">

                                                <span id="dislike{{$replay->id}}">@php echo App\Models\Replaydislike::where('replay_id' ,$replay->id)->count() @endphp</span>
                                                <img src="{{ asset('images/icons8-dislike-48.png') }}" class="w-[30px] h-[30px] cursor-pointer" alt="">

                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full">
                                    <div class="flex items-center">
                                        <div class="w-full text-gray-800 ">
                                            <p class="md:text-2xl text-lg">{{$replay->body}}</p>
                                        </div>
                                    </div>
-
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    @endforeach
                    <div>
                        @if(auth()->check())


                        <form action="{{route('topics.add.replay')}}" method="get" class="my-20">
                            @csrf


                            <div class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                                <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">

                                    <textarea id="comment " name="comment" rows="4" class="w-full px-0 text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400" placeholder="نظر من اینه که ..." required ></textarea>
                                </div>
                                <div class="flex items-center justify-between px-3 py-2 border-t dark:border-gray-600">
                                    <button type="submit" class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                                        ارسال کامنت
                                    </button>
                                    <input type="hidden" name="hidden" id="" value="{{$topic->id}}">
                                    <div class="flex ps-0 space-x-1 rtl:space-x-reverse sm:ps-2">
                                        <button type="button" class="inline-flex justify-center items-center p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 20">
                                                <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M1 6v8a5 5 0 1 0 10 0V4.5a3.5 3.5 0 1 0-7 0V13a2 2 0 0 0 4 0V6"/>
                                            </svg>
                                            <span class="sr-only">Attach file</span>
                                        </button>
                                        <button type="button" class="inline-flex justify-center items-center p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                                                <path d="M8 0a7.992 7.992 0 0 0-6.583 12.535 1 1 0 0 0 .12.183l.12.146c.112.145.227.285.326.4l5.245 6.374a1 1 0 0 0 1.545-.003l5.092-6.205c.206-.222.4-.455.578-.7l.127-.155a.934.934 0 0 0 .122-.192A8.001 8.001 0 0 0 8 0Zm0 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z"/>
                                            </svg>
                                            <span class="sr-only">Set location</span>
                                        </button>
                                        <button type="button" class="inline-flex justify-center items-center p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                                <path d="M18 0H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm4.376 10.481A1 1 0 0 1 16 15H4a1 1 0 0 1-.895-1.447l3.5-7A1 1 0 0 1 7.468 6a.965.965 0 0 1 .9.5l2.775 4.757 1.546-1.887a1 1 0 0 1 1.618.1l2.541 4a1 1 0 0 1 .028 1.011Z"/>
                                            </svg>
                                            <span class="sr-only">Upload image</span>
                                        </button>
                                    </div>
                                </div>
                            </div>



                        </form>
                        @else
                            <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert">
                                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                                </svg>

                                <div>
                                    <span class="font-medium">وارد نشدی که!</span> برای نظر دادن باید وارد سایت بشی.
                                </div>
                            </div>
                        @endif

                    </div>
                </div> </div></div></div>

<script>
    const token = "{{ csrf_token() }}";

    const AddLike = (replayID) => {
        const requestBody = {
            "replayID": replayID,
            "_token": token
        }
        fetch("{{ route('topics.addreplaylike.submit') }}", {
            method:"POST",
            headers: {
                'X-CSRF-TOKEN': token,
                'Content-Type': "application/json,charset-utf8"
            },
            body: JSON.stringify(requestBody)
        })
            .then(response => response.json())
            .then(data => {
                console.log(data)
                document.getElementById('like'+replayID).textContent = data.data
            })
            .catch(err => console.log(err))
    };

    function AddDisLike(replayID) {
        const requestBody = {
            "replayID": replayID,
            "_token": token
        }
        fetch("{{ route('topics.addReplayDisLike.submit') }}", {
            method:"POST",
            headers: {
                'X-CSRF-TOKEN': token,
                'Content-Type': "application/json,charset-utf8"
            },
            body: JSON.stringify(requestBody)
        })
            .then(response => response.json())
            .then(data => {
                console.log(data)
                document.getElementById('dislike'+replayID).textContent = data.data
            })
            .catch(err => console.log(err));
    }

</script>

@endsection
