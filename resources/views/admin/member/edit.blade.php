<div class="card">
    <div class="card-body p-5">
        <form action="{{ route('appartment.update') }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{$data->id}}">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="" class="form-label">Building</label>
                     <select name="building_id" id="" class="form-control" required>
                        <option value="" selected disabled>Select Building</option>
                        @foreach ($buildings as $building)
                            <option value="{{$building->id}}" @if ($building->id == $data->building_id) selected
                            @endif>{{$building->building_name}}</option>
                        @endforeach
                     </select>
                    </div>
                    <div class="form-group">
                        <label for="appartment_name" class="form-label">Appartment Name</label>
                        <input type="text" class="form-control"
                            value="{{$data->appartment_name }}" name="appartment_name" required>
                    </div>
                    <div class="form-group">
                        <label for="location" class="form-label">Appartment Location</label>
                        <input type="text" class="form-control"
                            value="{{ old('location') }}" name="location"
                            placeholder="Enter appartment location">
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Status</label>
                        <select name="status" class="form-control" id="">
                            <option value="1" @if ($data->status == 1) selected @endif>Active</option>
                            <option value="0" @if ($data->status == 0) selected @endif>Inactive</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="">
                <button type="submit" class="btn btn-sm btn-primary text">Submit</button>
            </div>
        </form>
    </div>
</div>
