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
                <input name="from_date" class="form-control form-control-solid" id="nepdatepicker_production"  data-single="true" value="2079-11-11" required>
              </div>
           
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" placeholder="Enter your name">
              </div>
              <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Password">
              </div>
              <div class="form-group">
                <label for="confirm-password">Confirm Password</label>
                <input type="password" class="form-control" id="confirm-password" placeholder="Confirm Password">
              </div>
              <div class="form-group">
                <label for="gender">Gender</label>
                <select class="form-control" id="gender">
                  <option>Select Gender</option>
                  <option>Male</option>
                  <option>Female</option>
                  <option>Other</option>
                </select>
              </div>
              <div class="form-group">
                <label for="message">Message</label>
                <textarea class="form-control" id="message" rows="3" placeholder="Enter your message"></textarea>
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
