@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/products.css')}}">
@endsection

@section('content')
<div class="container">
    <h2>検索結果</h2>

    <form class="search-form" action="{{ route('products.search') }}" method="GET">
        <input type="text" name="keyword" placeholder="商品名で検索" value="{{ request('keyword') }}">
        <button type="submit">検索</button>
    </form>

    <form class="sort-form" action="{{ route('products.search') }}" method="GET">
        <input type="hidden" name="keyword" value="{{ request('keyword') }}">
        <select name="sort" onchange="this.form.submit()">
            <option value="">価格で並べ替え</option>
            <option value="high" {{ request('sort') === 'high' ? 'selected' : '' }}>高い順</option>
            <option value="low" {{ request('sort') === 'low' ? 'selected' : '' }}>安い順</option>
        </select>
    </form>

    @if(request('sort'))
        <div class="sort-tag">
            並び順: {{ request('sort') === 'high' ? '価格が高い順' : '価格が安い順' }}
            <a href="{{ route('products.search', ['keyword' => request('keyword')]) }}">✖️</a>
        </div>
    @endif

    <div class="product-grid">
        @foreach($products as $product)
        <div class="product-card" onclick="location.href='{{ route('products.show', $product->id) }}'">
            <img src="{{ asset('storage/images/' . $product->image) }}" alt="{{ $product->name }}">
            <div class="product-info">
                <p class="product-name">{{ $product->name }}</p>
                <p class="product-price">¥{{ number_format($product->price) }}</p>
            </div>
        </div>
        @endforeach
    </div>

    <div class="pagination-wrapper">
        {{ $products->links('vendor.pagination.default') }}
    </div>
</div>
@endsection