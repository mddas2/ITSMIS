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

// Morris bar chart

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



Morris.Area({
        element: 'morris-area-chart',
        data: [{
            period: '2010',
            Production: 50,
            Consumption: 80,
            import_export: 20
        }, {
            period: '2011',
            Production: 130,
            Consumption: 100,
            import_export: 80
        }, {
            period: '2012',
            Production: 80,
            Consumption: 60,
            import_export: 70
        }, {
            period: '2013',
            Production: 70,
            Consumption: 200,
            import_export: 140
        }, {
            period: '2014',
            Production: 180,
            Consumption: 150,
            import_export: 140
        }, {
            period: '2015',
            Production: 105,
            Consumption: 100,
            import_export: 80
        },
         {
            period: '2016',
            Production: 250,
            Consumption: 150,
            import_export: 200
        }],
        xkey: 'period',
        ykeys: ['Production', 'Consumption', 'import_export'],
        labels: ['Production', 'Consumption','Import/Export'],
        pointSize: 3,
        fillOpacity: 0,
        pointStrokeColors:['#55ce63', '#009efb', '#2f3d4a'],
        behaveLikeLine: true,
        gridLineColor: '#e0e0e0',
        lineWidth: 3,
        hideHover: 'auto',
        lineColors: ['#55ce63', '#009efb', '#2f3d4a'],
        resize: true
        
    });
 });    