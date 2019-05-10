<div class="row row-bottom-padded-md">
    @foreach($bookshelves as $bookshelf)
    <div class="col-md-3 col-sm-6 col-padding animate-box" data-animate-effect="fadeInLeft">
        <div class="blog-entry">
                <a class="stretched-link" href="{{ url("/bookshelf/$bookshelf->id") }}"></a>
                <div class="desc">
                    <h3 class="overflow">{{ $bookshelf->title }}</h3>
                    <span><small>{{ $bookshelf->created_at }}</small></span>
                    @foreach ($bookshelf->categories as $category )
                        <small>{{ $category->name }}</small>
                    @endforeach
                    <br><a class="lead">Enter This Bookshelf <i class="icon-arrow-right3"></i></a>
                    <div class="text-center" style="margin-top: 8px;">
                        <form method="post" action="{{ url("/bookshelf/{$bookshelf->id}")}}" style="display: inline;">
                            @csrf {{ method_field('delete')}}
                            <button type="submit" class="btn btn-danger stretched-link" style="position: relative;" onclick="return confirm('この本棚を削除しますか？')">削除</button>
                        </form>
                        <a href="#" data-toggle="modal" data-target="#demoNormalModal{{ $bookshelf->id }}" class="stretched-link" style="position: relative;"><button type="button" class="btn btn-success">編集</button></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- モーダルダイアログ -->
        <div class="modal" id="demoNormalModal{{ $bookshelf->id }}" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h3 class="modal-title" id="demoModalTitle">本棚編集(タイトルのみ編集可)</h3>
                    </div>
                    <div class="modal-body text-center">
                        <form method="post" action="{{  url("/bookshelf/{$bookshelf->id}") }}">
                            @csrf {{ method_field('patch') }}
                            <div class="form-group">
                                <input id="input-title" name="title" type="text" placeholder="本棚のタイトル" value="{{ old('title') ?? $bookshelf->title }}" class="form-control input-md {{ $errors->has('title') ? 'is-invalid' : '' }}">
                                <button type="submit" class="btn btn-success mt-3">編集する</button>
                                <ul class="invalid-feedback" style="list-style-type: none">
                                    @foreach($errors->get('title') as $message)
                                        <li>{{ $message }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer text-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class='text-center'>
    {{ $bookshelves->links() }}
</div>

