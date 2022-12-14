@extends('layouts.sidebar')

@section('content')
<div class="board_area w-100 border m-auto d-flex">
  <div class="post_view w-75 mt-5">
    <p class="w-75 m-auto">投稿一覧</p>
    @foreach($posts as $post)
    <div class="post_area border w-75 m-auto p-3">
      <p><span>{{ $post->user->over_name }}</span><span class="ml-3">{{ $post->user->under_name }}</span>さん</p>
      <p><a href="{{ route('post.detail', ['id' => $post->id]) }}">{{ $post->post_title }}</a></p>
      <div class="post_bottom_area d-flex">
        @foreach($post->subCategories as $sub_category)
        <p class="category_btn">{{$sub_category->sub_category}}</p>
        @endforeach
        <div class="d-flex post_status">
          <div class="mr-5">
            <i class="fa fa-comment"></i><span class="">{{count($post->postComments)}}</span>
          </div>
          <div>
            @if(Auth::user()->is_Like($post->id))
            <p class="m-0"><i class="fas fa-heart un_like_btn" post_id="{{ $post->id }}"></i><span class="like_counts{{ $post->id }}">{{$like->likeCounts($post->id)}}</span></p>
            @else
            <p class="m-0"><i class="fas fa-heart like_btn" post_id="{{ $post->id }}"></i><span class="like_counts{{ $post->id }}">{{$like->likeCounts($post->id)}}</span></p>
            @endif
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <div class="other_area border w-25">
    <div class="border m-4">
      <div class="mb-4">
        <a  class="btn btn-primary w-100" href="{{ route('post.input') }}">投稿</a>
      </div>
      <div class="w-100 mb-3 search_btn">
        <span>検索</span>
        <input class="rounded-pill w-100 bg-light" type="text" placeholder="キーワードを検索" name="keyword" form="postSearchRequest">
        <button class="rounded-pill w-25 bg-primary text-white" type="submit" form="postSearchRequest"><i class="fas fa-search"></i></button>
      </div>
      <input type="submit" name="like_posts" class="category_btn like mb-4" value="いいねした投稿" form="likeSearchRequest">
      <input type="submit" name="my_posts" class="category_btn like" value="自分の投稿" form="mySearchRequest">
      <ul>
        <span>カテゴリー</span>
        <div id="accordion">
          @foreach($categories as $category)
          <div id="accordionWrap">
            <div id="accordionItem" class="bg-primary border rounded text-white">
              <li class="main_categories" category_id="{{ $category->id }}"><span class="ml-2 text-black">{{ $category->main_category }}<span>
              </li>
            </div>
            <div class="mb-2" id="accordionContent">
               @foreach($category->subCategories as $sub_category)
              <input type="submit" name="category_word" class="btn btn-link d-block" value="{{$sub_category->sub_category}}" form="postSearchRequest">
              @endforeach
            </div>
          </div>
          @endforeach
        </div>
      </ul>
    </div>
  </div>
  <form action="{{ route('post.show') }}" method="get" id="postSearchRequest"></form>
  <form action="{{ route('like.bulletin.board') }}" method="get" id="likeSearchRequest"></form>
  <form action="{{ route('my.bulletin.board') }}" method="get" id="mySearchRequest"></form>
</div>
@endsection
