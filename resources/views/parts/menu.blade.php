<aside id="fh5co-aside" role="complementary" class="border js-fullheight">

    <h1 id="fh5co-logo"><a href="{{ url('/home') }}">BookLikes</a></h1>
    <nav id="fh5co-main-menu" role="navigation">
        @if(auth()->user())
            <ul>
                <li class="fh5co-active"><a href="{{ url('/home') }}">マイページ</a></li>
                <li><a href="my_books.php">自分の投稿</a></li>
                <li><a href="feeds.php">すべての投稿一覧</a></li>
            </ul>
        @else
            <ul>
                <li class="fh5co-active"><a href="index.php">Home</a></li>
                <li><a href="{{ url('/books') }}">Books</a></li>
                <li><a href="{{ url('/login') }}">サインイン</a></li>
                <li><a href="{{ url('/signup') }}">新規会員登録</a></li>
            </ul>
        @endif
    </nav>

    <div class="fh5co-footer">
        @if(auth()->user())
            <a href="{{ url('/logout') }}"><button type="button" class="btn btn-danger">ログアウト</button></a>
        @endif
        <p><small>&copy; 2016 Blend Free HTML5. All Rights Reserved.</span> <span>Designed by <a href="http://freehtml5.co/" target="_blank">FreeHTML5.co</a> </span> <span>Demo Images: <a href="https://unsplash.com/" target="_blank">Unsplash</a></span></small></p>
    </div>

</aside>



