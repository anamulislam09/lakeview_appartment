@extends('layouts.admin.master')

@section('content')
    <style>
        @media screen and (max-width: 767px) {

            div.dataTables_wrapper div.dataTables_length,
            div.dataTables_wrapper div.dataTables_filter,
            div.dataTables_wrapper div.dataTables_info,
            div.dataTables_wrapper div.dataTables_paginate {
                text-align: right !important;
            }

            .card-title a {
                font-size: 15px;
            }

            .text {
                font-size: 10px !important;
            }

            table,
            thead,
            tbody,
            tr,
            td,
            th {
                font-size: 13px !important;
                padding: 10px !important;
            }

            .card-header {
                padding: .25rem 1.25rem;
            }
        }

        a.disabled {
            pointer-events: none;
            cursor: default;
        }

        .modal-dialog {
            max-width: 650px;
        }

        .table td,
        .table th {
            padding: .20rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
            font-size: 14px;
        }

        .text {
            font-size: 14px
        }
    </style>

    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mt-4 ml-2" style="font-size: 25px">Members</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Member</li>
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
                                    <a href="{{ route('member.create') }}" class="btn btn-light shadow rounded m-0">
                                        <i class="fas fa-plus"></i><span>Add New</span>
                                    </a>
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                        <label for="building_id">Building</label>
                                        <select name="building_id" id="building_id" class="form-control">
                                            <option value="0" selected>All Building</option>
                                            @foreach ($buildings as $building)
                                                <option value="{{ $building->id }}">{{ $building->building_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 form">
                                        <label for="appartment_id" class="text">Appartment</label>
                                        <select name="appartment_id" id="appartment_id" class="form-control text" required>
                                            <option value="0" selected>All Appartment</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Member Name</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>appartment Name</th>
                                                <th>Created By</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="memberTable">
                                            @foreach ($data as $key => $item)
                                                @php
                                                    $auth_name = App\Models\Admin::where(
                                                        'id',
                                                        $item->created_by,
                                                    )->value('name');
                                                    $appartment_name = App\Models\Appartment::where(
                                                        'id',
                                                        $item->appartment_id,
                                                    )->value('appartment_name');
                                                @endphp
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $item->member_name }}</td>
                                                    <td>{{ $item->mobile_phone }}</td>
                                                    <td>{{ $item->email }}</td>
                                                    <td>{{ $appartment_name }}</td>
                                                    <td>{{ $auth_name }}</td>
                                                    <th>
                                                        @if ($item->status == 1)
                                                            <span class="badge badge-success">Active</span>
                                                        @else
                                                            <span class="badge badge-danger">Inactive</span>
                                                        @endif
                                                    </th>
                                                    <td>
                                                        <a href="" class="btn btn-sm btn-info edit"
                                                            data-id="{{ $item->id }}" data-toggle="modal"
                                                            data-target="#editUser">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="{{ route('member.show', $item->id) }}"
                                                            class="btn btn-sm btn-success">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('appartment.destroy', $item->id) }}"
                                                            class="btn btn-sm btn-danger">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Member</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="modal_body"></div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('admin-assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"></script>
    <script>
        $('body').on('click', '.edit', function() {
            let member_id = $(this).data('id');
            $.get("/admin/member/edit/" + member_id, function(data) {
                $('#modal_body').html(data);
            });
        });

        $('#building_id').change(function() {
            var buildingId = $(this).val();
            $.ajax({
                url: '/admin/get-appartment/' + buildingId,
                type: 'GET',
                success: function(data) {
                    $('#appartment_id').html(
                        '<option value="0" selected>All Appartment</option>');
                    $.each(data.appartments, function(index, appartment) {
                        $('#appartment_id').append('<option value="' + appartment.id + '">' +
                            appartment.appartment_name + '</option>');
                    });

                    // Update the member table based on building
                    filterMembers(buildingId, null);
                }
            });
        });

        $('#appartment_id').change(function() {
            var buildingId = $('#building_id').val();
            var appartmentId = $(this).val();
            filterMembers(buildingId, appartmentId);
        });

        function filterMembers(buildingId, appartmentId) {
            $.ajax({
                url: '/admin/filter-members',
                type: 'GET',
                data: {
                    building_id: buildingId,
                    appartment_id: appartmentId
                },
                success: function(data) {
                    $('#memberTable').html('');
                    if (data.members.length > 0) {
                        $.each(data.members, function(index, member) {
                            var auth_name = member.auth_name ? member.auth_name : 'N/A';
                            var appartment_name = member.appartment_name ? member.appartment_name :
                                'N/A';
                            var status = member.status == 1 ?
                                '<span class="badge badge-success">Active</span>' :
                                '<span class="badge badge-danger">Inactive</span>';
                            var row = '<tr>' +
                                '<td>' + (index + 1) + '</td>' +
                                '<td>' + member.member_name + '</td>' +
                                '<td>' + member.mobile_phone + '</td>' +
                                '<td>' + member.email + '</td>' +
                                '<td>' + appartment_name + '</td>' +
                                '<td>' + auth_name + '</td>' +
                                '<th>' + status + '</th>' +
                                '<td>' +
                                '<a href="" class="btn btn-sm btn-info edit" data-id="' + member.id +
                                '" data-toggle="modal" data-target="#editUser"><i class="fas fa-edit"></i></a>' +
                                '<a href="/admin/member/show/' + member.id +
                                '" class="btn btn-sm btn-success"><i class="fas fa-eye"></i></a>' +
                                '<a href="/admin/appartment/destroy/' + member.id +
                                '" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>' +
                                '</td>' +
                                '</tr>';
                            $('#memberTable').append(row);
                        });
                    } else {
                        $('#memberTable').html(
                            '<tr><td colspan="8" class="text-center">Data Not Found</td></tr>');
                    }
                }
            });
        }
    </script>
@endsection
