<?php

namespace App\Http\Controllers;

use App\Http\Requests\handleMakeGroupRequest;
use App\Models\Category;
use App\Models\Group;
use App\Models\Member;
use App\Models\Todo;
use App\Models\Topic;
use App\Models\User;
use App\Services\VerificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class todoController extends Controller
{


    public function ShowSearch(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('todo.search');
    }
    public function ShowGroup(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $mwmber = Member::where('user_id' , Auth::id())->where('status' , 'accepted')->first();

       if (Member::where('user_id' , Auth::id())->where('status' , 'accepted')->count() == 1){
           $group = Group::find($mwmber->group_id);
           $todos = Todo::where('group_id' , $group->id)->latest()->get();
           $members = Member::where('status' , 'pending')->get();
       }


        return view('todo.group')->with(['group' => $group , 'todos' => $todos , 'pendingMembers' => $members , 'thisUser' => $mwmber ]);
    }

    public function searchGroup(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $content = Group::where('code' , $request->search)->firstOrFail();
        return view('todo.search')->with('content' , $content);
    }

    public function request(Request $request , $id): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        Member::create([
            'user_id' => Auth::id(),
            'group_id' => $id,
            'admin' => 0,
        ]);
        return view('notification')->with([
            'message' => 'درخواست شما ارسال شد باید توسط مالک گروه تایید بشید ',
            'type'    => 'success',
            'link'    => ['url' => '/', 'title' => "برگشت به سایت"]
        ]);
    }


    public function accept(Request $request , $id): \Illuminate\Http\RedirectResponse
    {
        $member = Member::find($id);
        $member->status = 'accepted';
        $member->save();
        return redirect()->route('todo.show.group');
    }
    public function fail(Request $request , $id): \Illuminate\Http\RedirectResponse
    {
        $member = Member::find($id);
        $member->status = 'failed';
        $member->save();
        return redirect()->route('todo.show.group');
    }


    public function makeGroup(handleMakeGroupRequest $request): \Illuminate\Http\RedirectResponse
    {
        $code = VerificationService::generteCode();
       $group =  Group::create([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'owner_id' => Auth::id(),
            'code' => $code
        ]);
        Member::create([
            'user_id' => Auth::id(),
            'group_id' => $group->id,
            'admin' => 1,
            'status' => 'accepted'
        ]);
        return redirect()->route('todo.show.group');
    }

    public function makeTodo(Request $request): \Illuminate\Http\RedirectResponse
    {
        $group = Group::find($request->input('group_id'));
        $Member = Member::where('group_id',$request->input('group_id'))->where('user_id' ,  Auth::id())->where('status' , 'accepted')->first();

        if ($group->owner_id == Auth::id()){
        Todo::create([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'from' => $request->input('from'),
            'to' => $request->input('to'),
            'creator_id' => Auth::id(),
            'group_id' => $request->input('group_id') ,
            'subject' => $request->input('subject')
        ]);
    }elseif ($Member->admin == '1'){
            Todo::create([
                'title' => $request->input('title'),
                'body' => $request->input('body'),
                'from' => $request->input('from'),
                'to' => $request->input('to'),
                'creator_id' => Auth::id(),
                'group_id' => $request->input('group_id') ,
                'subject' => $request->input('subject')
            ]);
}


        return redirect()->route('todo.show.group');


}}
