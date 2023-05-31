@extends('admin.layouts.Master')

@section('title', 'Transaction History')

@section('content')



    <div class="row">

        <div class="col-12">
            <div class="card mt-3">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-5">

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Add Transaction
                            </button>
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body">
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
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2 mb-2">
                        @include('admin.widgets.FlashMessage')
                    </div>
                    <div class="table-responsive">

                        <table class="table table-centered w-100 dt-responsive nowrap" id="products-datatable">
                            <thead class="table-light">

                            <tr>
                                <th>
                                    Sl
                                </th>
                                <th class="all">Date</th>
                                <th>Title</th>
                                <th>Income</th>
                                <th>Expense</th>
                                <th>Ac Balance</th>
                                <th>Main Balance</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($history as $row)
                            <tr>
                                <td>
                                    {{$loop->iteration}}
                                </td>
                                <td>
                                    @php
                                    $date = \Carbon\Carbon::createFromFormat('Y-m-d', $row->date);
                                    $formattedDate = $date->format('M d, Y');
                                    @endphp

                                    <p><b>{{$formattedDate}}</b></p>

                                    <p>{{$row->transactionHead->title}}</p>
                                </td>
                                <td>
                                    {{$row->title}} <br>
                                   <b>Account: </b>{{$row->account->title}} <br>
                                    @if($row->file)
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#myModal" data-file-url="{{ asset('storage/file/'.$row->file) }}">File</a> <br>
                                    @else
                                    @endif
                                    @if($row->note)
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#note{{$row->id}}">Note</a> <br>
                                        <div class="modal fade" id="note{{$row->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <p>{{$row->note}}</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                    @endif
                                </td>
                                @if($row->transactionHead->kind == 'income')
                                <td>
                                    <p style="color: green"><b>{{$row->amount/100}}</b> </p>
                                </td>
                                <td>
                                    --
                                </td>
                                @else
                                    <td>
                                       --
                                    </td>
                                    <td>
                                       <p style="color: red"><b>{{$row->amount/100}}</b> </p>
                                    </td>
                                @endif

                                <td>

                                    {{ $row->ac_balance/100 }}
                                </td>
                                <td>
                                    {{$row->main_balance/100}}
                                </td>
                                <td>
                                    <a href="{{route('Transaction.Edit', $row->id)}}"  class="view btn btn-info btn-sm"> <i class="mdi mdi-pen"></i></a>

                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>

    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="filePreview"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#myModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var fileUrl = button.data('file-url');
                var fileExtension = fileUrl.split('.').pop().toLowerCase();
                var filePreview = $('#filePreview');

                // Clear the file preview container
                filePreview.empty();

                // Determine the file type and display accordingly
                if (fileExtension === 'pdf') {
                    filePreview.append('<iframe src="' + fileUrl + '" width="100%" height="400"></iframe>');
                } else {
                    filePreview.append('<img src="' + fileUrl + '" width="100%" alt="Image">');
                }
            });
        });
    </script>

@endsection
