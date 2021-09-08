@extends('layouts.app')

@section('content')

    <div class="container pt-4">
        <div class="row mb-2 mb-xl-3">
            <div class="col-auto d-sm-block">
                <h1 class="h3 mb-3">Trashed Products</h1>
            </div>
        </div>
    </div>

    <div class="container table-container">
        <table class="table tables-custom">
            <thead>
                <tr>
                    <th class="lead">Image</th>
                    <th class="lead">Title</th>
                    <th class="lead">Created</th>
                    <th class="lead">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr>
                        <td>
                            <img src="{{ $product->featured }}" alt="Featured image" style="width: 150px; height: 80px;">
                        </td>
                        <td class="lead">{{ $product->title }}</td>
                        <td class="lead">{{ $product->created_at->toFormattedDateString() }}</td>
                        <td class="table-action d-flex align-items-center">
                            <form action="{{ route('admin.product.restore', $product->slug) }}" method="post">
                                @csrf

                                <button type="submit" class="btn btn-link mr-2"><i class="fas fa-recycle"></i></button>
                            </form>
                            <form action="{{ route('admin.product.destroy', $product->slug) }}" method="post">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-link mr-2"><i class="fas fa-ban"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>There are no products!</td>
                    </tr>
                @endforelse

            </tbody>
        </table>

    </div>

    <div class="my-4 d-flex justify-content-center">
        {{ $products->links() }}
    </div>

    @include('partials.errors')

@endsection
