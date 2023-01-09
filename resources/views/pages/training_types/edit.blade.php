<div class="card card-custom">
    <div class="card-header">
        <h3 class="card-title">Edit Item Category</h3>
    </div>
    {{ Form::open(['route'=>['training_types.update',$training->id],'method'=>'Put', 'class'=>'form', 'id'=>'kt_form', 'enctype'=>'multipart/form-data']) }}
    {{csrf_field()}}
    <div class="card-body">

        <div class="form-group row">
            <div class="col-lg-6">
                <label>Training Type:</label>
                <input name="name" type="text" class="form-control form-control-solid" value="{{$training->name}}" required   />
            </div>
            <div class="col-lg-6">
                <label>Training Type(In Nepali):*</label>
                <input name="name_np" type="text" class="form-control form-control-solid" value="{{$training->name_np}}" required   />
            </div>

        </div>
        <div class="row">
            <div class="col-lg-12">
                <button type="submit" class="btn btn-primary mr-2">Save</button>
            </div>
        </div>
    </div>
    {{ Form::close() }}
</div>