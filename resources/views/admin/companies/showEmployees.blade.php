@extends('layouts.app')
<style>
    .dataTables_filter label {
        float: right;
    }
</style>
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-sm-12">

                <div class="card mt-3">
                    <div class="card-body">
                        <div class="d-flex">
                            <h1>{{ Auth::user()->lang == 'en' ? 'Employee' : 'Karyawan' }} <small class="text-muted">{{ $company->name }}</small></h1>
                            <div class="ml-auto">
                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary btm-sm dropdown-toggle" type="button"
                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Actions
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{ route('admin.companies.employees.create', $company->id) }}">{{ Auth::user()->lang == 'en' ? 'Add New Employee' : 'Tambah karyawan baru' }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if ($company->employee->count())
                            <table id="employee-table" class="table table-hover table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>{{ Auth::user()->lang == 'en' ? 'First Name' : 'Nama Depan' }}</th>
                                        <th>{{ Auth::user()->lang == 'en' ? 'Last Name' : 'Nama Belakang' }}</th>
                                        <th>Email</th>
                                        <th>{{ Auth::user()->lang == 'en' ? 'Phone' : 'Nomor Telepon' }}</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($company->employee as $employee)
                                        <tr>
                                            <td>{{ $employee->first_name }}</td>
                                            <td>{{ $employee->last_name }}</td>
                                            <td>{{ $employee->email }}</td>
                                            <td>{{ $employee->phone }}</td>
                                            <td>
                                                <div class="ml-auto">
                                                    <div class="dropdown">
                                                        <button class="btn btn-outline-secondary btm-sm dropdown-toggle" type="button"
                                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Actions
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item" href="{{ route('admin.companies.employees.edit', ['employee'=> $employee-> id]) }}">Edit</a>
                                                            <a href="#" class="dropdown-item text-danger" onclick="deleteEmployee()">{{ Auth::user()->lang == 'en' ? 'Delete Employee' : 'Hapus Karyawan' }}</a>
                                                            <form action="{{route('admin.companies.employees.delete', ['employee'=> $employee-> id])}}" id="delete-employee-form" style="display:none;" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('footer-scripts')
    <script>
        function deleteEmployee() {
            var r = confirm("Are you sure you want to delete this employee?")
            if (r) {
                document.querySelector('form#delete-employee-form').submit()
            }
        }
    </script>
         	<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
             <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js" defer></script>
             <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js" defer></script>

             <script>
                $(document).ready(function () {
                    // Setup - add a text input to each footer cell
                    $('#employee-table thead tr')
                        .clone(true)
                        .addClass('filters')
                        .appendTo('#employee-table thead');

                    var table = $('#employee-table').DataTable({
                        orderCellsTop: true,
                        fixedHeader: true,
                        initComplete: function () {
                            var api = this.api();

                            // For each column
                            api
                                .columns()
                                .eq(0)
                                .each(function (colIdx) {
                                    // Set the header cell to contain the input element
                                    var cell = $('.filters th').eq(
                                        $(api.column(colIdx).header()).index()
                                    );
                                    var title = $(cell).text();
                                    if (title !== 'Actions') {
                                        $(cell).html('<input style="width:100%;" type="text" placeholder="' + title + '" />');
                                    } else {
                                        $(cell).html('')
                                    }

                                    // On every keypress in this input
                                    $(
                                        'input',
                                        $('.filters th').eq($(api.column(colIdx).header()).index())
                                    )
                                        .off('keyup change')
                                        .on('keyup change', function (e) {
                                            e.stopPropagation();

                                            // Get the search value
                                            $(this).attr('title', $(this).val());
                                            var regexr = '({search})'; //$(this).parents('th').find('select').val();

                                            var cursorPosition = this.selectionStart;
                                            // Search the column for that value
                                            api
                                                .column(colIdx)
                                                .search(
                                                    this.value != ''
                                                        ? regexr.replace('{search}', '(((' + this.value + ')))')
                                                        : '',
                                                    this.value != '',
                                                    this.value == ''
                                                )
                                                .draw();

                                            $(this)
                                                .focus()[0]
                                                .setSelectionRange(cursorPosition, cursorPosition);
                                        });
                                });
                        },
                    });
                });
                </script>
@endpush
