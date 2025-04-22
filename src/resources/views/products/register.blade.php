@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">

<div class="form-container">
    <h2>商品登録</h2>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>商品名 <span class="required">必須</span></label>
            <input type="text" name="name" placeholder="商品名を入力" value="{{ old('name') }}">
            @error('name')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label>値段 <span class="required">必須</span></label>
            <input type="text" name="price" placeholder="値段を入力" value="{{ old('price') }}">
            @error('price')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label>商品画像 <span class="required">必須</span></label>
            <input type="file" name="image" id="image-input" accept="image/png, image/jpeg">
            <div id="image-preview-wrapper">
                <img id="image-preview" src="#" alt="画像プレビュー" style="display:none; max-width: 200px; margin-top: 10px;"/>
            </div>
            @error('image')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label>季節 <span class="required">必須</span> <span class="note">※複数選択可</span></label><br>
            @foreach (['春', '夏', '秋', '冬'] as $season)
                <label><input type="checkbox" name="season[]" value="{{ $season }}" {{ is_array(old('season')) && in_array($season, old('season')) ? 'checked' : '' }}> {{ $season }}</label>
            @endforeach
            @error('season')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label>商品説明 <span class="required">必須</span></label>
            <textarea name="description" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
            @error('description')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-actions">
            <button type="button" onclick="history.back()">戻る</button>
            <button type="submit">登録</button>
        </div>
    </form>
</div>

<script>
    document.getElementById('image-input').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('image-preview');

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }

            reader.readAsDataURL(file);
        }

        else {
            preview.src = '#';
            preview.style.display = 'none';
        }
    });
</script>
@endsection