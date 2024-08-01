@extends('layouts.admin.master')

@section('content')
<style>
    ul li {
        list-style: none;
        font-size: 14px;
    }

    table,
    thead,
    tbody,
    tr,
    td {
        font-size: 14px;
    }

    @media screen and (max-width: 767px) {
        .label {
            font-size: 14px;
        }

        .text {
            font-size: 14px !important;
        }

        table,
        thead,
        tbody,
        tr,
        td {
            font-size: 14px;
        }
    }

    .text {
        font-size: 14px;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" />
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content mt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-primary p-1">
                            <h3 class="card-title">
                                <a href="{{ route('appartment.index') }}" class="btn btn-light shadow rounded m-0">
                                    <span>All Appartment</span>
                                </a>
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-11 col-md-11 col-sm-12 m-auto border p-4" style="background: #f3f2f2">
                                    <form action="{{ route('appartment.store') }}" method="POST">
                                        @csrf
                                        <div class="mt-3">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <label for="" class="text">Choose Building</label>
                                                    <select name="building_id" id="building_id" class="form-control" required>
                                                        <option value="" selected disabled>Select Building</option>
                                                        @foreach ($buildings as $building)
                                                        <option value="{{ $building->id }}">{{ $building->building_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <label for="" class="text">Choose Floor</label>
                                                    <select name="floor_id[]" id="floor_id" class="form-control text floor-select" required>
                                                        <option value="" selected disabled>Select Floor</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body table-responsive" id="table-container" style="display: none;">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Building</th>
                                                        <th>Floor</th>
                                                        <th>Appartment Name</th>
                                                        <th>Location</th>
                                                        <th>Add</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="rent-table-body">
                                                    <tr class="rent-row">
                                                        <td><input type="text" name="building_name[]" readonly></td>
                                                        <td><input type="text" name="floor_name[]" readonly></td>
                                                        <td><input type="text" name="appartment_name[]"></td>
                                                        <td><input type="text" name="location[]"></td>
                                                        <td>
                                                            <button type="button" class="btn btn-success btn-add text">Add</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div class="form-group mt-3" id="submit_btn" style="display: none;">
                                                <input type="submit" value="Submit" class="btn btn-primary">
                                            </div>
                                        </div>
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
        let selectedFloors = [];

        $('#building_id').change(function() {
            var buildingId = $(this).val();
            $.ajax({
                url: '/admin/get-floors/' + buildingId,
                type: 'GET',
                success: function(data) {
                    $('#floor_id').empty();
                    $('#floor_id').append('<option value="" selected disabled>Select Floor</option>');
                    $.each(data, function(index, floor) {
                        let disabled = selectedFloors.includes(floor.id) ? 'disabled' : '';
                        $('#floor_id').append('<option value="' + floor.id + '" ' + disabled + '>' + floor.building_floor + '</option>');
                    });
                }
            });
        });

        $('#floor_id').change(function() {
            var floorId = $(this).val();
            var floorName = $('#floor_id option:selected').text();
            selectedFloors.push(floorId);
            $(this).find('option[value="' + floorId + '"]').attr('disabled', 'disabled');

            var buildingName = $('#building_id option:selected').text();
            $('#table-container').show(); // Show the table container
            $('#submit_btn').show(); // Show the submit button

            var currentRow = $('.rent-row').last();
            currentRow.find('input[name="building_name[]"]').val(buildingName);
            currentRow.find('input[name="floor_name[]"]').val(floorName);
            currentRow.find('input[name="floor_id[]"]').val(floorId);
        });

        $(document).on('click', '.btn-add', function() {
            var newRow = `<tr class="rent-row">
                <td><input type="text" name="building_name[]" readonly></td>
                <td><input type="text" name="floor_name[]" readonly></td>
                <td><input type="text" name="appartment_name[]"></td>
                <td><input type="text" name="location[]"></td>
                <td>
                    <button type="button" class="btn btn-danger btn-remove text"><i class="fas fa-trash"></i></button>
                </td>
            </tr>`;
            $('#rent-table-body').append(newRow);
            disableSelectedFloors();
        });

        $(document).on('click', '.btn-remove', function() {
            let row = $(this).closest('tr');
            let removedFloor = row.find('input[name="floor_id[]"]').val();
            selectedFloors = selectedFloors.filter(floor => floor !== removedFloor);
            row.remove();
            disableSelectedFloors();
        });

        function disableSelectedFloors() {
            $('#floor_id option').each(function() {
                if (selectedFloors.includes($(this).val())) {
                    $(this).attr('disabled', 'disabled');
                } else {
                    $(this).removeAttr('disabled');
                }
            });
        }
    });
</script>
@endsection
