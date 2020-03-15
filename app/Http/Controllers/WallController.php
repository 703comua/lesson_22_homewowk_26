<?php


namespace App\Http\Controllers;


use App\Post;
use Cassandra\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\DocBlock\Tags\Link;

class WallController
{
    public function  index()
    {
        $user = Auth::user();

        $posts = $user->posts()->latest()->get();

        return view('wall', ['posts' => $posts]);
    }

    public function create()
    {
        return view('create-post');
    }

    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required|min:5|max:1000',
        ]);


//        $string = "The text you want to filter goes here. http://google.com, https://www.youtube.com/watch?v=K_m7NEDMrV0,https://instagram.com/hellow/";

        $text = $request->get('text');

        preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $text, $match);

//        dd($match[0]);

        foreach ($match[0] as $source_link) {
            $link = new \App\Link();
            $link->short_code = uniqid();
            $link->source_link = $source_link;
//            dd($link->short_code);

            Auth::user()->links()->save($link);
            $shortLink = env('APP_URL') . '/r/' . $link->short_code;
//            dd($shortLink);

            $text = str_replace($source_link, sprintf('<a href="%s">%s</a>', $shortLink, $shortLink), $text);
//            dd($text);
        }
//        exit();

        $post = new Post();
        $post->id = \Ramsey\Uuid\Uuid::uuid4()->toString();
//        $post->user_id = Auth::id();
        $post->text = $text;
//        $post->save();

        Auth::user()->posts()->save($post);

        return redirect()->route('wall.index');
    }
}
