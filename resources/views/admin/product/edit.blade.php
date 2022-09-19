@extends('admin.layouts.master')

@section('content')
    <form action="{{route('product#update',$product->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        <h3 class="text-center">Edit Pizza</h3>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-4 p-3 card">
                    <img src="{{asset('storage/product_photos/'.$product->image)}}" alt="">
                <div class="form-group my-1">
                    <input class="form-control" type="file" name="image">
                    @error('image')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-dark my-2"><i class="fa-solid fa-circle-up"></i> Update
                    Pizza</button>
            </div>
            <div class="col-md-6 p-3 card d-flex justify-content-around flex-column">
                    @csrf
                    <!--Name -->
                    <div class="form-group">
                        <label for="nameL" class="control-label mb-1">Name</label>
                        <input id="" name="name" id="nameL" type="text" value="{{ old('name',$product->name) }}"
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
                                <option value="{{ $c->id }}" @if(old('category',$product->category_id)==$c->id) selected @endif>{{ $c->name }}</option>
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
                            rows="5">{{old('description',$product->descriptin)}}</textarea>
                        @error('description')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Waiting Time -->
                    <div class="form-group">
                        <label for="waitingL" class="control-label mb-1">Waiting Time</label>
                        <input id="" name="waitingTime" id="waitingL" type="number"
                            value="{{ old('waitingTime',$product->waiting_time) }}"
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
                            value="{{ old('price',$product->price) }}"
                            class="form-control   @error('price') is-invalid @enderror " aria-required="true"
                            aria-invalid="false" placeholder="Price ">
                        @error('price')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- View Count -->
                    <div class="form-group">
                        <label for="view_countL" class="control-label mb-1">View Count</label>
                        <input id="" name="price" id="view_countL" type="number"
                            value="{{ $product->view_count}}"
                            class="form-control" aria-required="true"
                            aria-invalid="false" disabled>
                    </div>
                    <!-- Created at -->
                    <div class="form-group">
                        <label for="created_atL" class="control-label mb-1">Created_at</label>
                        <input id="" name="price" id="created_atL" type="text"
                            value="{{ $product->created_at->format('d-m-Y h:i:s A')}}"
                            class="form-control" aria-required="true"
                            aria-invalid="false" disabled>
                    </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
@endpush
