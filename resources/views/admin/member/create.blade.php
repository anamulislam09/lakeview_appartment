@extends('layouts.admin.master')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" />
    <style>
        .table td,
        .table th {
            padding: 0.6rem;
        }

        /*======================    404 page    =======================*/

        .page_404 {
            padding: 40px 0;
            background: #fff;
            font-family: 'Arvo', serif;
        }

        .page_404 img {
            width: 100%;
        }

        .four_zero_four_bg {

            background-image: url(https://cdn.dribbble.com/users/285475/screenshots/2083086/dribbble_1.gif);
            height: 400px;
            background-position: center;
        }

        .four_zero_four_bg h1 {
            font-size: 80px;
        }

        .link_404 {
            color: #fff !important;
            padding: 10px 20px;
            background: #39ac31;
            margin: 20px 0;
            display: inline-block;
        }

        .contant_box_404 {
            margin-top: -50px;
        }

        @media screen and (max-width: 767px) {
            .card-title a {
                font-size: 15px;
            }

            .card-header {
                padding: .25rem 1.25rem;
            }

            .text {
                font-size: 14px !important;
            }

            .form {
                margin-bottom: 7px !important;
                width: 250px;
                float: left;
            }

            .form2 {
                float: right;
                width: 100px;
            }
        }

        input {
            background: #fff;
        }

        .text {
            font-size: 14px !important;
        }

        .table td,
        .table th {
            padding: 0.6rem;
        }

        .page_404 {
            padding: 40px 0;
            background: #fff;
            font-family: 'Arvo', serif;
        }

        .four_zero_four_bg h3 {
            font-size: 80px;
        }

        .dropify-wrapper .dropify-message p {
            font-size: 14px;
        }
    </style>
    <div class="content-wrapper">
        <!-- Main content -->
        @include('layouts.admin.flash-message')
        <section class="content mt-3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-primary p-1">
                                <h3 class="card-title">
                                    <a href="{{ route('member.index') }}"class="btn btn-light shadow rounded m-0"><span>All
                                            Members</span></a>
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <h5 style="border-bottom: 1px solid #ddd; font-weight:bold" class="text-center pb-2">Member Info Form</h5>
                                <div class="row">
                                    <div class="col-12 px-5 m-auto" style="border: 1px solid #ddd;">
                                        <form action="{{ route('member.store') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <!-- Form Fields Here -->
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group text form">
                                                        <label for="" class="text">Member Name </label>
                                                        <input type="text" name="member_name"
                                                            value="{{ old('member_name') }}" class="form-control text"
                                                            placeholder="Member name" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group text form">
                                                        <label for="" class="text">Guardian Name <span
                                                                style="color: #fb5200; font-size:11px;">(Father/Husband)</span></label>
                                                        <input type="text" name="guardian_name"
                                                            value="{{ old('guardian_name') }}" class="form-control text"
                                                            placeholder="Enter guardian name" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group text form">
                                                        <label for="" class="text">Mother Name</label>
                                                        <input type="text" name="mother_name"
                                                            value="{{ old('mother_name') }}" class="form-control text"
                                                            placeholder="Enter mother name" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group text form">
                                                        <label for="" class="text">Permanent Address </label>
                                                        <input type="text" name="permanent_address"
                                                            value="{{ old('permanent_address') }}" class="form-control text"
                                                            placeholder="Enter permanent address" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group text form">
                                                        <label for="" class="text">Nationality</label>
                                                        <select name="nationality" id="" class="form-control"
                                                            required>
                                                            <option value="Bangladeshi">Bangladeshi</option>
                                                            <option value="Indian">Indian</option>
                                                            <option value="Pakistani">Pakistani</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group text form">
                                                        <label for="" class="text">Religion </label>
                                                        <input type="text" name="religion" value="{{ old('religion') }}"
                                                            class="form-control text" placeholder="Enter permanent address"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 col-sm-6">
                                                    <div class="form-group form">
                                                        <label for="" class="text">Date of Dirth</label>
                                                        <input type="date" value="{{ old('date_of_birth') }}"
                                                            name="date_of_birth" class="form-control text"
                                                            placeholder="Enter date_of_birth" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-6">
                                                    <div class="form-group text form">
                                                        <label for="" class="text">Choose Building</label>
                                                        <select name="building_id" id="building_id" class="form-control"
                                                            required>
                                                            <option value="" selected disabled>Select Building
                                                            </option>
                                                            @foreach ($buildings as $building)
                                                                <option value="{{ $building->id }}">
                                                                    {{ $building->building_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-6">
                                                    <div class="form-group text form">
                                                        <label for="" class="text">Appartment </label>
                                                        <select name="appartment_id" id="appartment_id"
                                                            class="form-control text" required>
                                                            <option value="" selected disabled>Select Apportment
                                                            </option>
                                                            {{-- @foreach ($appartments as $appartment)
                                                                <option value="{{ $appartment->id }}">
                                                                    {{ $appartment->appartment_name }}</option>
                                                            @endforeach --}}
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group text form">
                                                        <label for="" class="text">Intercom No</label>
                                                        <input type="text" name="intercome_no"
                                                            value="{{ old('intercome_no') }}" class="form-control text"
                                                            placeholder="Enter intercome_no">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group text form">
                                                        <label for="" class="text">land_phone </label>
                                                        <input type="text" name="land_phone"
                                                            value="{{ old('land_phone') }}" class="form-control text"
                                                            placeholder="Land Phone">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group text form">
                                                        <label for="" class="text">Mobile_phone</label>
                                                        <input type="text"name="mobile_phone"
                                                            value="{{ old('mobile_phone') }}" class="form-control text"
                                                            placeholder="Valid Phone number" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group text form">
                                                        <label for="" class="text">Email </label>
                                                        <input type="text" name="email" value="{{ old('email') }}"
                                                            class="form-control text" placeholder="Enter valid email"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group text form">
                                                        <label for="" class="text">NID/NRC </label>
                                                        <input type="text" name="nid_no" value="{{ old('nid_no') }}"
                                                            class="form-control text" placeholder="Enter NID number"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group text form">
                                                        <label for="" class="text">Car no</label>
                                                        <input type="text" name="car_no" value="{{ old('car_no') }}"
                                                            class="form-control text" placeholder="Enter car_no">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group text form">
                                                        <label for="" class="text">Garage no</label>
                                                        <input type="text" name="garage_no"
                                                            value="{{ old('garage_no') }}" class="form-control text"
                                                            placeholder="Enter garage_no">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group form">
                                                        <label for="" class="text">Occupation</label>
                                                        <input type="text" name="occupation"
                                                            value="{{ old('occupation') }}" class="form-control text"
                                                            placeholder="Enter occupation">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group text form">
                                                        <label for="" class="text">Designation</label>
                                                        <input type="text" name="designation"
                                                            value="{{ old('designation') }}" class="form-control text"
                                                            placeholder="Enter designation">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group text form">
                                                        <label for="" class="text">Institute Name</label>
                                                        <input type="text" name="institute_name"
                                                            value="{{ old('institute_name') }}" class="form-control text"
                                                            placeholder="Enter institute name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group form">
                                                        <label for="" class="text">Institute Addres</label>
                                                        <input type="text" name="institute_address"
                                                            value="{{ old('institute_address') }}"
                                                            class="form-control text"
                                                            placeholder="Enter institute address">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group text">
                                                        <label for="nid" class="text">NID/NRC <span
                                                                style="font-size:12px; color:#fb5200;">(Image)</span></label>
                                                        <input type="file" name="nid" class="form-control dropify"
                                                            data-height="100" required>
                                                        @error('nid')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group text">
                                                        <label for="image" class="text">Member Image</label>
                                                        <input type="file" name="image" class="form-control dropify"
                                                            data-height="100">
                                                        @error('image')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group text">
                                                        <label for="flat_reg_document" class="text">Flat Reg
                                                            Document</label>
                                                        <input type="file" name="flat_reg_document"
                                                            class="form-control dropify" data-height="100">
                                                        @error('flat_reg_document')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Family Member Section -->
                                            <div class="py-2">
                                                <h5 style="border-bottom: 1px solid #ddd; font-weight:bold"
                                                    class="text-center pb-2">Family Member Info</h5>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-5 col-md-5 col-sm-5">
                                                    <div class="form-group text">
                                                        <label for="family_member_name" class="text">Family Member
                                                            Name</label>
                                                        <input type="text" name="family_member_name"
                                                            id="family_member_name"
                                                            value="{{ old('family_member_name') }}" class="form-control"
                                                            placeholder="Enter Family Member Name">
                                                    </div>
                                                </div>
                                                <div class="col-lg-5 col-md-5 col-sm-5">
                                                    <div class="form-group text">
                                                        <label for="family_member_occupation" class="text">Family Member
                                                            Occupation</label>
                                                        <input type="text" id="family_member_occupation"
                                                            value="{{ old('family_member_occupation') }}"
                                                            name="family_member_occupation" class="form-control"
                                                            placeholder="Enter occupation">
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-md-2 col-sm-2">
                                                    <div class="form-group text mt-10">
                                                        <button type="button" class="btn btn-success add_family_member"
                                                            style="margin-top: 26px">Add</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 col-sm-6">
                                                    <div class="form-group text">
                                                        <label for="family_member_age" class="text">Family Member
                                                            Age</label>
                                                        <input type="text" value="{{ old('family_member_age') }}"
                                                            name="family_member_age" id="family_member_age"
                                                            class="form-control" placeholder="Enter Family Member Age">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-6">
                                                    <div class="form-group text">
                                                        <label for="family_member_relation" class="text">Family Member
                                                            Relation</label>
                                                        <input type="text" value="{{ old('family_member_relation') }}"
                                                            name="family_member_relation" id="family_member_relation"
                                                            class="form-control" placeholder="Enter Relation">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-6">
                                                    <div class="form-group text">
                                                        <label for="family_member_image" class="text">Family Member
                                                            Image</label>
                                                        <input type="file" name="family_member_image"
                                                            class="form-control dropify" id="family_member_image"
                                                            data-height="100">
                                                        @error('family_member_image')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="table-responsive" id="ftable">
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Occupation</th>
                                                            <th>Age</th>
                                                            <th>Relation</th>
                                                            <th>Image</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="familyMemberTable">
                                                        <!-- Family members will be added here -->
                                                    </tbody>
                                                </table>
                                            </div>
                                            <input type="submit" class="btn btn-primary" value="Submit">
                                        </form>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script>

        $(document).ready(function() {
            $('#ftable').hide();

            $('.add_family_member').click(function() {

                var name = $('#family_member_name').val();
                var occupation = $('#family_member_occupation').val();
                var age = $('#family_member_age').val();
                var relation = $('#family_member_relation').val();
                var image = $('#family_member_image').prop('files')[0];

                if (name && occupation && age && relation) {
                    $('#ftable').show();

                    var imgTag = image ?
                        `<img src="${URL.createObjectURL(image)}" width="50" height="50" />` :
                        'No Image';

                    $('#familyMemberTable').append(`
                <tr>
                    <td>${name}</td>
                    <td>${occupation}</td>
                    <td>${age}</td>
                    <td>${relation}</td>
                    <td>${imgTag}</td>
                </tr>
            `);

                    // Append hidden inputs to the form
                    var formData = new FormData();
                    formData.append('family_member_name[]', name);
                    formData.append('family_member_occupation[]', occupation);
                    formData.append('family_member_age[]', age);
                    formData.append('family_member_relation[]', relation);

                    if (image) {
                        formData.append('family_member_image[]', image);
                    }

                    $('#ftable').append(
                        $('<input>').attr('type', 'hidden').attr('name', 'family_member_name[]').val(
                            name),
                        $('<input>').attr('type', 'hidden').attr('name', 'family_member_occupation[]')
                        .val(occupation),
                        $('<input>').attr('type', 'hidden').attr('name', 'family_member_age[]').val(
                        age),
                        $('<input>').attr('type', 'hidden').attr('name', 'family_member_relation[]')
                        .val(relation)
                    );

                    if (image) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#ftable').append(
                                $('<input>').attr('type', 'hidden').attr('name',
                                    'family_member_image[]').val(e.target.result)
                            );
                        };
                        reader.readAsDataURL(image);
                    }

                    // Clear input fields
                    $('#family_member_name').val('');
                    $('#family_member_occupation').val('');
                    $('#family_member_age').val('');
                    $('#family_member_relation').val('');
                    $('#family_member_image').val('');

                    // Reset the Dropify instance
                    var drEvent = $('#family_member_image').dropify();
                    drEvent = drEvent.data('dropify');
                    drEvent.resetPreview();
                    drEvent.clearElement();
                }
            });

            $('#building_id').change(function() {
                var buildingId = $(this).val();
                $.ajax({
                    url: '/admin/get-appartments/' + buildingId,
                    type: 'GET',
                    success: function(data) {
                        console.log(data); // Add this line to check the response data
                        $('#appartment_id').html(
                            '<option value="" selected disabled>Select Appartment</option>'
                        );
                        $.each(data.appartments, function(index, appartment) {
                            $('#appartment_id').append('<option value="' + appartment
                                .id + '">' +
                                appartment.appartment_name + '</option>');
                        });
                    }
                });
            });
        });
    </script>
@endsection
