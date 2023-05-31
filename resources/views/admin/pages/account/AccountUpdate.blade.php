@extends('admin.layouts.Master')

@section('title', 'Account Update')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">

                    </ol>
                </div>
                <h4 class="page-title">Update Account</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="card mb-md-0 mb-3 ">
                    <div class="card-body ">
                        @include('admin.widgets.FlashMessage')
                        <form class="row g-3" method="POST" action="{{route('Transaction.Account.Update', $account->id)}}">
                            @csrf
                            <div class="col-12">
                                <label class="form-label">Account Title</label>
                                <input type="text" name="title" class="form-control" value="{{$account->title}}" placeholder="Give a title" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Account Details</label>
                                <textarea class="form-control" name="details" required>{{$account->details}}</textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Balance</label>
                                <input type="number" name="balance" class="form-control" value="{{$account->balance/100}}" required>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form><!-- Vertical Form -->

                    </div>

                </div>
            </div>

        </div>
@endsection
