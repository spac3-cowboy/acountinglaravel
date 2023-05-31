@extends('admin.layouts.Master')

@section('title', 'Transaction Head Create')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">

                    </ol>
                </div>
                <h4 class="page-title">Create New Transaction Head</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="card mb-md-0 mb-3 ">
                    <div class="card-body ">
                        @include('admin.widgets.FlashMessage')
                        <form class="row g-3" method="POST" action="{{route('Transaction.Head.Store')}}">
                            @csrf
                            <div class="col-12">
                                <label class="form-label">Transaction Head Title</label>
                                <input type="text" name="title" class="form-control" placeholder="Give a title" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Kind</label>
                                <select class="form-control" name="kind">
                                    <option value="income">Income</option>
                                    <option value="expense">Expense</option>
                                </select>
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
