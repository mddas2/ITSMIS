<div class="card card-custom">
    <div class="card-header">
        <h3 class="card-title">Edit Item</h3>
    </div>
        {{ Form::open(['route'=>['items.update',$item->id],'method'=>'Put', 'class'=>'form', 'id'=>'kt_form', 'enctype'=>'multipart/form-data']) }}
        {{csrf_field()}}
        <div class="card-body">
            <div class="form-group row">
                <div class="col-lg-12">
                    <label>Item Category:</label>
                    {{Form::select('item_category_id', $categories, $item->item_category_id,['class' => 'form-control form-control-solid','required'=>false])}}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-6">
                    <label>Name:*</label>
                    <input name="name" type="text" class="form-control form-control-solid" placeholder="Enter Name" value="{{$item->name}}" required autocomplete="off" />
                </div>
                <div class="col-lg-6">
                    <label>Name (In Nepali):*</label>
                    <input name="name_np" type="text" class="form-control form-control-solid" placeholder="Enter (In Nepali)" value="{{$item->name_np}}"   required autocomplete="off" />
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-primary mr-2">Save</button>
                    <button type="reset" class="btn btn-secondary mr-2">Reset</button>
                </div>
            </div>
        </div>
    {{ Form::close() }}
</div>