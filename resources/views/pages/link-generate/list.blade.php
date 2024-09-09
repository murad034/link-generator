@extends('pages.layouts.master')

@section('css')
    <link href="https://cdn.datatables.net/2.1.5/css/dataTables.dataTables.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h1>List of urls</h1>
            <table class="table table-bordered" id="url_list">
                <thead>
                <tr>
                    <th scope="col">#ID</th>
                    <th scope="col">Full Url</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.datatables.net/2.1.5/js/dataTables.min.js"></script>
    <script>
        const ajaxURL = "{{route('url-link.list')}}";
        $('table#url_list').DataTable({
            dom: 'Blfrtip',
            language: {processing: "<span class='loading-datatable'><span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Loading Data...</span>"},
            processing: true,
            serverSide: true,
            order: [[0, "desc"]],
            ajax: {
                url: ajaxURL,
            },
            aLengthMenu: [[25, 50, 100, 1000, -1], [25, 50, 100, 1000, "All"]],
            columns: [
                {data: 'id', name: 'id'},
                {data: 'full_url', name: 'full_url'},
                {data: 'action', name: 'action'}
            ]
        });
    </script>
@endsection

