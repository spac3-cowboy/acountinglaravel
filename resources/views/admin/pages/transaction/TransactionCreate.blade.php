@extends('admin.layouts.Master')

@section('title', 'Transaction Create')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">

                    </ol>
                </div>
                <h4 class="page-title">Create New Transaction </h4>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="card mb-md-0 mb-3 ">
                    <div class="card-body ">
                        @include('admin.widgets.FlashMessage')
                        <form class="row g-3" method="POST" action="{{route('Transaction.Store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="col-12">
                                <label class="form-label">Choose Transaction Head</label>
                                <select class="form-control" name="transaction_head_id">
                                    @foreach($transHead as $row)
                                        <option value="{{$row->id}}">{{$row->title}} -- {{$row->kind}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Choose Account</label>
                                <select class="form-control" name="transaction_account_id">
                                    @foreach($accounts as $row)
                                        <option value="{{$row->id}}">{{$row->title}} -- Current Balance: {{$row->balance/100}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" placeholder="Give a title" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Note</label>
                                <textarea class="form-control" name="note"></textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Amount</label>
                                <input type="number" name="amount" class="form-control" required>
                            </div>
                            <div class="col-12">
                                <label for="example-date" class="form-label">Date</label>
                                <input class="form-control" id="example-date" type="date" name="date" required>
                            </div>

                            <div class="col-12">
                                <label for="form-label">File</label>
                                <input type="file" name="file" class="form-control">
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
