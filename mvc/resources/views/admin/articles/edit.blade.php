@extends('admin.dashboard')

@section('title')
 Sửa bài viết 

@endsection

@section('content')
    <form action="" method="post" enctype="multipart/form-data">
        <div class="control">
            <label for="">Title</label>
            <input type="text" name="title" value="{{ $post->title }}" id="">
        </div>

        <div class="control">
            <label for="">Image</label>
            <input type="file" name="image" id=""> <br>
            <img src="{{ BASE_URL . $post->image }}" alt="" width="100">

        </div>

        <div class="control"> 
            <label for="">Category</label>
            <select name="category_id" id="">
                @foreach ($categories as $cate)
                    <option value="{{ $cate->id }}"
                        @selected($cate->id == $post->category_id)
                    >{{ $cate->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="control">
            <label for="">Description</label>
            <textarea name="description" id="" cols="30" rows="10">{{ $post->description }}</textarea>
        </div>

        <div class="control">
            <label for="">Content</label>
            <textarea name="content" id="" cols="30" rows="10">{{ $post->content }}</textarea>
        </div>

        <div class="control">
            <button type="submit">Update</button>

    </form>

@endsection