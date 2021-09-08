@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row mb-2 mb-xl-3 pt-4">
            <div>
                <h1 class="h3 mb-3">Modify products</h1>
            </div>
            <div class="col-auto ml-auto text-right mt-n1">

                <!-- Button trigger modal for product create -->
                <button type="button" name="btn-create-new-product" class="btn-primary-custom" data-toggle="modal"
                    data-target="#createProduct">
                    Add Product
                </button>

                <!-- Create product modal -->
                <div class="modal fade" id="createProduct" tabindex="-1" aria-labelledby="createProductLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add new product</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('admin.product.store') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="col-form-label col-sm-2 text-sm-right text-left">Title</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="title" class="form-control"
                                                        placeholder="Title" value="{{ old('title') }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label
                                                    class="col-form-label col-sm-2 text-sm-right text-left">Description</label>
                                                <div class="col-sm-10">
                                                    <textarea type="text" name="description" class="form-control"
                                                        placeholder="Description">{{ old('description') }}</textarea>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-form-label col-sm-2 text-sm-right text-left">Slug</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="slug" class="form-control"
                                                        placeholder="Slug (leave empty to auto-generate)"
                                                        value="{{ old('slug') }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label
                                                    class="col-form-label col-sm-2 text-sm-right text-left">Quantity</label>
                                                <div class="col-sm-10">
                                                    <input type="number" min="0" step="1" name="quantity"
                                                        class="form-control" placeholder="Quantity"
                                                        value="{{ old('quantity') }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-form-label col-sm-2 text-sm-right text-left">Price</label>
                                                <div class="col-sm-10">
                                                    <input type="number" min="0.01" step="0.01" name="price"
                                                        class="form-control" placeholder="Price"
                                                        value="{{ old('price') }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label
                                                    class="col-form-label col-sm-2 text-sm-right text-left">Featured</label>
                                                <div class="col-sm-10">
                                                    <div class="custom-file">
                                                        <input type="file" name="featured" class="custom-file-input"
                                                            id="featured">
                                                        <label class="custom-file-label text-left" for="featured">Choose
                                                            file</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" name="btn-create-new-product" class="btn-primary-custom">Store
                                            product</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        @include('partials.errors')
    </div>

    <div class="container table-container">
        <table class="table table-hover tables-custom">
            <thead>
                <tr>
                    <th class="lead">Image</th>
                    <th class="lead">Author</th>
                    <th class="lead">Title</th>
                    <th class="lead">Created</th>
                    <th class="lead">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr style="height: 80px">
                        <td>
                            <img src="{{ $product->featured }}" alt="Featured image" style="width: 150px; height: 80px;">
                        </td>
                        <td class="lead">{{ $product->user->name }}</td>
                        <td class="lead">{{ $product->title }}</td>
                        <td class="lead">{{ $product->created_at->toFormattedDateString() }}</td>
                        <td class="table-action d-flex align-items-center">
                            <!-- Button trigger modal for product create -->
                            <a href="#" class="mr-2"><i class="fas fa-pen" data-toggle="modal"
                                    data-target="#updateProduct{{ $product->id }}"></i></a>

                            <form action="{{ route('admin.product.trash', $product) }}" method="post">
                                @csrf

                                <button type="submit" class="btn btn-link mr-2"><i class="fas fa-trash"></i></button>
                            </form>

                            <!-- Create product modal -->
                            <div class="modal fade" id="updateProduct{{ $product->id }}" tabindex="-1"
                                aria-labelledby="updateProduct{{ $product->id }}Label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Update product</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('admin.product.update', $product->slug) }}"
                                                method="post" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')

                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="form-group row">
                                                            <label
                                                                class="col-form-label col-sm-2 text-sm-right text-left">Title</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="title" class="form-control"
                                                                    placeholder="Title" value="{{ $product->title }}">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label
                                                                class="col-form-label col-sm-2 text-sm-right text-left">Description</label>
                                                            <div class="col-sm-10">
                                                                <textarea type="text" name="description"
                                                                    class="form-control"
                                                                    placeholder="Description">{{ $product->description }}</textarea>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label
                                                                class="col-form-label col-sm-2 text-sm-right text-left">Slug</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="slug" class="form-control"
                                                                    placeholder="Slug (leave empty to auto-generate)"
                                                                    value="{{ $product->slug }}">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label
                                                                class="col-form-label col-sm-2 text-sm-right text-left">Quantity</label>
                                                            <div class="col-sm-10">
                                                                <input type="number" min="0" step="1" name="quantity"
                                                                    class="form-control" placeholder="Quantity"
                                                                    value="{{ $product->quantity }}">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label
                                                                class="col-form-label col-sm-2 text-sm-right text-left">Price</label>
                                                            <div class="col-sm-10">
                                                                <input type="number" min="0.01" step="0.01" name="price"
                                                                    class="form-control" placeholder="Price"
                                                                    value="{{ $product->price }}">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label
                                                                class="col-form-label col-sm-2 text-sm-right text-left">Featured</label>
                                                            <div class="col-sm-10">
                                                                <div class="custom-file">
                                                                    <input type="file" name="featured"
                                                                        class="custom-file-input" id="featured">
                                                                    <label class="custom-file-label text-left"
                                                                        for="featured">Choose
                                                                        file</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="submit" name="btn-create-new-product"
                                                        class="btn-primary-custom">Update product</button>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
    <div class="my-5 d-flex justify-content-center">
        {{ $products->links() }}
    </div>



@endsection
