@extends('layout.frontpage')
@section('content')
    <div class="card card-custom">

        <div class="card-header  text-center" style="justify-content: space-around;">
            <div class="card-title">
            <span class="card-icon">
                <i class="flaticon2-delivery-package text-primary"></i>
            </span>
                <h3 class="card-label"> Introduction to ITSMIS</h3>
            </div>

        </div>
        <div class="card-body">

            <p>At a time when Nepal`s commodity and trade sector is import-oriented, farmer`s products have difficulty in accessing markets, and supply systems are affected during natural and man-made disasters, a management information system is necessary to make up for the lack of accurate data at the policy-making level and to meet the lack of real data on policy making.
            Industry, Commerce and Supply Sector Management Information System (ITSMIS) is a system that collects information on production, inventory, demand, import, export, financial           information and distributes final information to the policy making level in an integrated manner to provide the demand details of goods and services and the inventory details required to meet that demand
            </p>

            <div class="text-center">
                <a href="{{route('login')}}" class="btn btn-primary" >Please Login</a>

            </div>
        </div>
        <div class="card-header  text-center" style="justify-content: space-around;">
            <div class="card-title">
            <span class="card-icon">
                <i class="flaticon2-delivery-package text-primary"></i>
            </span>
                <h3 class="card-label  "> 	Purpose of ITSMIS</h3>
            </div>

        </div>
        <div class="card-body">

            <p>Purpose of ITSMIS
                The relevance of information management has increased under the federal system of governance.
                Hence, ITSMIS is to be established with following objectives:
                •	To provide the necessary information to the policy making level on a regular basis by obtaining preliminary data from various offices at the federal, state and local levels.
                •	The system will be responsible for informing the policy making level officials and agencies about the real situation and providing important information in implementable policy formulation.
                •	Industry, Commerce and Supply Management Information System (ITSMIS) is also required to control the tendency to disrupt the smooth and uninterrupted supply of goods and services and ensure the availability of essential goods and services at a fairly competitive and reasonable price without any hindrance.
                The Constitution of Nepal has ensured the security of every citizen from life threatening situation due to lack of food and provisioned the right of food sovereignty to every citizen  as per law. For realization of such constitutional provisions, it is essential for policy makers to know the relationship between producers, markets and consumers and the real time updates of the inventory of goods and services.
            </p>


        </div>





    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        var table = $('#kt_datatable');
        table.DataTable({responsive: true });
    </script>