@extends('server.layouts.masterlayout')

@section('content')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" --}}
    <div class="card mb-3">
        <div class="card-body">
            <nav class="navbar navbar-light bg-light">
                <form id="searchForm">
                    @csrf
                    <div class="input-group mb-0">
                        <div class="form-group-feedback form-group-feedback-left">
                            <input type="search" class="form-control mr-sm-2" placeholder="Search by Phone" id="searchInput">
                            <div class="form-control-feedback form-control-feedback-lg">
                                <i class="icon-search4 text-muted"></i>
                            </div>
                        </div>
                        <div class="input-group-append ms-2">
                            <button type="submit" class="btn btn-primary btn-lg">Search</button>
                        </div>
                    </div>
                </form>

                <form id="excel" action="{{ route('admin.excel.import') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="input-group mb-0">
                        <div class="form-group-feedback form-group-feedback-left">
                            <input type="file" name="excel_file">
                        </div>
                        <div class="input-group-append ms-2">
                            <button type="submit" class="btn btn-dark my-2 my-sm-0">Import Excel</button>
                        </div>
                    </div>
                </form>

                <a href="{{ route('admin.excel.export') }}" class="btn btn-dark my-2 my-sm-0">Export Excel</a>
            </nav>
        </div>
    </div>

    <div class="col-lg-12 stretch-card" id="existingTable">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Admin's Table</h4>
                @if (Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                @if (Session::has('fail'))
                    <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                @endif
                <div class="table-responsive bg-light">
                    <table class="table table-light table-hover">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Designation</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Email</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $admin)
                                <tr class="table-info">
                                    <td>{{ $admin->id }}</td>
                                    <td>{{ $admin->admin_name }}</td>
                                    <td>{{ $admin->designation }}</td>
                                    <td>{{ $admin->phone }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>
                                        <form action="{{ route('admin.destroy') }}" method="get">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $admin->id }}">
                                            <button class="btn btn-sm btn-danger" type="submit"
                                                onclick="return confirm('Are you sure?')">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div id="searchResultsSection" class="table-responsive" style="display: none;">
                        <h4 class="card-title">Delivery Table</h4>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Designation</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody id="searchResultsBody">
                                <!-- Search results will be dynamically added here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>

        {{-- <script>
        $(document).ready(function() {
            var existingTable = $('#existingTable');
            var searchResultsSection = $('#searchResultsSection');

            // Initial setup: hide search results, show existing table
            existingTable.show();
            searchResultsSection.hide();

            // Form submission handler
            $('#searchForm').submit(function(e) {
                e.preventDefault(); // Prevent the default form submission

                var searchInput = $('#searchInput').val();

                // Include CSRF token in headers
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // Determine the route dynamically based on your logic
                var searchRoute =
                '{{ route('admin.adminSearch') }}'; // You can modify this based on your requirements

                $.ajax({
                    url: searchRoute,
                    type: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        search: searchInput,
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);

                        // Show search results, hide existing table
                        existingTable.hide();
                        searchResultsSection.show();

                        if (response.deliveries.length > 0) {
                            var resultsBody = $('#searchResultsBody');
                            resultsBody.empty();

                            $.each(response.deliveries, function(index, delivery) {

                                var statusBadge = `
                            <td>
                            <form action="{{ route('admin.destroy') }}" method="get">
                            @csrf
                            <input type="hidden" name="id" value="{{ $admin->id }}">
                            <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Are you sure?')">
                            <i class="fa-solid fa-check"></i>
                            </button>
                            </form>
                            </td>`;

                                resultsBody.append('<tr>' +
                                    '<td>' + delivery.id + '</td>' +
                                    '<td>' + delivery.admin_name + '</td>' +
                                    '<td>' + delivery.designation + '</td>' +
                                    '<td>' + delivery.phone + '</td>' +
                                    '<td>' + delivery.email + '</td>' +
                                    statusBadge +
                                    '</tr>');
                            });
                        } else {
                            resultsBody.html(
                                '<tr><td colspan="6" class="text-center fw-bold">No data found for the selected inputs.</td></tr>'
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching search results:', error);
                        console.log('Status:', status);
                        console.log('XHR:', xhr);

                        var resultsBody = $('#searchResultsBody');
                        resultsBody.html(
                            '<tr><td colspan="4">Error fetching search results. Please try again.</td></tr>'
                        );
                        existingTable.show();
                    }
                });
            });

            // Add an event listener for the input to handle clearing
            $('#searchInput').on('input', function() {
                var searchInput = $(this).val();

                if (searchInput === '') {
                    // If the input is cleared, hide search results, show existing table
                    searchResultsSection.hide();
                    existingTable.show();
                }
            });
        });
    </script> --}}
    @endsection
