<div class="fh5co-narrow-content text-center">
    <legend>{{ auth()->user()->name }}さんのマイページ</legend>
    <div class="mypage_wrapper">
        <div class="row">
            <div class="col-md-5 text-center">
                @if(auth()->user()->img_name)
                    <img src="{{ asset("storage/user_images").'/'.auth()->user()->img_name }}" alt="Blog" style="width:140px;height:140px;border-radius: 50%;"><br>
                @else
                    <img src="{{ asset("img/profile_img_default.png") }}" alt="Blog" style="width:140px;height:140px;border-radius: 50%;"><br>
                @endif
            </div>
            <div class="col-md-7">
                <div>
                    ＜好きな本のジャンル＞
                </div>
                <div>
                    ＜自己紹介＆メッセージ＞
                    <p></p>
                </div>
            </div>
        </div>
        <a href="{{ url('/profile/create') }}"><button type="button" class="btn btn-success">プロフィール編集</button></a>
    </div>

    <legend>おすすめ書籍を投稿する</legend>
        <div class="feed_wrapper">
            <form method="post" class="form-horizontal" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-4" style="padding-left: 100px;">
                        <img id="img1" src="https://placehold.jp/300x200.png" style="width:300px;height:200px;"><br>
                        <label>
                        <span class="filelabel" title="ファイルを選択">
                            選択
                        </span>
                        <input type="file" class="filesend" id="filesend" name="img_name" accept="image/*" style="display: none;">
                        </label><br>
                    </div>
                    <div class="col-md-8 text-left">

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="input-title">本のタイトル</label>
                            <div class="col-md-6">
                                <input id="input-title" name="title" type="text" placeholder="本のタイトル" value="" class="form-control input-md">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="input-category-id">本のジャンル</label>
                            <div class="col-md-6">
                                <select id="input-category-id" name="category_id" class="form-control">
                                    <option value="">選択してください</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="input-comment">おすすめの理由</label>
                            <div class="col-md-8">
                                <textarea class="form-control" id="input-comment" name="comment" placeholder="おすすめの理由" style="height: 200px;"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">投稿</button>
            </form>
        </div>
  </div>
