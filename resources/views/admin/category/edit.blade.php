@extends('admin.layouts.master');
@section('title')
    Create Category
@endsection
@section('content')
    <div class="col-3 offset-8">
        <a href="{{ route('category#list') }}"><button class="btn bg-dark text-white my-3">List</button></a>
    </div>
    </div>
    <div class="col-lg-6 offset-3">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3 class="text-center title-2">Edit Category</h3>
                </div>
                <hr>
                <form action="{{ route('category#update',$category->id) }}" method="post" novalidate="novalidate">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1">Name</label>
                        <input id="cc-pament" name="categoryName" type="text" value="{{old('categoryName',$category->name)}}"
                            class="form-control   @error('categoryName') is-invalid @enderror " aria-required="true"
                            aria-invalid="false" placeholder="Seafood...">
                        @error('categoryName')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                            <span id="payment-button-amount">Update</span>
                            <span id="payment-button-sending" style="display:none;">Sending…</span>
                            <i class="fa-solid fa-circle-right"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endsection

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('.sBarCategory').addClass('active')
            });
        </script>
    @endpush
