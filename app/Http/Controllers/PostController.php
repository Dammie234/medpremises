<?php

namespace App\Http\Controllers;
use DB;
use Str;
use Image;
use App\Post;
use App\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function userPosts($id)
    {
        $user = User::where('id', $id)->first();
        $posts = DB::table('posts')->where('user_id', $user->id)->select('id', 'title', 'categories', 'created_at', 'likes')->orderBy('id', 'desc')->get();
        return response()->json($posts);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'content' => 'required|string',
            'categories' => 'required',
            'featured_image' => 'required'
        ]);

        $user = User::where('id', $request->id)->first();
        $data = [
            'user_id' => $user->id,
            'title' => $request->title,
            'slug' => Str::slug($request->title, '-'),
            'content' => $request->content,
            'categories' => implode(',', $request->categories),
            'facility_id' => $user->facility_id,
        ];
        if ($request->featured_image) {
            $image = $request->featured_image;
            $position = strpos($image, ';');
            $sub = substr($image, 0, $position);
            $ext = explode('/', $sub)[1];

            $image_name = time() . "." . $ext;
            $img = Image::make($image)->resize(1920,1280);
            $upload_path = 'dist/images/posts/';
            $image_url = $upload_path . $image_name;
            $img->save($image_url);
            $data['featured_image'] = $image_url;

            Post::create($data);
        }
    }
    public function show($id)
    {
        return response()->json(Post::where('id', $id)->first());
    }
    public function updatePost(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'content' => 'required|string',
            'categories' => 'required'
        ]);
        Post::where('id', $id)->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title, '-'),
            'content' => $request->content,
            'categories' => implode(',', $request->categories)
        ]);
    }
    public function updateFeaturedImage(Request $request, $id)
    {
        $this->validate($request, [
            'featured_image' => 'required'
        ]);
        $data = [];
        $post = Post::where('id', $id)->first();
        if ($request->featured_image) {
            $image = $request->featured_image;
            $position = strpos($image, ';');
            $sub = substr($image, 0, $position);
            $ext = explode('/', $sub)[1];

            $image_name = time() . "." . $ext;
            $img = Image::make($image)->resize(1920,1280);
            $upload_path = 'dist/images/posts/';
            $image_url = $upload_path . $image_name;
            $success = $img->save($image_url);
            if ($success) {
                $data['featured_image'] = $image_url;
                if(isset($post->featured_image)){
                    unlink($post->featured_image);
                }
            }

            Post::where('id', $id)->update($data);
        }
    }
    public function destroy($id)
    {
        $post = Post::where('id', $id)->first();
        if(isset($post->featured_image)){
            unlink($post->featured_image);
        }
        Post::where('id', $id)->delete();
    }
}
