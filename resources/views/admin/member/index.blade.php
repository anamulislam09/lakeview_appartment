@extends('layouts.admin.master')

@section('content')
    <style>
        /* Existing Styles */

        .hidden {
            display: none;
        }

        @media screen and (max-width: 767px) {
            /* Mobile Styles */
        }

        .modal-dialog {
            max-width: 900px;
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
            @include('layouts.admin.flash-message')
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
                                        <label for="floor_id" class="text">Floor</label>
                                        <select name="floor_id" id="floor_id" class="form-control text" required>
                                            <option value="0" selected>All Floor</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 form">
                                        <label for="appartment_id" class="text">Appartment</label>
                                        <select name="appartment_id" id="appartment_id" class="form-control text" required>
                                            <option value="0" selected>All Appartment</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 form">
                                        <label for="search" class="text"></label>
                                        <input type="search" class="form-control text mt-2" name="search" id="search"
                                            placeholder="Search here">
                                    </div>
                                </div>

                                <div class="table-responsive hidden" id="membersTableContainer">
                                    <table id="membersTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Member Name</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>Apartment Name</th>
                                                <th>Created By</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="memberTable">
                                            <!-- Dynamic Rows Will Be Appended Here -->
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

        $(document).ready(function() {
            let lastSearchResults = []; // To store the last search or filter results

            // Hide the table by default
            $('#membersTableContainer').hide();

            $('#search').on('input', function() {
                var query = $(this).val();
                var buildingId = $('#building_id').val();
                var floorId = $('#floor_id').val();
                var appartmentId = $('#appartment_id').val();

                if (query) {
                    filterMembers(buildingId, floorId, appartmentId,
                    query); // Perform search based on input
                } else {
                    // If search is empty, filter by building, floor, and apartment
                    filterMembers(buildingId, floorId, appartmentId, ''); // Pass an empty query
                }
            });

            $('#building_id, #floor_id, #appartment_id').on('change', function() {
                var query = $('#search').val(); // Get the current search query
                var buildingId = $('#building_id').val();
                var floorId = $('#floor_id').val();
                var appartmentId = $('#appartment_id').val();

                if (query) {
                    filterMembers(buildingId, floorId, appartmentId,
                    query); // Perform search if query exists
                } else {
                    filterMembers(buildingId, floorId, appartmentId,
                    ''); // Filter based on building, floor, and apartment
                }
            });

            function displayMembers(members) {
                $('#memberTable').html(''); // Clear the table
                if (members.length > 0) {
                    $('#membersTableContainer').show();
                    $.each(members, function(index, member) {
                        var auth_name = member.auth_name ? member.auth_name : 'N/A';
                        var appartment_name = member.appartment_name ? member.appartment_name : 'N/A';
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
                            '<a href="" class="btn btn-sm btn-info edit" data-id="' +
                            member.id +
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
                    $('#memberTable').html('<tr><td colspan="8" class="text-center">No Data Found</td></tr>');
                }
            }

            function filterMembers(buildingId, floorId = '', appartmentId = '', query = '') {
                $.ajax({
                    url: '/admin/filter-members',
                    type: 'GET',
                    data: {
                        building_id: buildingId,
                        floor_id: floorId,
                        appartment_id: appartmentId,
                        search: query // Pass the search query to the server
                    },
                    success: function(data) {
                        lastSearchResults = data.members; // Store the last search results
                        displayMembers(lastSearchResults);
                    },
                    error: function() {
                        console.error('Error filtering members');
                    }
                });
            }

            // Building selection handler
            $('#building_id').change(function() {
                var buildingId = $(this).val();
                fetchFloors(buildingId);
                filterMembers(buildingId, null, null);
            });

            // Floor selection handler
            $('#floor_id').change(function() {
                var buildingId = $('#building_id').val();
                var floorId = $(this).val();
                fetchApartments(floorId);
                filterMembers(buildingId, floorId, null);
            });
            // Apartment selection handler
            $('#appartment_id').change(function() {
                var buildingId = $('#building_id').val();
                var floorId = $('#floor_id').val();
                var appartmentId = $(this).val();
                filterMembers(buildingId, floorId, appartmentId);
            });

            function fetchFloors(buildingId) {
                $.ajax({
                    url: '/admin/get-floors/' + buildingId,
                    type: 'GET',
                    success: function(data) {
                        // Clear the floor dropdown
                        $('#floor_id').html('<option value="0" selected>All Floor</option>');

                        // Populate the floor dropdown with data
                        $.each(data, function(index, floor) {
                            $('#floor_id').append('<option value="' + floor.id + '">' + floor
                                .building_floor + '</option>');
                        });

                        // Optionally, trigger the change event to auto-update the apartments
                        $('#floor_id').change();
                    }
                });
            }

            function fetchApartments(floorId) {

                $.ajax({
                    url: '/admin/get-appartment/' + floorId, // Ensure this matches your route
                    type: 'GET',
                    success: function(data) {

                        // Clear and populate the apartment dropdown
                        $('#appartment_id').html('<option value="0" selected>All Apartment</option>');
                        $.each(data, function(index, appartment) {
                            $('#appartment_id').append('<option value="' + appartment.id +
                                '">' +
                                appartment.appartment_name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching apartments:', error);
                    }
                });
            }
        });
    </script>
@endsection
