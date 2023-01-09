<div class="card card-custom" style="min-width: 80% !important;">
    <div class="card-header">
        <h3 class="card-title">Add Product</h3>
    </div>
    <form class="form" id="kt_form" action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="card-body">
            <div class="form-group row">
                <div class="col-lg-6">
                    <label>Title : </label>
                    <input name="title" type="text" class="form-control form-control-solid" placeholder="Enter Title" required autocomplete="off" />
                </div>
                <div class="col-lg-6">
                    <label>Item Cateogry :</label>
                    {{Form::select('item_category_id', $itemCategory, null,['class' => 'form-control form-control-solid','required'=>false])}}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-6">
                    <label>Item : </label>
                    {{Form::select('product_id', $item, null,['class' => 'form-control form-control-solid','required'=>false])}}
                </div>
                <div class="col-lg-3">
                    <label>Quantity Available:</label>
                    <input name="qty_available" type="text" class="form-control form-control-solid" placeholder="Quantity Available" required autocomplete="off" />
                </div>
                <div class="col-lg-3">
                    <label>Quantity Unit:</label>
                    {{Form::select('unit', $unit, null,['class' => 'form-control form-control-solid','required'=>false])}}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12">
                    <label>Description :</label>
                    <textarea class="form-control form-control-solid"></textarea>
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
<script type="text/javascript">

</script>