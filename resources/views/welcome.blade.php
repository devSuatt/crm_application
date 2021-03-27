@extends('layouts.layout')

@section("script")
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>

    <script>


        function fetch_data() {

            $.ajax({

                method: "post",
                url: "home/fetch",
                data:"",
                success:function(return_text){

                    data_obj = JSON.parse(return_text);

                    initializeChart('container','Number of Purchases',data_obj.order_count);
                    initializeChart('container2','Number of Products',data_obj.order_amount);
                    initializeChart('container3','Total Price',data_obj.order_price);


                }


            });

        }

        function fetch_product_rate() {

            $.ajax({

                method: "post",
                url: "home/fetch_product",
                data:"",
                success:function(return_text){

                    data_obj = JSON.parse(return_text);

                    initializeChart('container4','Number of Purchases Products',data_obj.product_count);

                }

            });

        }

        function presetChartOptions(){
            Highcharts.setOptions({
                colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
                    return {
                        radialGradient: {
                            cx: 0.5,
                            cy: 0.3,
                            r: 0.7
                        },
                        stops: [
                            [0, color],
                            [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
                        ]
                    };
                })
            });
        }
        function initializeChart(container,text, data){

            // Build the chart
            Highcharts.chart(container, {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: text
                },
                tooltip: {
                    pointFormat: '<b>{point.y}</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                            connectorColor: 'silver'
                        }
                    }
                },
                series: [{
                    name: 'Share',
                    data: data
                }]
            });
        }


        presetChartOptions();
        $(document).ready(function(){
            fetch_data();
            fetch_product_rate();
        });


    </script>
@endsection

@section("page_title")
    Home
@endsection

@section("head_title")
    Home
@endsection

@section("content")



    @if(Auth::user()->role == 1)

        <div id="container" style="width: 620px; height: 520px;
     max-width: 600px; margin: 0 auto; "></div>
        <br/><br/>

        <div id="container2" style="width: 620px; height: 520px;
     max-width: 600px; margin: 0 auto"></div>
        <br/><br/>
        <div id="container3" style="width: 620px; height: 520px;
     max-width: 600px; margin: 0 auto"></div>
        <br/><br/>
        <div id="container4" style="width: 620px; height: 520px;
     max-width: 600px; margin: 0 auto"></div>

    @else
        <?php
        echo "Müşteri girdi GİRDİ";
        ?>
    @endif



@endsection
