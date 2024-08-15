@extends('layouts.admin.master')

@section('content')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS for styling -->
    <style>
        .document-img {
            width: 30%;
            height: 30%;
            object-fit: cover;
            cursor: pointer;
            transition: .3s;
        }

        .document-img:hover {
            transform: scale(1.1);
        }

        .modal-body {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        h5.card-title {
            margin-right: 10%;
        }

        .modal-body img {
            max-width: 100%;
            max-height: 100%;
            margin: auto;
            font-weight: 600
        }

        .list-group-item {
            position: relative;
            display: block;
            padding: .45rem 1.25rem;
            background-color: #fff;
            border: 1px solid rgba(189, 188, 188, 0.125);
        }
        .strong{
            width: 20%
        }

        table, tr, th,td{
            padding: 6px 8px !important;
        }
    </style>

    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content mt-3">
            <div class="container-fluid">
                <div class="card">
                    <h5 class="text-center">{{ $data->member_name }} Details Information</h5>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <ul class="list-group">
                            <li class="list-group-item"><strong class="strong">Name</strong><span style="margin: 0px 20px"> :</span> {{ $data->member_name }}</li>
                            <li class="list-group-item"><strong>Guardian</strong> <span style="margin: 0px 20px"> :</span> {{ $data->guardian_name }}</li>
                            <li class="list-group-item"><strong>Mother Name</strong> <span style="margin: 0px 20px"> :</span> {{ $data->mother_name }}</li>
                            <li class="list-group-item"><strong>Date_of_Birth</strong> <span style="margin: 0px 20px"> :</span> {{ $data->date_of_birth }}</li>
                            <li class="list-group-item"><strong>Nationality</strong> <span style="margin: 0px 20px"> :</span> {{ $data->nationality }}</li>
                            <li class="list-group-item"><strong>Religion</strong> <span style="margin: 0px 20px"> :</span> {{ $data->religion }}</li>
                            <li class="list-group-item"><strong>Address</strong> <span style="margin: 0px 20px"> :</span> {{ $data->permanent_address }}</li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <ul class="list-group">
                            <li class="list-group-item"><strong>Nid_no</strong><span style="margin: 0px 20px"> :</span> {{ $data->nid_no }}</li>
                            <li class="list-group-item"><strong>Car_no</strong><span style="margin: 0px 20px"> :</span> {{ $data->car_no }}</li>
                            <li class="list-group-item"><strong>Garage_no</strong><span style="margin: 0px 20px"> :</span> {{ $data->garage_no }}</li>
                            <li class="list-group-item"><strong>Occupation</strong><span style="margin: 0px 20px"> :</span> {{ $data->occupation }}</li>
                            <li class="list-group-item"><strong>Institute_name</strong><span style="margin: 0px 20px"> :</span> {{ $data->institute_name }}</li>
                            <li class="list-group-item"><strong>Institute_address</strong><span style="margin: 0px 20px"> :</span> {{ $data->institute_address }}
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="">
                    <p class="text-center" style="font-size: 20px; margin: 10px 0px; border-bottom:1px solid #ddd"><strong>Contact Info</strong></p>
                    <li class="list-group-item"><strong>Intercom_no</strong><span style="margin: 0px 20px"> :</span> {{ $data->intercome_no }}</li>
                    <li class="list-group-item"><strong>Land_phone</strong><span style="margin: 0px 20px"> :</span> {{ $data->land_phone }}</li>
                    <li class="list-group-item"><strong>Mobile_phone</strong><span style="margin: 0px 20px"> :</span> {{ $data->mobile_phone }}</li>
                    <li class="list-group-item"><strong>Email</strong><span style="margin: 0px 20px"> :</span> {{ $data->email }}</li>
                </div>
                {{-- <h3 class="mt-2 text-center">All Documents</h3> --}}
                <p class="mt-2 text-center" style="font-size: 20px; margin: 10px 0px; border-bottom:1px solid #ddd"><strong>All Documents</strong></p>
                {{-- <hr>  --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mt-3">
                            <div class="card-body">
                                <h5 class="card-title">National ID (NID)</h5>
                                <img src="{{ asset($data->nid) }}" class="document-img" alt="NID Document"
                                    data-toggle="modal" data-target="#imageModal" data-image="{{ asset($data->nid) }}"
                                    data-name="National ID (NID)">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mt-3">
                            <div class="card-body">
                                <h5 class="card-title">Image</h5>
                                <img src="{{ asset($data->image) }}" class="document-img" alt="Image"
                                    data-toggle="modal" data-target="#imageModal" data-image="{{ asset($data->image) }}"
                                    data-name="TIN Number">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mt-3">
                            <div class="card-body">
                                <h5 class="card-title">Registration Document</h5>
                                <img src="{{ asset($data->flat_reg_document) }}" class="document-img"
                                    alt="flat_reg_document " data-toggle="modal" data-target="#imageModal"
                                    data-image="{{ asset($data->flat_reg_document) }}" data-name="Flat Reg Document">
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <p class="mt-2 text-center" style="font-size: 20px; margin: 10px 0px; border-bottom:1px solid #ddd"><strong>Family Member Info</strong></p>
                <div class="table-responsive" id="ftable">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SL.</th>
                                <th>Name</th>
                                <th>Occupation</th>
                                <th>Age</th>
                                <th>Relation</th>
                                <th>Image</th>
                            </tr>
                        </thead>
                        <tbody id="familyMemberTable">
                            @foreach ($fmembers as $key => $fmember)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $fmember->family_member_name }}</td>
                                    <td>{{ $fmember->family_member_occupation }}</td>
                                    <td>{{ $fmember->family_member_age }}</td>
                                    <td>{{ $fmember->family_member_relation }}</td>
                                    <td>
                                        <img src="{{ asset($fmember->family_member_image) }}" class="document-img"
                                            alt="family_member_image " data-toggle="modal" data-target="#imageModal"
                                            data-image="{{ asset($data->family_member_image) }}"
                                            data-name="Family Member Image">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

    <!-- Modal for displaying full image -->
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Document Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="" id="fullImage" class="img-fluid" alt="Document Image">
                </div>
                <div class="modal-footer">
                    <h5 id="imageName"></h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $('#imageModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var imageUrl = button.data('image');
            var imageName = button.data('name');
            var modal = $(this);
            modal.find('.modal-body img').attr('src', imageUrl);
            modal.find('.modal-footer #imageName').text(imageName);
        });
    </script>
@endsection
