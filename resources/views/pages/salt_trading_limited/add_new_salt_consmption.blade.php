<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add New Import Salt</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
 
  <!-- <link href="{{asset('plugins/nepali-datepicker/nepali-datepicker.min.css')}}" rel="stylesheet" type="text/css" /> -->
  <link href="http://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/css/nepali.datepicker.v4.0.1.min.css" rel="stylesheet" type="text/css"/>
  <style type="text/css">
        .andp-datepicker-container{
          z-index: 988888888888 !important;
        }
        #ndp-nepali-box {
            z-index: 9999999 !important;
        }
        div#kt_datatable_length {
            float: left;
            margin-right: 15px;
        }
        .dt-buttons.btn-group.flex-wrap {
            float: left;
        }
       .title_md{
          font-size:16px !important;
          color:red !important;
        }
        .sub_title_md{
          font-size:14px !important;
          font-weight: 16px !important;
        }
    </style>
</head>
<body>

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-lg-6 col-md-8">
        <div class="card">
          <div class="card-header bg-primary text-white text-center">
            <h4>Salt Entry</h4>
          </div>
          <div class="card-body">
            <form class="form" id="kt_form" action="{{route('salt_trading_add','purchase')}}" method="post">
              {{csrf_field()}}
              <input type="hidden" name="data[0][id]" value="0">
              <div class="form-group">
                <label for="name" class="title_md">Date Pick *</label>
                <input name="data[0][date]" class="form-control form-control-solid sub_title_md" id="nepdatepicker_production" type="text" autocomplete="off" data-single="true" value="2079-11-11" required>
              </div>
           
              <div class="form-group">
                <label for="category" class="title_md">Select Category *</label>
                  {{Form::select('data[0][item_category_id]',$category,null,['class' => 'form-control select_category sub_title_md'])}}
              </div>
              <div class="form-group">
                <label for="item"  class="title_md">Select Item *</label>
                  {{Form::select('data[0][item_id]',$items,null,['class' => 'form-control select_item sub_title_md'])}}
              </div>
              <div class="form-group">
                <label for="quantity"  class="title_md">Quantity *</label>
                <input type="number" name="data[0][quantity]" class="form-control " required>
              </div>
              <div class="form-group">
                <label for="quantity"  class="title_md">Quantity *</label>
                <input type="text" value="Kg" class="form-control " disabled>
              </div>
             
              <div class="text-center">
                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


<script src="http://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/js/nepali.datepicker.v4.0.1.min.js" type="text/javascript"></script>
  <script type="text/javascript">
        $('#nepdatepicker_production').nepaliDatePicker(/*{
            language: "english",
            ndpYear: true,
            ndpMonth: true,
            ndpYearCount: 10
        }*/);
    </script>

    
  <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"></script> -->

  <script>
    $(".select_item").on("change", function (e) {
          var itemID = $(this).val();
          $.ajax({
              type: "GET",
              url: "{{route('getCategoryByItem')}}",
              data: {itemID: itemID},
              success: function (response) {

                  $(".select_category").val(response.catId);
              }
          });
      });
      $(".select_category").on("change", function (e) {
          var catId = $(this).val();
          ActionOnQuantityUnit(catId);
          $.ajax({
              type: "GET",
              url: "{{route('getItemByCategory')}}",
              data: {catId: catId},
              success: function (response) {
                  $(".select_item").find('option').remove().end().append(response.html);
              }
          });
      });
      function ActionOnQuantityUnit(catId){
      
        if(catId == 1){
            $("#quantity_unit_action_production").val(1);
        }
        else if (catId == 2){
            $("#quantity_unit_action_production").val(1);
        }
        else if(catId == 3){
            $("#quantity_unit_action_production").val(2);
        }
        else if(catId == 7){
            $("#quantity_unit_action_production").val(4);
        }
        else {
            $("#quantity_unit_action_production").val(1);
        }

      }
  </script>
   
</body>
</html>
