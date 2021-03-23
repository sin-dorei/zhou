<?php

namespace App\Observers;

use App\Models\Topic;
use App\Handlers\SlugTranslateHandler;

class TopicObserver
{
    public function saving(Topic $topic)
    {
        if (empty($topic->body = clean($topic->body, 'user_topic_body'))) {
            session()->flash('warning', '该文章未通过安全检测，请重新编辑！');
            $topic->body = '该文章未通过安全检测，请重新编辑！';
        }

        $topic->excerpt = make_excerpt($topic->body);

        // 如 slug 字段无内容，即使用翻译器对 title 进行翻译
        if ( ! $topic->slug) {
            $topic->slug = app(SlugTranslateHandler::class)->translate($topic->title);
        }
    }
}
