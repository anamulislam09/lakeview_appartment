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
        }
    </style>

    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content mt-3">
            <div class="container-fluid">
                <div class="card">
                    {{-- <div class="card-header bg-primary text">
                        <h3 class="card-title">Member Details</h3>
                    </div> --}}
                    <h3 class="text-center">{{ $data->member_name }}</h3>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h3>Member Details Information</h3>
                        <ul class="list-group">
                            <li class="list-group-item"><strong>Name:</strong> {{ $data->member_name }}</li>
                            <li class="list-group-item"><strong>Phone:</strong> {{ $data->guardian_name }}</li>
                            <li class="list-group-item"><strong>NID No:</strong> {{ $data->mother_name }}</li>
                            <li class="list-group-item"><strong>Email:</strong> {{ $data->permanent_address }}</li>
                            <li class="list-group-item"><strong>date_of_birth:</strong> {{ $data->date_of_birth }}</li>
                            <li class="list-group-item"><strong>nationality:</strong> {{ $data->nationality }}</li>
                            <li class="list-group-item"><strong>religion:</strong> {{ $data->religion }}</li>
                            <li class="list-group-item"><strong>intercome_no:</strong> {{ $data->intercome_no }}</li>
                            <li class="list-group-item"><strong>land_phone:</strong> {{ $data->land_phone }}</li>
                            <li class="list-group-item"><strong>mobile_phone:</strong> {{ $data->mobile_phone }}</li>
                            <li class="list-group-item"><strong>email:</strong> {{ $data->email }}</li>
                            <li class="list-group-item"><strong>car_no:</strong> {{ $data->car_no }}</li>
                            <li class="list-group-item"><strong>nid_no:</strong> {{ $data->nid_no }}</li>
                            <li class="list-group-item"><strong>garage_no:</strong> {{ $data->garage_no }}</li>
                            <li class="list-group-item"><strong>occupation:</strong> {{ $data->occupation }}</li>
                            <li class="list-group-item"><strong>institute_name:</strong> {{ $data->institute_name }}</li>
                            <li class="list-group-item"><strong>institute_address:</strong> {{ $data->institute_address }}</li>
                        </ul>
                    </div>
                </div>
                <h3 class="mt-2">All Documents</h3>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mt-3">
                            <div class="card-body">
                                <h5 class="card-title">National ID (NID)</h5>
                                <img src="{{ asset($data->nid) }}" class="document-img" alt="NID Document" data-toggle="modal" data-target="#imageModal" data-image="{{ asset($data->nid) }}" data-name="National ID (NID)">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mt-3">
                            <div class="card-body">
                                <h5 class="card-title">Image</h5>
                                <img src="{{ asset($data->image) }}" class="document-img" alt="Image" data-toggle="modal" data-target="#imageModal" data-image="{{ asset($data->image) }}" data-name="TIN Number">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mt-3">
                            <div class="card-body">
                                <h5 class="card-title">Registration Document</h5>
                                <img src="{{ asset($data->flat_reg_document) }}" class="document-img" alt="flat_reg_document " data-toggle="modal" data-target="#imageModal" data-image="{{ asset($data->flat_reg_document) }}" data-name="data Photo">
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <h3 class="mt-2">Family Member Info</h3>
                <ul class="list-group">
                    <li class="list-group-item"><strong>Name:</strong> {{ $data->family_member_name }}</li>
                    <li class="list-group-item"><strong>Occupation:</strong> {{ $data->family_member_occupation }}</li>
                    <li class="list-group-item"><strong>Age:</strong> {{ $data->family_member_age }}</li>
                    <li class="list-group-item"><strong>Relation:</strong> {{ $data->family_member_relation }}</li>
                </ul>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mt-3">
                            <div class="card-body">
                                <h5 class="card-title"> Image</h5>
                                <img src="{{ asset($data->family_member_image) }}" class="document-img" alt="family_member_image " data-toggle="modal" data-target="#imageModal" data-image="{{ asset($data->family_member_image) }}" data-name="data Photo">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Modal for displaying full image -->
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
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

