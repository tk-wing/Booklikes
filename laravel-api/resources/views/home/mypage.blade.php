<div class="fh5co-narrow-content text-center">
    @if($profile->nickname)
        <legend>{{ $profile->nickname }}さんのマイページ</legend>
    @else
        <legend>{{ $user->name }}さんのマイページ</legend>
    @endif
    <div class="mypage_wrapper">
        <div class="row">
            <div class="col-md-5 text-center">
                @if($user->img_name)
                    <img src="{{ asset("storage/user_images").'/'.auth()->user()->img_name }}" alt="Blog" style="width:140px;height:140px;border-radius: 50%;"><br>
                @else
                    <img src="{{ asset("img/profile_img_default.png") }}" alt="Blog" style="width:140px;height:140px;border-radius: 50%;"><br>
                @endif
            </div>
            <div class="col-md-7">
                @if($profile->categories->isNotEmpty())
                    <div>
                        ＜好きな本のジャンル＞<br>
                        @foreach($profile->categories as $category)
                            {{ $category->name }}
                        @endforeach
                    </div>
                @endif
                @if($profile->comment)
                    <div>
                        ＜自己紹介＆メッセージ＞
                        <p>{{ $profile->comment }}</p>
                    </div>
                @endif
            </div>
        </div>
        <a href="{{ url('/profile/create') }}"><button type="button" class="btn btn-success">プロフィール編集</button></a>
    </div>

    <legend>最近の投稿</legend>
        <div class="feed_wrapper">
            @include('parts.book.card', [
                'feed' => false,
                'editable' => false,
                'removableFromBookshelf' => false,
                'add' => false,
                'paginate' => false,
            ])
        </div>
  </div>
