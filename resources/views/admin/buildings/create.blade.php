@extends('layouts.admin.master')

@section('content')
    <style>
        ul li {
            list-style: none;
            font-size: 14px;
        }

        @media screen and (max-width: 767px) {
            .label {
                font-size: 14px;
            }

            .text {
                font-size: 14px !important;
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
                                    <a href="{{ route('building.index') }}"class="btn btn-light shadow rounded m-0"><span>All Building</span></a>
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <!-- /.card-header -->
                                <div class="row ">
                                    <div class="col-lg-8 col-md-8 col-sm-12 m-auto border p-4"
                                        style="background: #f3f2f2">
                                        <form action="{{ route('building.store') }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-10">
                                                    <div class="form-group">
                                                        <label for="building_name" class="form-label">Building Name</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ old('building_name') }}" name="building_name"
                                                            placeholder="Enter Building Name" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="">
                                                <button type="submit" class="btn btn-sm btn-primary text">Submit</button>
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
@endsection
