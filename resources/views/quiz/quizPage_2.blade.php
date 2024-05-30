@extends('template')

@section('title') صفحه آزمون @endsection
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
                    زمان باقی مانده : <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300" id="timer">60</span>

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
                    سوالات بدون پاسخ : <span id="total_questions" class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">15</span>
                </a>

            </div>
        </div>
    </nav>
    <div class="grid grid-cols-5 mt-5" id="form">
        <div class="col-span-3">
            <img src="{{ asset('images/nemoone.png') }}" class="w-100 h-[900px] m-2" alt="">
            <img src="{{ asset('images/nemoone.png') }}" class="w-100 h-[900px] m-2" alt="">
            <img src="{{ asset('images/nemoone.png') }}" class="w-100 h-[900px] m-2" alt="">
        </div>
        <div class="col-span-2 " id="answer_sheet">
            <table class="bg-white  p-2 rounded-lg border-2 border-gray-700">
                <tr>
                    <th>#</th>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                </tr>
                <form action="" method="post">
                <tr>
                    <td class="text-[30px]">1</td>
                    <td><input type="checkbox" class="p-1 rounded-md mx-10 size-8" name="" id=""></td>
                    <td><input type="checkbox" class="p-1 rounded-md mx-10 size-8" name="" id=""></td>
                    <td><input type="checkbox" class="p-1 rounded-md mx-10 size-8" name="" id=""></td>
                    <td><input type="checkbox" class="p-1 rounded-md mx-10 size-8" name="" id=""></td>
                </tr>
                </form>

            </table>
        </div>
    </div>

    <script !src="">
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



    </script>
@endsection
