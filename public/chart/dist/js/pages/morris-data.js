// Dashboard 1 Morris-chart
$(function () {
    "use strict";
 // Morris donut chart
        
//  Morris.Donut({
//     element: 'morris-donut-chart',
//     data: [ {
//         label: "Production",
//         value: 3000
//     }, {
//         label: "Consumption",
//         value: 2000
//     }],
//     resize: true,
//     colors:['#55ce63', '#2f3d4a']
// });

// Morris.Donut({
//     element: 'morris-donut-chart',
//     data: [{
//         label: "positive",
//         value: 100,

//     }, {
//         label: "Production",
//         value: 3000
//     }, {
//         label: "Consumption",
//         value: 2000
//     }],
//     resize: true,
//     colors:['#009efb', '#55ce63', '#2f3d4a']
// });

// Morris bar chartd

$.ajax({
    url: yearly_url ,
    type: "GET",
    data: {'item_id':ajax_production_item_fetch_id,'year':ajax_production_year},
    success: function(data) {
        console.log(data)
        Morris.Bar({
            element: 'morris-bar-chart',
            data: data,
            xkey: 'y',
            ykeys: ['a', 'b', 'c'],
            labels: ['Production', 'Consumption', 'Import/Export'],
            barColors:['#55ce63', '#2f3d4a', '#009efb'],
            hideHover: 'auto',
            gridLineColor: '#eef0f2',
            resize: true
        });
    }
});

$.ajax({
    url: line_chart ,
    type: "GET",
    data: {'item_id':ajax_production_item_fetch_id,'year':ajax_production_year},
    success: function(data) {
        Morris.Area({
            element: 'morris-area-chart',
            data: data,
            xkey: 'period',
            ykeys: ['Production', 'Consumption', 'import','export'],
            labels: ['Production', 'Consumption','Import','Export'],
            pointSize: 3,
            fillOpacity: 0,
            pointStrokeColors:['#55ce63', '#009efb', '#2f3d4a','#2f2d9a','#2f1d6a'],
            behaveLikeLine: true,
            gridLineColor: '#e0e0e0',
            lineWidth: 3,
            hideHover: 'auto',
            lineColors: ['#55ce63', '#009efb', '#2f3d4a','#2f2d9a','#2f1d6a'],
            resize: true
            
        });
    }
});


 }); 

