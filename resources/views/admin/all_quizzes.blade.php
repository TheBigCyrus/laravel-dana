@extends('admin.template')

@section('title')
    پیشخوان
@endsection
@section('quiz')
bg-gray-200
@endsection





@section('content')




    <div class="relative overflow-x-auto shadow-md sm:rounded-lg m-4 text-gray-900">

        <table class="w-full text-sm text-left rtl:text-right text-gray-8000 dark:text-gray-400 ">
            <thead class="text-xs text-gray-900 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
            <tr>

                <th scope="col" class="px-6 py-3 text-xs md:text-md">
                    عنوان
                </th>

                <th scope="col" class="px-6 py-3 text-xs md:text-md">
                    دسته بندی
                </th>
                <th scope="col" class="px-6 py-3 text-xs md:text-md">
                    طراح
                </th>
                <th scope="col" class="px-6 py-3 text-xs md:text-md">
                    تعداد سوالات
                </th>
                <th scope="col" class="px-6 py-3 text-xs md:text-md">
                    تاریخ ایجاد
                </th>

                <th scope="col" class="px-6 py-3 text-xs md:text-md">
                    ویرایش
                </th>
                <th scope="col" class="px-6 py-3 text-xs md:text-md">
                    حذف
                </th>
            </tr>

            </thead>
            <tbody>

            @foreach($quizzes as $quiz)
                <tr class="bg-gray-100 border-b dark:text-gray-800 dark:border-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600">

                    <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-gray-900">
                        <div class="ps-3">
                            <div class="text-base font-semibold text-xs md:text-md">{{ $quiz->title }}</div>
                        </div>
                    </th>
                    <td class="px-6 py-4  text-xs md:text-md">
                        {{ $quiz->category->title }}
                    </td>
                    <td class="px-6 py-4  text-xs md:text-md">
                        {{ $quiz->creator->name }}
                    </td>
                    <td class="px-6 py-4 text-xs md:text-md">
                        {{ $quiz->total_questions }}
                    </td>
                    <td class="px-6 py-4 text-xs md:text-md">
                        {{ $quiz->created_at }}
                    </td>

                    <td class="px-6 py-4 text-xs md:text-md">
                        <a href="/quiz/del/quiz/{{$quiz->id}}" class="bg-red-400 text-l p-3 rounded-2xl hover:bg-red-600 hover:shadow-2xl hover:text-white">حذف</a>

                    </td>
                    <td class="px-6 py-4 text-xs md:text-md">
                        <a href="/admin/edit/quiz/{{$quiz->id}}" class="bg-yellow-400 text-l p-3 rounded-2xl hover:bg-yellow-600 hover:shadow-2xl hover:text-white">ویرایش</a>

                    </td>

                </tr>



            @endforeach
            </tbody>
        </table>
    </div>

    </div>


@endsection
