@extends('admin.layouts.master');
@section('title')
    Create Category
@endsection
@section('content')
    <div class="col-3 offset-8">
        <a href="{{ route('products') }}"><button class="btn bg-dark text-white my-3">List</button></a>
    </div>
    </div>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8 ">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3 class="text-center title-2">Create Product</h3>
                    </div>
                    <hr>
                    <form action="{{ route('product_insert')}}" enctype="multipart/form-data" method="post" novalidate="novalidate">
                        @csrf
                        <!--Name -->
                        <div class="form-group">
                            <label for="nameL" class="control-label mb-1">Name</label>
                            <input id="" name="name" id="nameL" type="text" value="{{ old('name') }}"
                                class="form-control   @error('name') is-invalid @enderror " aria-required="true"
                                aria-invalid="false" placeholder="Ender Product Name">
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <!--Category Type -->
                        <div class="form-group">
                            <label for="cidL" class="control-label mb-1">Category</label>
                            <select name="category" class="form-control @error('category') is-invalid @enderror"
                                id="cidL">
                                <option value="">Choose Pizza..</option>
                                @foreach ($categories as $c)
                                    <option value="{{ $c->id }}" @if(old('category')==$c->id) selected @endif>{{ $c->name }}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- Description -->
                        <div class="form-group">
                            <label for="descL" class="control-label mb-1">Description</label>
                            <textarea name="description" id="descL" class="form-control @error('description') is-invalid @enderror"
                                rows="5">{{old('description')}}</textarea>
                            @error('description')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- Image -->
                        <div class="form-group">
                            <label for="imageL" class="control-label mb-1">Category</label>
                            <input type="file" name="image" accept="image/*" id="imageL"
                                class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- Waiting Time -->
                        <div class="form-group">
                            <label for="waitingL" class="control-label mb-1">Waiting Time</label>
                            <input id="" name="waitingTime" id="waitingL" type="number"
                                value="{{ old('waitingTime') }}"
                                class="form-control   @error('waitingTime') is-invalid @enderror " aria-required="true"
                                aria-invalid="false" placeholder="Ender Time (minutes)">
                            @error('waitingTime')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- Price -->
                        <div class="form-group">
                            <label for="priceL" class="control-label mb-1">Price</label>
                            <input id="" name="price" id="priceL" type="number"
                                value="{{ old('price') }}"
                                class="form-control   @error('price') is-invalid @enderror " aria-required="true"
                                aria-invalid="false" placeholder="Price ">
                            @error('price')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                <span id="payment-button-amount">Create</span>
                                <i class="fa-solid fa-circle-right"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.sBarProduct').addClass('active')
        });
    </script>
@endpush
