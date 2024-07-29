<div class="card">
    <div class="card-body p-5">
        <form action="{{ route('building.update') }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{$data->id}}">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="building_name" class="form-label">Building Name</label>
                        <input type="text" class="form-control" value="{{ $data->building_name }}"
                            name="building_name" required>
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
