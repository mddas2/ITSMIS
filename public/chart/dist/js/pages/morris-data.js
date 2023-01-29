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
Morris.Bar({
    element: 'morris-bar-chart',
    data: [{
        y: '2006',
        a: 100,
        b: 90,
        c: 60
    }, {
        y: '2007',
        a: 75,
        b: 65,
        c: 40
    }, {
        y: '2008',
        a: 50,
        b: 40,
        c: 30
    }, {
        y: '2009',
        a: 75,
        b: 65,
        c: 40
    }, {
        y: '2010',
        a: 50,
        b: 40,
        c: 30
    }, {
        y: '2011',
        a: 75,
        b: 65,
        c: 40
    }, {
        y: '2012',
        a: 100,
        b: 90,
        c: 40
    }],
    xkey: 'y',
    ykeys: ['a', 'b', 'c'],
    labels: ['Production', 'Consumption', 'Import/Export'],
    barColors:['#55ce63', '#2f3d4a', '#009efb'],
    hideHover: 'auto',
    gridLineColor: '#eef0f2',
    resize: true
});

Morris.Area({
        element: 'morris-area-chart',
        data: [{
            period: '2010',
            iphone: 50,
            ipad: 80,
            itouch: 20
        }, {
            period: '2011',
            iphone: 130,
            ipad: 100,
            itouch: 80
        }, {
            period: '2012',
            iphone: 80,
            ipad: 60,
            itouch: 70
        }, {
            period: '2013',
            iphone: 70,
            ipad: 200,
            itouch: 140
        }, {
            period: '2014',
            iphone: 180,
            ipad: 150,
            itouch: 140
        }, {
            period: '2015',
            iphone: 105,
            ipad: 100,
            itouch: 80
        },
         {
            period: '2016',
            iphone: 250,
            ipad: 150,
            itouch: 200
        }],
        xkey: 'period',
        ykeys: ['iphone', 'ipad', 'itouch'],
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