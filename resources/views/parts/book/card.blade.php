<div class="row row-bottom-padded-md">
    @foreach ($books as $book)
        <div class="col-md-3 col-sm-6 col-padding animate-box" data-animate-effect="fadeInLeft">
            <div class="blog-entry">
                <a href="#" data-toggle="modal" data-target="#demoNormalModal{{ $book->id }}"><img src="{{ asset("storage/book_images/{$book->img_name}") }}" class="img-responsive" width="100%" style="height: 180px;" alt="Free HTML5 Bootstrap Template by FreeHTML5.co"></a>
                <div class="desc">
                    <h3 class="overflow">{{ $book->title }}</h3>
                    <span><small></small>{{ $book->created_at }}</span>

                    @if($feed)
                        <span hidden class="feed_id" style="display: none;">{{ $book->id}}</span>
                        <span hidden id="signin_user" style="display: none;">{{ auth()->user()->id }}</span>
                        @if($book->liked())
                            <button class="btn unlike"><i style="color: red;" class="fas fa-heart"></i></button>
                        @else
                            <button class="btn like"><i class="far fa-heart"></i></button>
                        @endif
                        <span class="like_count" style="display: inline-block; margin-right: 3px;">{{ $book->likedbook->count() }}</span>
                        <span style="display: inline-block;">いいね</span><br>
                    @else
                        @if($book->likedbook->isEmpty())
                            <span style="display: inline-block;"><i class="fas fa-heart"></i></span>
                        @else
                            <span style="display: inline-block;"><i style="color: red;" class="fas fa-heart"></i></span>
                        @endif
                        <span class="like_count" style="display: inline-block; margin-left: 3px;">{{ $book->likedbook->count() }}</span>
                        <span style="display: inline-block;">いいね</span><br>
                    @endif

                    <a href="#" data-toggle="modal" data-target="#demoNormalModal{{ $book->id }}" class="lead">Read More <i class="icon-arrow-right3"></i></a><br>
                    @if($editable)
                        <div class="text-center" style="margin-top: 8px;">
                            <form method="post" action="{{ url("/book/{$book->id}")}}" style="display: inline;">
                                @csrf {{ method_field('delete')}}
                                <button type="submit" class="btn btn-danger" onclick="return confirm('この投稿を削除しますか？')">削除</button>
                            </form>
                            <a href="{{ url("/book/{$book->id}") }}"><button type="button" class="btn btn-success">編集</button></a>
                        </div>
                    @endif

                    @if($removableFromBookshelf)
                        <div class="text-center" style="margin-top: 8px;">
                            <form method="post" action="{{ url("/book/{$book->id}")}}" style="display: inline;">
                                @csrf {{ method_field('delete')}}
                                <button type="submit" class="btn btn-danger" onclick="return confirm('この本棚を削除しますか？')">削除</button>
                            </form>
                        </div>
                    @endif

                    @if($feed)
                        <div class="text-center" style="margin-top: 8px;">
                            @if($book->user->img_name)
                                <img src="{{ asset("storage/user_images/{$book->user->img_name}") }}" class="img-circle" width="20" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
                            @else
                                <img src="{{ asset('img/profile_img_default.png') }}" class="img-circle" width="20" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
                            @endif

                            @if($book->user->profile->nickname)
                                <span style="display: inline-block;">{{ $book->user->profile->nickname}}さんの投稿</span>
                            @else
                                <span style="display: inline-block;">{{ $book->user->name }}さんの投稿</span>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>


        <!-- モーダルダイアログ -->
        <div class="modal fade" id="demoNormalModal{{ $book->id }}" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h3 class="modal-title" id="demoModalTitle">{{ $book->title }}</h3>
                        <p>{{ $book->category->name }}</p>
                    </div>
                    <div class="modal-body text-center">
                        <img src="{{ asset("storage/book_images/{$book->img_name}") }}" class="img-responsive" width="100%" height="100%" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
                        <p class="nomal" style="font-size: 15px;">{{ $book->comment }}</p>
                    </div>
                    <div class="modal-body text-center">
                        @if($add)
                            <form method="post" action="{{ url("/book/{$book->id}") }}">
                                @csrf
                                <select name="bookshelf" class="form-control">
                                    <option disabled selected value>選択してください</option>
                                    @foreach ($bookshelves as $bookshelf)
                                        <option value="{{ $bookshelf->id }}">{{ $bookshelf->title }}</option>
                                    @endforeach
                                </select>
                                <button type='submit' class='btn btn-success mt-3'>この本を本棚に追加する</button>
                            </form>
                        @endif
                    </div>
                    <div class="modal-footer text-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@if($paginate)
    <div class='text-center'>
        {{ $books->appends(['keyword' => $keyword])->links() }}
    </div>
@endif
@section('script_bottom')
    <script src="{{ asset('/js/my.js') }}"></script>
@endsection
