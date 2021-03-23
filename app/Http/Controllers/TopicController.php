<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
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
        $this->authorize('update', $topic);
        $categories = Category::all();
        return view('topics.create_and_edit', compact('topic', 'categories'));
    }

    public function update(Request $request, Topic $topic)
    {
        $this->authorize('update', $topic);
        $topic->update($request->all());

        return redirect()->route('topics.show', $topic->id)->with('success', '更新成功！');
    }

    public function destroy(Topic $topic)
    {
        //
    }

    public function uploadImage(Request $request, ImageUploadHandler $uploader)
    {
        $data = [
            'success' => false,
            'msg' => '上传失败！',
            'file_path' => ''
        ];

        if ($file = $request->upload_file) {
            $result = $uploader->save($file, 'topics', \Auth::id(), 1024);
            if ($result) {
                $data['file_path'] = $result['path'];
                $data['msg'] = '上传成功！';
                $data['success'] = true;
            }
        }

        return $data;
    }
}
