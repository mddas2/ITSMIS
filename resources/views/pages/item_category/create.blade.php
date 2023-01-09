<div class="card card-custom">
    <div class="card-header">
        <h3 class="card-title">Create New Item Category</h3>
    </div>
    <form class="form" id="kt_form" action="{{route('item_categories.store')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="card-body">

            <div class="form-group row">
                <div class="col-lg-6">
                    <label>Category Name:*</label>
                    <input name="name" type="text" class="form-control form-control-solid" placeholder="Enter Category Name" required autocomplete="off" />
                </div>
                <div class="col-lg-6">
                    <label>Category Name(In Nepali):*</label>
                    <input name="name_np" type="text" class="form-control form-control-solid" placeholder="Enter Category Name (In Nepali)" required autocomplete="off" />
                </div>

            </div>
            <div class="row">
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-primary mr-2">Save</button>
                    <button type="reset" class="btn btn-secondary mr-2">Reset</button>
                </div>
            </div>
        </div>
    </form>
</div>