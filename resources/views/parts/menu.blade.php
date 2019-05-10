<aside id="fh5co-aside" role="complementary" class="border js-fullheight">

    <h1 id="fh5co-logo"><a href="{{ url('/home') }}">BookLikes</a></h1>

    <nav id="fh5co-main-menu" role="navigation">
        @if(auth()->user())
            <ul>
                <li class="{{ preg_match('/^\/home/', $current) ? 'fh5co-active' : '' }}"><a href="{{ url('/home') }}">マイページ</a></li>
                <li class="{{ preg_match('/^\/book$/', $current) ? 'fh5co-active' : '' }}"><a href="{{ url('/book') }}">自分の投稿</a></li>
                <li class="{{ preg_match('/^\/bookhsekf/', $current) ? 'fh5co-active' : '' }}"><a href="{{ url('/bookshelf') }}">本棚</a></li>
                <li class="{{ preg_match('/^\/feed/', $current) ? 'fh5co-active' : '' }}"><a href="{{ url('/feed') }}">すべての投稿一覧</a></li>
            </ul>
        @else
            <ul>
                <li class="{{ preg_match('/^\/home$/', $current) ? 'fh5co-active' : '' }}"><a href="{{ url('/home') }}">Home</a></li>
                <li class="{{ preg_match('/^\/home\/book/', $current) ? 'fh5co-active' : '' }}"><a href="{{ url('/home/book') }}">Books</a></li>
                <li class="{{ preg_match('/^\/login/', $current) ? 'fh5co-active' : '' }}"><a href="{{ url('/login') }}">サインイン</a></li>
                <li class="{{ preg_match('/^\/signup/', $current) ? 'fh5co-active' : '' }}"><a href="{{ url('/signup') }}">新規会員登録</a></li>
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



