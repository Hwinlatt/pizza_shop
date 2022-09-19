@extends('admin.layouts.master')

@section('title')
    Admin-Contacts
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- DATA TABLE -->
        <div class="table-data__tool">
            <div class="table-data__tool-left">
                <div class="overview-wrap">
                    <h2 class="title-1">Admin List</h2>
                </div>
            </div>
            <div class="table-data__tool-right">
                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                    CSV download
                </button>
            </div>
        </div>
        @if(session('success'))
        <div class="col-4 offset-8">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        @endif
        <!-- Search Category -->
        <div class="row">
            <div class="col-3 text-secondary">
                <h4>Search key: <span class="text-danger">{{request('key')}}</span></h4>
            </div>
            <div class="col-4 offset-5">
                <form action="{{route('admin#list')}}" method="GET" class="d-flex">
                    <input type="text" name="key" value="{{request('key')}}" class="form-control" placeholder="Search">
                    <button class="btn btn-dark"><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">Totals ({{$contacts->total()}})</div>
        </div>
        <!-- Category Table -->
        <div class="table-responsive table-responsive-data2">
            @if(count($contacts) > 0)
            <table class="table table-data2">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $contact)
                    <tr class="tr-shadow">
                        <td>{{$contact->name}} <input type="text" class="cid d-none" value="{{$contact->id}}"></td>
                        <td>{{$contact->email}}</td>
                        <td>{{$contact->subject}}</td>
                        <td>{{$contact->created_at->format('F-d-Y')}}</td>
                        <td>
                            <a href="{{route('admin#contact_more_info',$contact->id)}}" class="btn btn-primary btn-sm" title="more read"><i class="fa-brands fa-readme"></i></a>
                            <button  class="btn btn-danger btn-sm deleteContact" title="remove contact"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr class="spacer"></tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <h3 class="text-center text-secondary">There is no Contact  Here!</h3>
            @endif
        </div>
        <div>{{$contacts->appends(request()->query())->links()}}</div>
        <!-- END DATA TABLE -->
    </div>

</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function () {
       $('.sBarContact').addClass('active');
        $('.deleteContact').click(function(){
            let row = $(this).closest('tr');
            let id = row.find('.cid').val();
            $.ajax({
                type: "GET",
                url: "{{route('admin#contact_destroy')}}",
                data: {id},
                dataType: "JSON",
                success: function (data) {
                    if (data.status == true) {
                        row.remove();
                    }
                }
            });
        })
    });
</script>
@endpush