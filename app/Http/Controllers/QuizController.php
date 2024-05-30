<?php

namespace App\Http\Controllers;

use App\Http\Requests\handleSubmitQuizRequest;
use App\Http\Requests\Quiz\CreateQuizRequest;
use App\Http\Requests\Quize\createQuizeRequest;
use App\Http\Requests\Quize\handleEditQuizRequest;
use App\Models\Answer;
use App\Models\Category;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\QuizAction;
use App\Models\Teacher;
use App\Services\BaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class QuizController extends Controller
{
    public function ShowExam(Request $request, Quiz $quiz)
    {
        $code = Str::random(16);
        if (QuizAction::where('user_id' , auth()->id())->where('finished_quiz' , 0)->count() == 0){

        QuizAction::create([
            'code'     => $code,
            'user_id'  => auth()->id(),
            'quiz_id'  => $quiz->id,
        ]);}
;

        return view('quiz.quizPage', ['quiz' => $quiz, 'code' => $code]);
    }
    public function ShowExam2(Request $request)
    {

        return view('quiz.quizPage_2');
    }
    public function Show()
    {
    $quiz = Quiz::all();
    $Category = Category::all();

        return view('quiz.all', ['quizzes' => $quiz , 'Category' => $Category]);
    }
    public function ShowFiltered(Request $request)
    {
        $quiz = Quiz::where('category_id',$request->filter)->get();
        $Category = Category::all();


        return view('quiz.all', ['quizzes' => $quiz , 'Category' => $Category]);
    }
    public function ShowDetail(Request $request , $quiz)
    {
        $quizDetail = Quiz::with('creator' , 'category')->find($quiz);


        return view('quiz.detail', ['quiz' => $quizDetail]);
    }
    public function showKarname(Request $request)
    {

        return view('quiz.karname');
    }

    public function DeleteExam(Request $request , $quiz)
    {

        $foundedQuiz = Quiz::find($quiz);
        $foundedQuiz->delete();
        $CreatorType = BaseService::getCreatorType();
        return redirect()->route($CreatorType[1].'.show.all.quiz');
    }

    public function Create(createQuizRequest $request )
    {


        $creatorType = BaseService::getCreatorType();

        try {
            DB::beginTransaction();

            $quiz = Quiz::create([
                'title'            => $request->input('quiz_title'),
                'creator_type'     => $creatorType[0] ,
                'creator_id'       => auth()->guard($creatorType[1])->id(),
                'category_id'      => $request->input('categories'),
                'total_questions'  => $request->input('countQuestion') ,
                'quiz_time'        => $request->input('quiz_time')
            ]);


            foreach ($request->input('questions') as $key => $q)
            {


                $question = Question::create([
                    'title'   => $q['title'],
                    'quiz_id' => $quiz->id ,

                ]);

                foreach ($q['answers'] as $keyanswer => $bodyAnswer)
                {



                    $answer = Answer::create([
                        'question_id'    => $question->id ,
                        'body'           => $bodyAnswer["body"],
                        'is_true_answer' => $q["true_answer"] == $keyanswer ,

                    ]);

                    if ($request->file('questions')) {

                        foreach ($request->file('questions') as $keyImage => $qq) {

                            $image = $qq['image']->store(options: 'public');
                            if ($key == $keyImage){
                            $question->image = $image;
                            $question->save();
                            if (isset($qq['answers'])) {
if ($answer->question_id == $question->id){
                                foreach ($qq['answers'] as $answer_images_key => $answer_images) {
                                    if ($keyanswer == $answer_images_key){

                                    $answer_image = $answer_images['image']->store(options: 'public');
                                    $answer->image = $answer_image;
                                    $answer->save();
                                }}
                            }}

                            }
                        }
                    }
                }

            }

            DB::commit();
            return redirect()->route($creatorType[1].'.show.all.quiz');
        }
        catch (\Exception $exception)
        {
            DB::rollBack();
            Log::error("Error On Call Create Quiz, Message:{$exception->getMessage()} Questions: ". print_r($request->input('questions'), true) ." Answers: ". print_r($request->input('answers'), true) .", Params: " . print_r($request->all(), true));
            return redirect()->back()->with(['errors' => 'مشکلی رخ داده لطفا با پشتیبانی تماس بگیرید']);
        }
    }


    public function handleEditQuiz(handleEditQuizRequest $request)
    {
        $creatorType = BaseService::getCreatorType();

        try {
            DB::beginTransaction();
            foreach ($request->input('questions') as $q)
            {
                $questions = Question::where('quiz_id' , $request->input('quiz_id'))->get();

                foreach ($questions as $question ) {
                    foreach ($q['title'] as $key => $title)
                    {
                        if ($key == $question->id){
                            $question->title = $title;
                            $question->save();
                        }}
                    foreach ($q['answers'] as $key => $bodyAnswer)
                    {

                        $Answers = Answer::where('question_id' , $question->id)->get();
                        foreach ($Answers as $Answer ) {
                            if ($key == $Answer->id){
                                $Answer->body = $bodyAnswer;
                                $Answer->is_true_answer = $q["true_answer"] == $key;
                                $Answer->save();
                            }}}


                }}

            DB::commit();
            return redirect()->route($creatorType[1].'.show.all.quiz');
        }
        catch (\Exception $exception)
        {
            DB::rollBack();
            return redirect()->back()->with(['errors' => 'مشکلی رخ داده لطفا با پشتیبانی تماس بگیرید']);
        }
    }

    public function handleSubmitQuiz(handleSubmitQuizRequest $request)     {

        try {
            DB::beginTransaction();

            $userAnswers = $request->input('answers');
            $quiz_code = QuizAction::where('code' , $request->input('quiz_code'))->first() ;
            $count_true_answer = DB::table('answers')
                ->whereIn('id', $userAnswers)
                ->where('is_true_answer', true)
                ->count();
            $count_false_answer = DB::table('answers')
                ->whereIn('id', $userAnswers)
                ->where('is_true_answer', false)
                ->count();
            $count_all_answer = DB::table('answers')
                ->whereIn('id', $userAnswers)
                ->count();

            $Score = 100/$count_all_answer*$count_true_answer;
            $answers = [] ;
            $quiz_code->score = $Score ;
            $quiz_code->finished_quiz = 1 ;
            $quiz_code->answers = implode(',',$userAnswers) ;
            $quiz_code->save();
            $quiz = Quiz::find($quiz_code->quiz_id) ;
            $questions = Question::where('quiz_id' , $quiz->id)->get() ;
            foreach ($questions as $question){
            $answers[$question->id] = Answer::where('question_id' , $question->id)->get() ;
            }
            DB::commit();
            return view('quiz.karname')->with(['data' => $quiz_code ,'time'=> $quiz_code->created_at,'count_false_answer' => $count_false_answer, 'count_true_answer' => $count_true_answer ,'count_all_answer' => $count_all_answer ,'score' => $Score,'questions' => $questions,'userAnswers' => $userAnswers,'answers' => $answers
                , 'quiz' => $quiz]);


        }
        catch (\Exception $exception)
        {
            Log::error("Error On Call Create Quiz, Message:{$exception->getMessage()} "." Params: " . print_r($request->all(), true));
            DB::rollBack();
            return redirect()->back()->with(['errors' => $quiz_code]);
        }
    }
}
