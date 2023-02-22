<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Bootstrap Form</title>
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
        }`
    </style>
</head>
<body>

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-lg-6 col-md-8">
        <div class="card">
          <div class="card-header bg-primary text-white text-center">
            <h4>Local Level Entry</h4>
          </div>
          <div class="card-body">
            <form>
              <div class="form-group">
                <label for="name">Date Pick</label>
                <input name="from_date" class="form-control form-control-solid" id="nepdatepicker_production" type="text" autocomplete="off" data-single="true" value="2079-11-11" required>
              </div>
           
              <div class="form-group">
                <label for="category">Select Category</label>
                  {{Form::select('data[item_category_id]',$category,null,['class' => 'form-control select_category'])}}
              </div>
              <div class="form-group">
                <label for="item">Select Item</label>
                  {{Form::select('data[item_id]',$items,null,['class' => 'form-control select_item'])}}
              </div>
              <div class="form-group">
                <label for="unit">Select Unit</label>
                  {{Form::select('data[quantity_unit]',$units,null,['class' => 'form-control' , 'id' => 'quantity_unit_action'])}}
              </div>
              <div class="form-group">
                <label for="location"> Location </label>

                    @if(auth()->user()->role_id == 2)
                      <input type="text" value="{{session('municipality_name') ?? Auth::user()->getUserMunicipality->alt_name}}" disabled>
                    @else
                      <input type="text" value="{{Auth::user()->getUserMunicipality->alt_name}}" disabled>
                    @endif
                
                  
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

   
</body>
</html>
