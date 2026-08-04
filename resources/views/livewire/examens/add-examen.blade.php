<div>
   
                    <div class="modal-body">
          <form {{-- action="{{ url('add_new_exam')}}"  --}}  wire:submit="create"class="database_operation"{{--  method="POST" --}}>  
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">Enter title</label>
                            {{ csrf_field()}}
                            <input type="text" required="required" name="title" placeholder="Enter title" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">Enter Date</label>
                            <input type="date" required="required" name="exam_date"  class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                          <label for="">Enter duration (in minutes)</label>
                          <input type="text" required="required" name="exam_duration"  class="form-control">
                      </div>
                  </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">Select category</label>
                            <select class="form-control" required="required" name="exam_category">
                                <option value="">Select</option>
                                @foreach ($category as $cat)
                                <option value="{{ $cat['id']}}">{{ $cat['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                        <div class="col-sm-12 mb-3">
                            <label for="formation_id">Select Formation</label>
                            <select class="form-control" required='required' name="formation_id">
                                <option value="">Select</option>
                                @foreach ($formation as $cat)
                                    <option    value="{{ $cat->id }}">{{ $cat->titre }}</option>
                                @endforeach
                            </select>
                        </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <button class="btn btn-primary">Add</button>
                        </div>
                    </div>
                </div>
            </form>
      </div>

</div>
