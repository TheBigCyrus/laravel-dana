<?php

namespace App\Http\Controllers;

use App\Http\Requests\HandleReplayLikeRequest;
use App\Http\Requests\HandleReplayRequest;
use App\Http\Requests\reportRequest;
use App\Http\Requests\TicketRequest;
use App\Http\Requests\Topic\CreateTopicRequest;
use App\Models\Carousel;
use App\Models\Category;
use App\Models\Group;
use App\Models\Member;
use App\Models\Quiz;
use App\Models\QuizAction;
use App\Models\Replay;
use App\Models\Replaydislike;
use App\Models\ReplayLike;
use App\Models\Reporter;
use App\Models\Ticket;
use App\Models\Todo;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Morilog\Jalali\Jalalian;

class SiteController extends Controller
{
    public function Home()
    {

        $quizzes = Quiz::latest()->take(2)->get();
        if (Auth::check()){
            $memberAceept = Member::where('user_id' , Auth::id())->where('status' , 'accepted')->first();
            if ($memberAceept !== null){
                $group = Group::where('id' , $memberAceept->group_id )->first();
                $todos = Todo::where('group_id' , $group->id)->latest()->take(3)->get();
            }else{
                $todos = [];
            }
        }else{
            $todos = [];
        }

        $topices = Topic::latest()->take(3)->get();
        $carousel = Carousel::where('type' , 'center')->get();
        return view('index', ['quizzes' => $quizzes , 'topices' => $topices , 'carousels' => $carousel , 'todos' => $todos]);
    }
    public function registration()
    {
        return view('registration');
    }
    public function notify($message , $type )
    {
        return view('notification')->with([
            'message' => $message,
            'type'    => $type,
            'link'    => ['url' => route('home'), 'title' => "برگشت به سایت"]
        ]);
    }

    public function handleTicket(TicketRequest $request)
    {
Ticket::create([
    'title' => $request->title ,
    'body' => $request->body ,
    'user_id' => Auth::id()
]) ;
return redirect()->back();
    }
    public function profile()
    {
        $topic_number = Topic::where('creator_id' , Auth::id() )->count();
        $topics = Topic::where('creator_id' , Auth::id() )->get();
        $QuizAction = QuizAction::where('user_id' , Auth::id() )->get();
        $countQuizAction = QuizAction::where('user_id' , Auth::id() )->count();
        $Ticket = Ticket::where('user_id' , Auth::id() )->get();
        $user = User::find(Auth::id());
        return view('profile')->with(['topic_number' => $topic_number ,'user' => $user ,'tickets' => $Ticket , 'QuizAction' => $QuizAction ,'topics' => $topics , 'countQuizAction' => $countQuizAction]);
    }

    public function reportTopic(Request $request , $topic_id)
    {
$topic = Topic::find($topic_id);
if ($topic->reports == null){
    $topic->reports = 1;
    Reporter::create(['reporter_id' => Auth::id() , 'topic_id' => $topic_id]);
    $topic->save();
}elseif ($topic->reports == 1){
    $topic->reports = 2;
    Reporter::create(['reporter_id' => Auth::id() , 'topic_id' => $topic_id]);
    $topic->save();
}elseif ($topic->reports == 2){
    $topic->reports = 3;
    $topic->status = 'pending';
    Reporter::create(['reporter_id' => Auth::id() , 'topic_id' => $topic_id]);
    $topic->save();
}
        return view('notification')->with([
            'message' => 'این تاپیک گزارش شد و صدرصد توسط ادمین بازبینی خواهد شد باتشکر از شما کاربر وظیفه شناس',
            'type'    => 'success',
            'link'    => ['url' => route('home'), 'title' => "برگشت به سایت"]
        ]);
    }
    public function handleProfileImage(Request $request)
    {
        $user = User::find(Auth::id());
        $img = $request->file('profileImage')->store(options: 'public');
        $user->profileImage = $img ;
        $user->save();
        return redirect('/profile') ;
    }
    public function HandleReplay(HandleReplayRequest $request)
    {
        $user = '';
        if (auth()->check()){
            $user = Auth::id();
        }elseif (auth()->guard('teacher')->check()){
            $user = Auth::guard('teacher')->id();

        }elseif (auth()->guard('admin')->check()){
            $user = Auth::guard('admin')->id();
        }
        $Replay = Replay::create([
            'body'         => $request->comment,
            'topic_id'  => $request->hidden,
            'title'  => 'باید تایتل رو حذف کنم',
            'creator_id'   => $user
        ]);
        return redirect("/topics/show/$request->hidden");
    }

    public function ShowAllTopics()
    {


        return view('all_topics', [
            'categories' => Category::all(['id', 'title']),
            'user_id' => Auth::id(),
            'topics' => Topic::with('users' , 'replays')->where('status' , 'Active')->latest()->paginate(10)
        ]);
    }
    public function ShowAllTopicsFiltered(Request $request)
    {

        return view('all_topics', [
            'categories' => Category::all(['id', 'title']),
            'jalali' => '10',
            'topics' => Topic::with('users' , 'replays')->where('status' , 'Active')->where('category_id' , $request->category_id)->paginate(10)
        ]);
    }

    public function ShowTopic(Request $request, $topicId)
    {
        $topic = Topic::findOrFail($topicId);
        return view('show_topic', [
            'topic' => $topic
        ]);
    }

    public function ShowCreateTopic()
    {
        return view('create_topic', [
            'categories' => Category::all()
        ]);
    }

    public function HandleCreateTopic(CreateTopicRequest $request)
    {

        $topic = Topic::create([
            'body'         => $request->body,
            'title'        => $request->title,
            'category_id'  => $request->category,
            'creator_id'   => $user = Auth::id() ,
            'status' => 'Active'
        ]);
        return redirect('/topics/show/'.$topic->id);
    }

    public function HandleReplayLike(HandleReplayLikeRequest $request)
    {
        $reply = Replay::findOrFail($request->input('replayID'));
        $ReplayLike = ReplayLike::where('topic_id',$reply->topic_id)->where('creator_id' , auth()->id())->where('replay_id',$reply->id)->count();

if ($ReplayLike == 0){
        $like = ReplayLike::create([
            'topic_id'     => $reply->topic_id,
            'creator_id'   => auth()->id(),
            'replay_id'    => $reply->id
        ]);
    }else{
    ReplayLike::where('topic_id',$reply->topic_id)->where('creator_id' , auth()->id())->where('replay_id',$reply->id)->delete();
}
        return response()->json(
            ['data' => ReplayLike::where('replay_id' , $request->input('replayID'))->count()-Replaydislike::where('replay_id' ,$request->input('replayID'))->count(),
             'status' => 'success'
                ]
        );
    }

    public function HandleReplayDisLike(HandleReplayLikeRequest $request)
    {
        $reply = Replay::findOrFail($request->input('replayID'));
        $ReplayLike = Replaydislike::where('topic_id',$reply->topic_id)->where('creator_id' , auth()->id())->where('replay_id',$reply->id)->count();

        if ($ReplayLike == 0){
            $like = Replaydislike::create([
                'topic_id'     => $reply->topic_id,
                'creator_id'   => auth()->id(),
                'replay_id'    => $reply->id
            ]);
        }else{
            Replaydislike::where('topic_id',$reply->topic_id)->where('creator_id' , auth()->id())->where('replay_id',$reply->id)->delete();
        }
        return response()->json(
            ['data' => ReplayLike::where('replay_id' , $request->input('replayID'))->count()-Replaydislike::where('replay_id' ,$request->input('replayID'))->count(),
                'status' => 'success'
            ]
        );
    }
}
