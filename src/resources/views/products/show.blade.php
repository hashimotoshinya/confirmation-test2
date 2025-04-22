@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/show.css') }}">

<div class="product-detail-container">

    <div class="product-detail-card">
        <img src="{{ asset('storage/images/' . $product->image) }}" alt="{{ $product->name }}" class="product-detail-image">

        <div class="product-detail-info">

            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <label>商品名</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" required>
                @error('name')
                    <p class="error">{{ $message }}</p>
                @enderror

                <label>価格（円）</label>
                <input type="number" name="price" value="{{ old('price', $product->price) }}" required>
                @error('price')
                    <p class="error">{{ $message }}</p>
                @enderror

                <label>季節</label>
                <div class="season-checkboxes">
                    @foreach (['春', '夏', '秋', '冬'] as $season)
                        <label>
                            <input type="checkbox" name="season[]" value="{{ $season }}"
                                {{ in_array($season, old('season', $selectedSeasons)) ? 'checked' : '' }}>
                            {{ $season }}
                        </label>
                    @endforeach
                </div>
                @error('season')
                    <p class="error">{{ $message }}</p>
                @enderror

                <label>商品説明</label>
                <textarea name="description">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <p class="error">{{ $message }}</p>
                @enderror

                <label>画像変更</label>
                <input type="file" name="image">
                @error('image')
                    <p class="error">{{ $message }}</p>
                @enderror

                <div class="button-group">
                    <a href="{{ route('products.index') }}" class="back-button">← 一覧に戻る</a>
                    <a href="{{ route('products.edit', $product->id) }}" class="edit-button">変更を保存</a>
                </div>
            </form>

            <a href="{{ route('products.confirmDelete', $product->id) }}" class="delete-button">🗑️</a>

        </div>
    </div>

</div>
@endsection