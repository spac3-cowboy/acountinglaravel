@extends('admin.layouts.Master')

@section('title', 'Transaction History')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">

                    </ol>
                </div>
                <h4 class="page-title">Accounts</h4>
            </div>

            <div class="card">
                <div class="card-body">
                    <table class="table dt-responsive nowrap w-100"  id="basic-datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Balance</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($transHeads as $row)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$row->title}}</td>
                                <td>{{$row->kind}}</td>
                                <td>
                                    <a href="{{route('Transaction.Head.Edit', $row->id)}}"  class="view btn btn-info btn-sm"> <i class="mdi mdi-account-edit"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>


@endsection
