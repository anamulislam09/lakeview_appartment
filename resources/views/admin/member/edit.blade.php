<style>
    .text {
        font-size: 14px;
    }
</style>

<div class="card">
    <div class="card-body">
        <form action="{{ route('member.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $data->id }}">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group text form">
                        <label for="" class="text">Member Name </label>
                        <input type="text" name="member_name" value="{{ $data->member_name }}"
                            class="form-control text" placeholder="Member name" required>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group text form">
                        <label for="" class="text">Guardian Name </label>
                        <input type="text" name="guardian_name" value="{{ $data->guardian_name }}"
                            class="form-control text" placeholder="Enter guardian name" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group text form">
                        <label for="" class="text">Mother Name</label>
                        <input type="text" name="mother_name" value="{{ $data->mother_name }}"
                            class="form-control text" placeholder="Enter mother name" required>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group text form">
                        <label for="" class="text">Permanent Address </label>
                        <input type="text" name="permanent_address" value="{{ $data->permanent_address }}"
                            class="form-control text" placeholder="Enter permanent address" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group text form">
                        <label for="" class="text">Nationality</label>
                        <select name="nationality" id="" class="form-control" required>
                            <option value="Bangladeshi" @if ($data->nationality == 'Bangladeshi') selected @endif>Bangladeshi
                            </option>
                            <option value="Indian" @if ($data->nationality == 'Indian') selected @endif>Indian</option>
                            <option value="Pakistani" @if ($data->nationality == 'Pakistani') selected @endif>Pakistani
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group text form">
                        <label for="" class="text">Religion </label>
                        <input type="text" name="religion" value="{{ $data->religion }}" class="form-control text"
                            placeholder="Enter permanent address" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group form">
                        <label for="" class="text">Date of Dirth</label>
                        <input type="date" value="{{ $data->date_of_birth }}" name="date_of_birth"
                            class="form-control text" placeholder="Enter date_of_birth" required>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group text form">
                        <label for="" class="text"> Building</label>
                        <input type="text" value="{{ $building }}" name="building_id" class="form-control text"
                            readonly>
                        {{-- <select name="building_id" id="building_id" class="form-control" required>
                            <option value="" selected disabled>Select Building
                            </option>
                            @foreach ($buildings as $building)
                                <option value="{{ $building->id }}"
                                    @if ($building->id == $data->building_id) selected>{{ $building->building_name }} @endif</option>
                            @endforeach
                        </select> --}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group text form">
                        <label for="" class="text">Appartment </label>
                        <input type="text" value="{{ $appartment }}" name="appartment_id" class="form-control text"
                            readonly>
                        {{-- <select name="appartment_id" id="appartment_id"
                            class="form-control text" required>
                            <option value="" selected disabled>Select Apportment
                            </option>
                            @foreach ($appartments as $appartment)
                                <option value="{{ $appartment->id }}">
                                    {{ $appartment->appartment_name }}</option>
                            @endforeach
                        </select> --}}
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group text form">
                        <label for="" class="text">Intercom No</label>
                        <input type="text" name="intercome_no" value="{{ $data->intercome_no }}"
                            class="form-control text" placeholder="Enter intercome_no">
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group text form">
                        <label for="" class="text">land_phone </label>
                        <input type="text" name="land_phone" value="{{ $data->land_phone }}"
                            class="form-control text" placeholder="Land Phone">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group text form">
                        <label for="" class="text">Mobile_phone</label>
                        <input type="text"name="mobile_phone" value="{{ $data->mobile_phone }}"
                            class="form-control text" placeholder="Valid Phone number" required>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group text form">
                        <label for="" class="text">Email </label>
                        <input type="text" name="email" value="{{ $data->email }}" class="form-control text"
                            placeholder="Enter valid email" required>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group text form">
                        <label for="" class="text">NID/NRC </label>
                        <input type="text" name="nid_no" value="{{ $data->nid_no }}" class="form-control text"
                            placeholder="Enter NID number" required>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group text form">
                        <label for="" class="text">Car no</label>
                        <input type="text" name="car_no" value="{{ $data->car_no }}" class="form-control text"
                            placeholder="Enter car_no">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group text form">
                        <label for="" class="text">Garage no</label>
                        <input type="text" name="garage_no" value="{{ $data->garage_no }}"
                            class="form-control text" placeholder="Enter garage_no">
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group form">
                        <label for="" class="text">Occupation</label>
                        <input type="text" name="occupation" value="{{ $data->occupation }}"
                            class="form-control text" placeholder="Enter occupation">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group text form">
                        <label for="" class="text">Designation</label>
                        <input type="text" name="designation" value="{{ $data->designation }}"
                            class="form-control text" placeholder="Enter designation">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group text form">
                        <label for="" class="text">Institute Name</label>
                        <input type="text" name="institute_name" value="{{ $data->institute_name }}"
                            class="form-control text" placeholder="Enter institute name">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group form">
                        <label for="" class="text">Institute Addres</label>
                        <input type="text" name="institute_address" value="{{ $data->institute_address }}"
                            class="form-control text" placeholder="Enter institute address">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group text">
                        <label for="nid" class="text">NID/NRC <span
                                style="font-size:12px; color:#fb5200;">(Image)</span></label>
                        <input type="file" name="nid" class="form-control dropify" data-height="100">
                        <img src="{{ asset($data->nid) }}" style="width: 50px" alt="nid Image">
                        @error('nid')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group text">
                        <label for="image" class="text">Member Image</label>
                        <input type="file" name="image" class="form-control dropify" data-height="100">
                        <img src="{{ asset($data->image) }}" style="width: 50px" alt="image Image">
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group text">
                        <label for="flat_reg_document" class="text">Flat Reg
                            Document</label>
                        <input type="file" name="flat_reg_document" class="form-control dropify"
                            data-height="100">
                        <img src="{{ asset($data->flat_reg_document) }}" style="width: 50px"
                            alt="flat_reg_document ">
                        @error('flat_reg_document')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group">
                        <label for="" class="form-label">Status</label>
                        <select name="status" class="form-control" id="">
                            <option value="1" @if ($data->status == 1) selected @endif>
                                Active</option>
                            <option value="0" @if ($data->status == 0) selected @endif>Inactive
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="py-2">
                <h5 style="border-bottom: 1px solid #ddd; font-weight:bold" class="text-center pb-2 text">Family
                    Member
                    Info</h5>
            </div>
            @foreach ($fmembers as $fmember)
            <input type="hidden" name="member_id[]" value="{{ $fmember->member_id }}">
            <input type="hidden" name="family_member_id[]" value="{{ $fmember->id }}">
                <div class="row">
                    <div class="col-lg-2 col-md- col-sm-6">
                        <div class="form-group text">
                            <label for="image" class="text">Name</label>
                            <input type="text" name="family_member_name[]"
                                value="{{ $fmember->family_member_name }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-6">
                        <div class="form-group text">
                            <label for="family_member_occupation" class="text"> Occupation</label>
                            <input type="text" value="{{ $fmember->family_member_occupation }}"
                                name="family_member_occupation[]" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-6">
                        <div class="form-group text">
                            <label for="image" class="text">Age</label>
                            <input type="text" value="{{ $fmember->family_member_age }}" name="family_member_age[]"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-6">
                        <div class="form-group text">
                            <label for="family_member_relation" class="text">Relation</label>
                            <input type="text" value="{{ $fmember->family_member_relation }}"
                                name="family_member_relation[]" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-6"">
                                <div class="form-group text">
                                    <label for="family_member_image" class="text">Image</label>
                                    <input type="file" name="family_member_image[]" class="form-control dropify"
                                        data-height="100">
                                    @error('family_member_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6"">
                                <img src="{{ asset($fmember->family_member_image) }}" style="width: 50px"
                                alt="Image ">
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <input type="submit" class="btn btn-primary" value="Submit">
        </form>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script>
    $('#building_id').change(function() {
        var buildingId = $(this).val();
        $.ajax({
            url: '/admin/get-appartment/' + buildingId,
            type: 'GET',
            success: function(data) {
                $('#appartment_id').html(
                    '<option value="" selected disabled>Select Appartment</option>');
                $.each(data, function(index, appartments) {
                    $('#appartment_id').append('<option value="' + appartments.id + '">' +
                        appartments.appartment_name + '</option>');
                });
            }
        });
    });
</script>
