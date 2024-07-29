@extends('layouts.admin.master')

@section('content')
    <style>
        @media screen and (max-width: 767px) {
            .card-title a {
                font-size: 15px;
            }
            table,
            thead,
            tbody,
            tr,
            td {
                font-size: 14px;
            }
        }
    </style>

    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mt-4 ml-2" style="font-size: 25px">Appartment</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Appartment</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- Main content -->
        <section class="content mt-3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-primary p-1">
                                <h3 class="card-title">
                                    <a href="{{ route('appartment.create') }}"class="btn btn-light shadow rounded m-0"><i
                                            class="fas fa-plus"></i><span>Add New</span></a>
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Appartment Name</th>
                                                <th>Building Name</th>
                                                <th>Created By</th>
                                                <th>Status</th>
                                                <th> Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $key => $item)
                                            @php
                                                $auth_name = App\Models\Admin::where('id', $item->created_by)->value('name');
                                            @endphp
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $item->appartment_name }}</td>
                                                    <td>{{ $item->building_name }}</td>
                                                    <td>{{$auth_name}}</td>
                                                    <th>
                                                        @if ($item->status == 1)
                                                            <span class="badge badge-success">Active</span>
                                                        @else
                                                            <span class="badge badge-danger">Inactive</span>
                                                        @endif
                                                    </th>
                                                    <td>
                                                        <a href="" class="btn btn-sm btn-info edit" data-id="{{$item->id}}" data-toggle="modal" data-target="#editUser"><i class="fas fa-edit"></i></a>
                                                        <a href="{{ route('appartment.destroy', $item->id) }}"
                                                            class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Appartment </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="modal_body">

                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('admin-assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"></script>
    <script>
        $('body').on('click', '.edit', function() {
            let appartment_id = $(this).data('id');
            $.get("/admin/appartment/edit/" + appartment_id, function(data) {
                $('#modal_body').html(data);

            })
        })
    </script>
@endsection
