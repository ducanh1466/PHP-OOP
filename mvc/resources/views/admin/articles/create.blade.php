@extends('admin.dashboard')

@section('title')
 Thêm bài viết 

@endsection

@section('content')
    <form action="" method="post" enctype="multipart/form-data">
        <div class="control">
            <label for="">Title</label>
            <input type="text" name="title" value="{{ $posts['title'] ?? '' }}">
            <span style="color: red">{{  $error['title'] ?? '' }}</span>
        </div>

        <div class="control">
            <label for="">Image</label>
            <input type="file" name="image">
            <span style="color: red">{{  $error['image'] ?? '' }}</span>
        </div>

        <div class="control"> 
            <label for="">Category</label>
            <select name="category_id" id="">
                @foreach ($categories as $cate)
                    {{ $cate_id = $posts['category_id'] ?? ''  }}
                <option 
                    value="{{ $cate->id }}" 
                    @selected($cate_id == $cate->id)>
                    {{ $cate->name }} 
                </option>
                @endforeach
            </select>
        </div>

        <div class="control">
            <label for="">Description</label>
            <textarea name="description" id="" cols="30" rows="10">{{ $posts['description'] ?? '' }}</textarea>
        </div>

        <div class="control">
            <label for="">Content</label>
            <textarea name="content" id="" cols="30" rows="10">{{ $posts['content'] ?? '' }}</textarea>
        </div>

        <div class="control">
            <button type="submit">Create new</button>

    </form>

@endsection