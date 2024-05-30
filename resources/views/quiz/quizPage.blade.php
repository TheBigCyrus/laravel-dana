@extends('template')

@section('title') صفحه آزمون @endsection
@section('quiz') text-purple-700 border-b-2 border-purple-700 @endsection
@section('home') border-transparent @endsection
@section('topic') border-transparent @endsection
@section('profile') border-transparent @endsection
@section('todo') border-transparent @endsection
@section('addressBar')
    <li>
        <div class="flex items-center">
            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
            <a href="/quiz/all" class="ms-1 md:text-sm text-2xs font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">آزمون ها</a>
        </div>
    </li>
    <li>
        <div class="flex items-center">
            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
            <a href="#" class="ms-1 md:text-sm text-2xs font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">صفحه آزمون</a>
        </div>
    </li>

@endsection
@section('content')

    <nav id="detail" class="flex-no-wrap fixed relative top-0 flex w-100 items-center justify-between bg-white m-4 border-2 border-purple-700 border-dashed py-2 shadow-md shadow-black/5 dark:bg-neutral-600 dark:shadow-black/10 lg:flex-wrap lg:justify-start lg:py-4">

        <div class="  flex items-center w-auto justify-center">
            <div class="text-sm flex-grow">
                <a href="#responsive-header" class="inline-block md:text-lg text-2xs mt-0 text-purple-500 hover:bg-purple-500 p-3 font-bold hover:text-white md:mr-4">
                    زمان باقی مانده : <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300" id="timer">{{$quiz->quiz_time}}</span>

                    <script>
                        var timeLimitInMinutes = document.getElementById('timer').innerText;
                        var timeLimitInSeconds = timeLimitInMinutes * 60 - 10;
                        var timerElement = document.getElementById('timer');

                        function startTimer() {
                            timeLimitInSeconds--;
                            var minutes = Math.floor(timeLimitInSeconds / 60);
                            var seconds = timeLimitInSeconds % 60;

                            if (timeLimitInSeconds < 0) {
                                timerElement.textContent = '00:00';
                                clearInterval(timerInterval);
                                document.getElementById('form').submit();
                                return;

                            }

                            if (minutes < 10) {
                                minutes = '0' + minutes;
                            }
                            if (seconds < 10) {
                                seconds = '0' + seconds;
                            }

                            timerElement.textContent = minutes + ':' + seconds;
                        }

                        var timerInterval = setInterval(startTimer, 1000);

                    </script>


                </a>
                <a href="#responsive-header"  class="inline-block md:text-lg text-2xs mt-0 text-purple-500 hover:bg-purple-500 p-3 font-bold hover:text-white md:mr-4">
                    سوالات بدون پاسخ : <span id="total_questions" class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">{{$quiz->total_questions}}</span>
                </a>

            </div>
        </div>
    </nav>
    @php
        $quiz_number = 1;
             if (!empty($errors)){

                                        echo $errors ;
                                }
             $i = 0
    @endphp
    <form method='POST' id="form" action="{{ route('quiz.submit') }}" class=" bg-white border-2 p-6 m-5" >
@csrf

        <input type="hidden" value="{{ $code }}" name="quiz_code">
        <input type="hidden" value="{{$quiz->quiz_time}}" name="quiz_time">
        @foreach($quiz->questions as $question)
            @php $i++ @endphp
            <div>
                <div class="flex flex-wrap">
                    <h1 class="md:text-xl text-md text-gray-900 m-2 mb-5">
                        {{ $quiz_number . "- " . $question->title }}
                    </h1>
                    <img src="{{ asset('storage/'.$question->image ) }}" alt="" class="max-w-[160px] max-h-[160px] min-w-[100px] min-h-[100px] mr-auto">
                </div>
                <div class=" md:p-2">
                    @foreach($question->answers as $answer)
                        <div class="flex items-center lg:w-1/4 sm:w-1/2 w-full md:m-2 my-2 ps-4 border border-gray-200 rounded dark:border-gray-700">
                            <input  type="radio" onclick="checked_answer({{$i}})" value="{{ $answer->id }}" name="answers[{{ $question->id }}]" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label  class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                {{ $answer->body }}
                            </label>
                            <img src="{{ asset('storage/'.$answer->image ) }}" alt="" class="max-w-[150px] max-h-[150px] @if($answer->image == null) hidden @endif mr-auto">

                        </div>
                    @endforeach
                    <div class="border-b-2 w-"></div>
                </div>
            </div>
        @endforeach
        <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
            اتمام آزمون
        </button>

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
                        <h3 class="mb-5 block   text-lg font-normal text-gray-500 dark:text-gray-400">شما <span id="span" class="text-red-600 font-bold">1</span> سوال نزده دارید
                            <div class="flex justify-center mt-4">
                                <button data-modal-hide="popup-modal" type="submit" class="py-2.5 px-5 m-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                    اتمام آزمون
                                </button>
                                <button data-modal-hide="popup-modal" type="button" class="text-white bg-red-600 m-2 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center" >بیخیال</button>
                            </div>
                    </div>
                </div>
            </div>
        </div>

    </form>
    <script>
        let totalQuestions =  document.getElementById("total_questions").innerText;

        let clicked = [] ;
        function checked_answer(i) {

            if (clicked[i] !== 'clicked'){
                clicked[i] = 'clicked'
                document.querySelector("#total_questions").innerText = totalQuestions-1 ;
                totalQuestions =  document.querySelector("#total_questions").innerText;
                document.querySelector("#span").innerText = totalQuestions;
            }
        }
        function closeModal() {

            document.querySelector("#popup-modal").classList.add('hidden') ;

        }
        function openModal() {

            document.querySelector("#popup-modal").classList.remove('hidden') ;

        }



        // دریافت مشخصات div با ایدی detail
        var detailDiv = document.getElementById('detail');
        var form = document.getElementById('form');
        // دریافت موقعیت اولیه div نسبت به صفحه
        var detailDivOffset = detailDiv.offsetTop;

        // اضافه کردن یک ایونت لیسنر برای اسکرول
        window.addEventListener('scroll', function() {
            // دریافت موقعیت فعلی صفحه اسکرول شده
            var scrollPosition = window.scrollY || window.pageYOffset;

            // اگر موقعیت اسکرول کاربر به اندازه موقعیت div باشد
            if (scrollPosition >= detailDivOffset) {
                // اعمال فیکس کردن بر روی div
                detailDiv.style.position = 'fixed';
                detailDiv.style.width = '100%';
                detailDiv.classList.add('m-0');
                detailDiv.classList.add('border-0');
                form.classList.add('mt-28');
                detailDiv.style.top = '5';
                detailDiv.style.left = '5';
                detailDiv.style.right = '5';
            } else {
                // در غیر این صورت، بازگرداندن div به حالت عادی
                detailDiv.style.position = 'static';
                detailDiv.style.width = '';
                form.classList.remove('mt-28');
                detailDiv.classList.remove('m-0');
                detailDiv.classList.remove('border-0');
            }
        });



        window.addEventListener('beforeunload', function (e) {
            var confirmationMessage = 'آیا مطمئنید که می‌خواهید از این صفحه بیرون بروید؟';
            (e || window.event).returnValue = confirmationMessage;
            return confirmationMessage;
        });


    </script>
@endsection

