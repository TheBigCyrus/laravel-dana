@extends('template')

@section('title') کارنامه @endsection
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
            <a href="/quiz/all" class="ms-1 md:text-sm text-2xs font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">آزمون </a>
        </div>
    </li>
    <li>
        <div class="flex items-center">
            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
            <a href="#" class="ms-1 md:text-sm text-2xs font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">کارنامه</a>
        </div>
    </li>@endsection
@section('content')
    <h4 class="text md">کارنامه : {{$quiz->title}}</h4>

    <div class="lg:m-20 lg:mx-32 m-5">
    <div class="relative overflow-x-auto ">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 my-5">
            <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 rounded-s-lg">
                    شرکت کننده
                </th>
                <th scope="col" class="px-6 py-3">
                    تاریخ
                </th>

                <th scope="col" class="px-6 py-3 rounded-e-lg">
                     نمره از صد
                </th>
                <th scope="col" class="px-6 py-3 rounded-e-lg">
                    تعداد سوالات درست
                </th>
                <th scope="col" class="px-6 py-3 rounded-e-lg">
                    تعداد سوالات غلط
                </th>
            </tr>
            </thead>
            <tbody>
            <tr class="bg-white dark:bg-gray-800">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$data->user->name}}
                </th>
                <td class="px-6 py-4">
                    {{$time}}
                </td>

                <td class="px-6 py-4">
                    {{$score}}
                </td>
                <td class="px-6 py-4">
                    {{$count_true_answer}}
                </td>
                <td class="px-6 py-4">
                    {{$count_false_answer}}
                </td>
            </tr>

            </tbody>

        </table>
    </div>


    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    شماره سوال
                </th>
                <th scope="col" class="px-6 py-3">
                    1
                </th>
                <th scope="col" class="px-6 py-3">
                    2
                </th>
                <th scope="col" class="px-6 py-3">
                    3
                </th>
                <th scope="col" class="px-6 py-3">
                    4
                </th>
            </tr>
            </thead>
            <tbody>
            @php
                $i = 0 ;

            @endphp
            @foreach($questions as $question)
                @php
                    $i++ ;
                @endphp
                <tr class="bg-red-200 border-b dark:bg-gray-800 dark:border-gray-700" id="row-{{$i}}">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$i}}
                    </th>
                    <td class="px-6 py-4 answer" id="answer-{{$i}}-1">
                        @foreach(explode(',',$data->answers) as $Answer)
                            @foreach($answers as $answer_quiz)
                                @foreach($answer_quiz as $answer)
                                    @if($Answer == $answer->id)
                                        @if(round($Answer/4) == $Answer/4-0.25)
                                            @if($question->id == $answer->question_id)
                                                <span id="userAnswer1">{{'جواب شما'}}</span>
                                            @endif
                                        @endif
                                    @endif
                                @endforeach
                            @endforeach
                        @endforeach

                        @foreach($answers as $answer_quiz)
                            @foreach($answer_quiz as $answer)
                                @if($answer->is_true_answer == 1)
                                    @if(round($answer->id/4) == $answer->id/4-0.25)
                                        @if($question->id == $answer->question_id)
                                            <span id="trueAnswer1">{{'جواب درست'}}</span>
                                        @endif
                                    @endif
                                @endif
                            @endforeach
                        @endforeach

                    </td>
                    <td class="px-6 py-4 answer" id="answer-{{$i}}-2">
                        @foreach(explode(',',$data->answers) as $Answer)
                            @foreach($answers as $answer_quiz)
                                @foreach($answer_quiz as $answer)
                                    @if($Answer == $answer->id)
                                        @if(round($Answer/4) == $Answer/4+0.5)
                                            @if($question->id == $answer->question_id)
                                                <span id="userAnswer2">{{'جواب شما'}}</span>
                                            @endif
                                        @endif
                                    @endif
                                @endforeach
                            @endforeach
                        @endforeach
                        @foreach($answers as $answer_quiz)
                            @foreach($answer_quiz as $answer)
                                @if($answer->is_true_answer == 1)
                                    @if(round($answer->id/4) == $answer->id/4+0.5)
                                        @if($question->id == $answer->question_id)
                                            <span id="trueAnswer2">{{'جواب درست'}}</span>
                                        @endif
                                    @endif
                                @endif
                            @endforeach
                        @endforeach
                    </td>
                    <td class="px-6 py-4 answer" id="answer-{{$i}}-3">
                        @foreach(explode(',',$data->answers) as $Answer)
                            @foreach($answers as $answer_quiz)
                                @foreach($answer_quiz as $answer)
                                    @if($Answer == $answer->id)
                                        @if(round($Answer/4) == $Answer/4+0.25)
                                            @if($question->id == $answer->question_id)
                                                <span id="userAnswer3">{{'جواب شما'}}</span>
                                            @endif
                                        @endif
                                    @endif
                                @endforeach
                            @endforeach
                        @endforeach
                        @foreach($answers as $answer_quiz)
                            @foreach($answer_quiz as $answer)
                                @if($answer->is_true_answer == 1)
                                    @if(round($Answer/4) == $answer->id/4+0.25)
                                        @if($question->id == $answer->question_id)
                                            <span id="trueAnswer3">{{'جواب درست'}}</span>
                                        @endif
                                    @endif
                                @endif
                            @endforeach
                        @endforeach
                    </td>
                    <td class="px-6 py-4 answer" id="answer-{{$i}}-4">
                        @foreach(explode(',',$data->answers) as $Answer)
                            @foreach($answers as $answer_quiz)
                                @foreach($answer_quiz as $answer)
                                    @if($Answer == $answer->id)
                                        @if(round($Answer/4) == $Answer/4)
                                            @if($question->id == $answer->question_id)
                                                <span id="userAnswer3">{{'جواب شما'}}</span>
                                            @endif
                                        @endif
                                    @endif
                                @endforeach
                            @endforeach
                        @endforeach

                        @foreach($answers as $answer_quiz)
                            @foreach($answer_quiz as $answer)
                                @if($answer->is_true_answer == 1)
                                    @if(round($answer->id/4) == $answer->id/4)
                                        @if($question->id == $answer->question_id)
                                            <span id="trueAnswer4">{{'جواب درست'}}</span>
                                        @endif
                                    @endif
                                @endif
                            @endforeach
                        @endforeach

                    </td>
                </tr>
                <script>
                    if (document.getElementById('answer-1-1').innerText === 'جواب شما جواب درست')   {
                        document.getElementById('answer-1-1').innerText = 'درست زدی'
                        document.getElementById('row-1').classList.add('bg-green-200')
                    }
                    if (document.getElementById('answer-1-2').innerText === 'جواب شما جواب درست')   {
                        document.getElementById('answer-1-2').innerText = 'درست زدی'
                        document.getElementById('row-1').classList.add('bg-green-200')
                    }
                    if (document.getElementById('answer-1-3').innerText === 'جواب شما جواب درست')   {
                        document.getElementById('answer-1-3').innerText = 'درست زدی'
                        document.getElementById('row-1').classList.add('bg-green-200')
                    }
                    if (document.getElementById('answer-1-4').innerText === 'جواب شما جواب درست')   {
                        document.getElementById('answer-1-4').innerText = 'درست زدی'
                        document.getElementById('row-1').classList.add('bg-green-200')
                    }
                    if (document.getElementById('answer-2-1').innerText === 'جواب شما جواب درست')   {
                        document.getElementById('answer-2-1').innerText = 'درست زدی'
                        document.getElementById('row-2').classList.add('bg-green-200')
                    }
                    if (document.getElementById('answer-2-2').innerText === 'جواب شما جواب درست')   {
                        document.getElementById('answer-2-2').innerText = 'درست زدی'
                        document.getElementById('row-2').classList.add('bg-green-200')
                    }
                    if (document.getElementById('answer-2-3').innerText === 'جواب شما جواب درست')   {
                        document.getElementById('answer-2-3').innerText = 'درست زدی'
                        document.getElementById('row-2').classList.add('bg-green-200')
                    }
                    if (document.getElementById('answer-2-4').innerText === 'جواب شما جواب درست')   {
                        document.getElementById('answer-2-4').innerText = 'درست زدی'
                        document.getElementById('row-2').classList.add('bg-green-200')
                    }
                    if (document.getElementById('answer-3-1').innerText === 'جواب شما جواب درست')   {
                        document.getElementById('answer-3-1').innerText = 'درست زدی'
                        document.getElementById('row-3').classList.add('bg-green-200')
                    }
                    if (document.getElementById('answer-3-2').innerText === 'جواب شما جواب درست')   {
                        document.getElementById('answer-3-2').innerText = 'درست زدی'
                        document.getElementById('row-3').classList.add('bg-green-200')
                    }
                    if (document.getElementById('answer-3-3').innerText === 'جواب شما جواب درست')   {
                        document.getElementById('answer-3-3').innerText = 'درست زدی'
                        document.getElementById('row-3').classList.add('bg-green-200')
                    }
                    if (document.getElementById('answer-3-4').innerText === 'جواب شما جواب درست')   {
                        document.getElementById('answer-3-4').innerText = 'درست زدی'
                        document.getElementById('row-3').classList.add('bg-green-200')
                    }
                    if (document.getElementById('answer-4-1').innerText === 'جواب شما جواب درست')   {
                        document.getElementById('answer-4-1').innerText = 'درست زدی'
                        document.getElementById('row-4').classList.add('bg-green-200')
                    }
                    if (document.getElementById('answer-4-2').innerText === 'جواب شما جواب درست')   {
                        document.getElementById('answer-4-2').innerText = 'درست زدی'
                        document.getElementById('row-4').classList.add('bg-green-200')
                    }
                    if (document.getElementById('answer-4-3').innerText === 'جواب شما جواب درست')   {
                        document.getElementById('answer-4-3').innerText = 'درست زدی'
                        document.getElementById('row-4').classList.add('bg-green-200')
                    }
                    if (document.getElementById('answer-4-4').innerText === 'جواب شما جواب درست')   {
                        document.getElementById('answer-4-4').innerText = 'درست زدی'
                        document.getElementById('row-4').classList.add('bg-green-200')
                    }






                </script>
            @endforeach

            </tbody>
        </table>
    </div>

</div>

@endsection
