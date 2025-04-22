@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/delete.css') }}">

<div class="delete-confirm-wrapper">
    <div class="delete-confirm-box">
        <h2>本当に削除しますか？</h2>
        <p class="product-info">{{ $product->name }}（{{ $product->price }}円）</p>

        <div class="button-group">
            <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-button">🗑️ 削除する</button>
            </form>

            <a href="{{ route('products.show', $product->id) }}" class="cancel-button">キャンセル</a>
        </div>
    </div>
</div>
@endsection