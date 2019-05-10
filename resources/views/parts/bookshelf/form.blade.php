<div class="form-group">
    <label class="col-md-4 control-label" for="input-title">本棚のタイトル</label>
    <div class="col-md-4">
        <input id="input-title" name="title" type="text" placeholder="本棚のタイトル" value="{{ old('title') ?? $title}}" class="form-control input-md {{ $errors->has('title') ? 'is-invalid' : '' }}">
        <ul class="invalid-feedback" style="list-style-type: none">
            @foreach($errors->get('title') as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label" for="input-categories">本棚のジャンル</label>
    <div class="col-md-4">
        <select id="input-categories" name="categories[]" class="form-control {{ $errors->has('categories') ? 'is-invalid' : '' }}">
            <option disabled selected value>選択してください</option>
            @foreach ($categories as $category)
                @if((int) (old('categories') ?? $categoryId) === $category->id)
                    <option selected value="{{ $category->id }}">{{ $category->name }}</option>
                @else
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endif
            @endforeach
        </select>
        <ul class="invalid-feedback" style="list-style-type: none">
            @foreach($errors->get('categories') as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
</div>

<button type="submit" class="btn btn-success">作成</button>
