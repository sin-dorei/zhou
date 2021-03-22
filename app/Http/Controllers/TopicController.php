<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Topic;
use App\Http\Requests\TopicRequest;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index(Request $request)
    {
        $topics = Topic::withOrder($request->order)->with('category', 'user')->paginate(10);

        return view('topics.index', compact('topics'));
    }

    public function create(Topic $topic)
    {
        $categories = Category::all();

        return view('topics.create_and_edit', compact('topic', 'categories'));
    }

    public function store(TopicRequest $request, Topic $topic)
    {
        $topic->fill(request()->all());
        $topic->user_id = \Auth::id();
        $topic->save();

        return redirect()->route('topics.show', $topic)->with('success', '帖子创建成功！');
    }

    public function show(Topic $topic)
    {
        return view('topics.show', compact('topic'));
    }

    public function edit(Topic $topic)
    {
        //
    }

    public function update(Request $request, Topic $topic)
    {
        //
    }

    public function destroy(Topic $topic)
    {
        //
    }
}
