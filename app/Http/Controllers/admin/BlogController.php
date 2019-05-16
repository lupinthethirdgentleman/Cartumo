<?php

namespace App\Http\Controllers\admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Blog;
use Validator;
use App\BaseUrl;
use App\BlogCategory;
use App\BlogHasCategory;
use Auth;
use Image;


class BlogController extends Controller
{
	public function index()
	{
		$blogs = Blog::get();
		
		return view('admin.blogs.index', ['blogs'=>$blogs]);
	}

	public function ajax_switch(Request $request)
    {
    	$response = [
    		'success' => null
    	];

	    if ($request->ajax()) 
	    {
	        $blog = Blog::find($request->id);

	        if ( $blog->status == 1 )
	        {
	        	$blog->status = 0;
	        }
	        else
	        {
	        	$blog->status = 1;
	        }

	        if ( $blog->save() )
	        {
	        	$response['success'] = 1;

	        }
	    }

	    return json_encode($response);
    }

	public function create()
	{
		$blogCategories = BlogCategory::get();

		return view('admin.blogs.create', ['blogCategories' => $blogCategories]);
	}

	public function store(Request $request)
	{
		$inputs = [
					'title'		  => $request->title,
					'description' => $request->description,
					'image'		  => $request->image,
					'status'	  => $request->status,
				];

		$rules  = [
					'title' 	  => 'required|max:255',
					'description' => 'required',	
					'image' 	  => 'required|image|dimensions:min_width=500, min_height=250|mimes:jpeg,png,jpg',
					'status'	  => 'required',

				];	

		$return = [
					'image.required' => 'Image should in minimum 500x250.',
				];		

		$validator = Validator::make($inputs, $rules, $return);

		if($validator->fails())
		{
			return redirect()->back()->withErrors($validator)->withInput()->with( [ 'error' , 'title' => $request->title, 'description' => $request->description, 'image' => $request->image, 'status' => $request->status, ] );
		}

		$image = $request->image;

		if(!empty($_FILES['image']['name']))
		{
			$path_info = pathinfo($_FILES['image']['name']);
			$ext = $path_info['extension'];
			$ext = strtolower($ext);

			if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png')
			{
				$file_name 	 = microtime();
				$image  	 = $file_name.'.'.$ext;
				$destination = base_path() . '/' . BaseUrl::getBlogImageUrl() . '/';

				move_uploaded_file($_FILES['image']['tmp_name'], $destination.$image);

	            //resize image for recent posts thumbnails
				$recent_posts_thumbnail = Image::make($destination . $image)->resize(null, 65, function ($constraint) {
					    $constraint->aspectRatio();
					});
				$recent_posts_thumbnail->save(base_path() . '/' . BaseUrl::getRecentPostsThumbnailUrl() . '/' . $image);

	            //resize image for blogs listing thumbnails
				$blogs_listing_thumbnails = Image::make($destination . $image)->resize(null, 165, function ($constraint) {
					    $constraint->aspectRatio();
					});

				$blogs_listing_thumbnails->save(base_path() . '/' . BaseUrl::getBlogListingThumbnailUrl() . '/' . $image);
			}
		}

		$blog = new Blog;
		$blog->user_id = Auth::id();
		$blog->title   = $request->title;
		$blog->description = $request->description;
		$blog->status = $request->status;
		$blog->image  = $image;

		if($blog->save())
		{
			foreach ($request->categories as $value) 
			{
				$blogHasCategory = new BlogHasCategory;
				$blogHasCategory->blog_category_id = $value;
				$blogHasCategory->blog_id = $blog->id;
				$blogHasCategory->save();
			}

			return redirect()->route('admin.blogs.index')->with('success', 'Blog has been added Successfully');

		}

	}

	public function show($id)
	{
		$blog = Blog::find($id);

		if(!$blog)
		{
			return redirect()->route('admin.blogs.index')->with('error', 'Blog not found.');
		}

		$blogCategories = BlogCategory::get();
		$blogHasCategories = BlogHasCategory::where('blog_id', $blog->id)->pluck('blog_category_id');
		$blogHasCategories = json_decode(json_encode($blogHasCategories));

		return view('admin.blogs.view', ['blog' => $blog, 'blogCategories' => $blogCategories, 'blogHasCategories' => $blogHasCategories]);
	}

	public function edit($id)
	{
		$blog = Blog::find($id);

		if(!$blog)
		{
			return redirect()->route('admin.blogs.index');
		}

		$blogCategories = BlogCategory::get();
		$blogHasCategories = BlogHasCategory::where('blog_id', $blog->id)->pluck('blog_category_id');
		$blogHasCategories = json_decode(json_encode($blogHasCategories));

		return view('admin.blogs.edit', ['blog' => $blog, 'blogCategories' => $blogCategories, 'blogHasCategories' => $blogHasCategories]);
	}

