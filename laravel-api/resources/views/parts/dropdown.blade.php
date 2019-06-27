<div id="fh5co-main-menu" class="btn-group" role="navigation">
    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Menu
    </button>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="{{ url('/book/create') }}">本を投稿する</a>
        <a class="dropdown-item" href="{{ url('/bookshelf/create') }}">本棚を作成する</a>
        <a class="dropdown-item" href="{{ url('/book/favorite') }}">いいねした本</a>
    </div>
</div>
