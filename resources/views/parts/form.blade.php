<div class="row">
    <div class="col-md-4" style="padding-left: 100px;">
        @if($update)
            <img id="img1" src="{{ asset("storage/book_images/{$img_name}")}}" style="width:300px;height:200px;"><br>
        @else
            <img id="img1" src="https://placehold.jp/300x200.png" style="width:300px;height:200px;"><br>
        @endif
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
                <input id="input-title" name="title" type="text" placeholder="本のタイトル" value="{{ old('title') ?? $title}}" class="form-control input-md {{ $errors->has('title') ? 'is-invalid' : '' }}">
                <ul class="invalid-feedback" style="list-style-type: none">
                    @foreach($errors->get('title') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label" for="input-category">本のジャンル</label>
            <div class="col-md-6">
                <select id="input-category" name="category" class="form-control {{ $errors->has('category') ? 'is-invalid' : '' }}">
                    <option disabled selected value>選択してください</option>
                    @foreach ($categories as $category)
                        @if((int) (old('category') ?? $categoryId) === $category->id)
                            <option selected value="{{ $category->id }}">{{ $category->name }}</option>
                        @else
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endif
                    @endforeach
                </select>
                <ul class="invalid-feedback" style="list-style-type: none">
                    @foreach($errors->get('category') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label" for="input-comment">おすすめの理由</label>
            <div class="col-md-8">
                <textarea class="form-control {{ $errors->has('comment') ? 'is-invalid' : '' }}" id="input-comment" name="comment" placeholder="おすすめの理由" style="height: 200px;">{{ old('comment') ?? $comment}}</textarea>
                <ul class="invalid-feedback" style="list-style-type: none">
                    @foreach($errors->get('comment') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
<button type="submit" class="btn btn-success">投稿</button>