	public function update(Request $request, $id)
	{
		$inputs = [
					'title'		  => $request->title,
					'description' => $request->description,
					'status'	  => $request->status,
				];

		$rules  = [
					'title' 	  => 'required|max:255',
					'description' => 'required',
					'status'	  => 'required',

				];

		if($request->image)
		{
			$inputs['image'] = $request->image;

			$rules['image'] = 'image|dimensions:min_width=500, min_height=250|mimes:jpeg,png,jpg';

			$return['image.required'] = 'Image should in minimum 500x250.';		

			$validator = Validator::make($inputs, $rules, $return);

		}

		$validator = Validator::make($inputs, $rules);

		if($validator->fails())
		{
			return redirect()->back()->withErrors($validator)->withInput()->with( [ 'error' , 'title' => $request->title, 'description' => $request->description, 'image' => $request->image ] );
		}	

		$blog = Blog::find($id);

		if(!$blog)
		{
			return redirect()->route('admin.blogs.index')->with('error', 'Blog not found');
		}

		$image = $blog->image;

		if(!empty($_FILES['image']['name']))
		{
			$path_info = pathinfo($_FILES['image']['name']);
            $ext = $path_info['extension'];
            $ext = strtolower($ext);
            $old_image = $blog->image;

            if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png')
            {
            	$file_name = time();
            	$new_name = $file_name . '.' . $ext;
            	$destination = base_path() . '/' . BaseUrl::getBlogImageUrl() . '/';

            	if(move_uploaded_file($_FILES['image']['tmp_name'], $destination.$new_name))
            	{
            		if(!empty($old_image))
            		{
            			if(file_exists($destination.$old_image))
            			{
            				unlink($destination.$old_image);
            				unlink($destination . '/thumbnails/recent_posts/' . $old_image);
            				unlink($destination . '/thumbnails/blog_listing/' . $old_image);
            			}
            		}
            		$image = $new_name;
            	}

            	//resize image for recent posts thumbnails
				$recent_posts_thumbnail = Image::make($destination . $image)->resize(null, 65, function ($constraint) {
					    $constraint->aspectRatio();
					});
				$recent_posts_thumbnail->save(base_path() . '/' . BaseUrl::getRecentPostsThumbnailUrl() . '/' . $image);

	            //resize image for blogs listing thumbnails
				$blogs_listing_thumbnails = Image::make($destination . $image)->resize(null, 165, function ($constraint) {
					    $constraint->aspectRatio();
					});

				$blogs_listing_thumbnails->save(base_path() . '/' . BaseUrl::getBlogListingThumbnailUrl() . '/' . $image);
            }
		}

		$blog->title = $request->title;
		$blog->description = $request->description;
		$blog->status = $request->status;
		$blog->image = $image;
		
		if($blog->save())
		{
			if( $request->categories )
			{
					
				$blogHasCategories = BlogHasCategory::where('blog_id', $blog->id)->delete();
			
				foreach ($request->categories as $value) 
				{

					$blogHasCategory = new BlogHasCategory;
					$blogHasCategory->blog_category_id = $value;
					$blogHasCategory->blog_id = $blog->id;
					$blogHasCategory->save();
				}
			}
			return redirect()->route('admin.blogs.index')->with('success', 'Blog has been Edited Successfully');
		}

	}

	public function destroy($id = null)
	{
		$blog = Blog::find($id);

		if(!$blog)
		{
			return redirect()->back()->with('error', 'Blog not found.');
		}

		$blogHasCategories = BlogHasCategory::where('blog_id', $blog->id)->delete();

		$destination = base_path() . '/' . BaseUrl::getBlogImageUrl() . '/';

		if( !empty($blog->image) )
		{
			if(file_exists($destination.$blog->image))
			{
				unlink($destination . $blog->image);
			}

			if(file_exists($destination . 'thumbnails/recent_posts/' . $blog->image))
			{
				unlink($destination . 'thumbnails/recent_posts/' . $blog->image);
			}

			if(file_exists($destination . 'thumbnails/blog_listing/' . $blog->image))
			{
				unlink($destination . 'thumbnails/blog_listing/' . $blog->image);
			}
		}
		
		if($blog->forceDelete())
		{

			return redirect()->route('admin.blogs.index')->with('success', 'Blog Deleted Successfully');
		}
		else
		{
    		return redirect()->route('admin.blogs.index')->with('error', 'Some error occurred, please try again later.');    		
    	}
	}

	public function archived()
	{
		$blogs = Blog::onlyTrashed()->get();
		
		return view('admin.blogs.archived', ['blogs'=>$blogs]);
	}

	public function moveToArchived($id = null)
	{
		Blog::find($id)->delete();

		return redirect()->route('admin.blogs.index')->with('success', 'Data Archive successfully');

	}

	public function restore($id = null)
	{
		Blog::withTrashed()->where('id', $id)->restore();

		return redirect()->route('admin.blogs.archived')->with('success', 'Data restored successfully');
	}



}
