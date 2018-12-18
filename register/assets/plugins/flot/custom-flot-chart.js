    var $tenure = $("#tenure").val();
    
    $("#tenure").on("change", function(){
        $tenure = $(this).val();
        printGraph();
    });
    var metro = {
        showTooltip: function (x, y, contents) {
            $('<div class="metro_tips">' + contents + '</div>').css( {
                position: 'absolute',
                display: 'none',
                top: y + 5,
                left: x + 5
            }).appendTo("body").fadeIn(200);
        }


    }

    function showTooltip(x, y, contents) {
        $('<div id="tooltip">' + contents + '</div>').css({
            top: y + 5,
            left: x + 5,
        }).appendTo("body").fadeIn(200)/*.fadeOut(6000)*/;
    }

    function printGraph(){
        var graphData = $graph['data'][$tenure]['navData'];
        //graphData = graphData.replace('"', '');

        if($graph['data'][$tenure]['hurdleData'] == ""){
            var dataset = [
                {label: $graph['product_name'], data: $graph['data'][$tenure]['navData'], color: "#10bdd0"}
            ];
        }else{
            var dataset = [
                {label: $graph['product_name'], data: $graph['data'][$tenure]['navData'], color: "#10bdd0"},
                {label: "Benchmark", data: $graph['data'][$tenure]['hurdleData'], color: "#fc6e41"}
            ];

        }
        var graphDataset = dataset;
        var options = {
            series: {
                stack: true,
                lines: {
                    show: true,
                    lineWidth: 2,
                    fill: false
                },
                points: {show: true},
                shadowSize: 2
            },
            grid: {
                hoverable: true,
                show: true,
                borderWidth: 0,
                labelMargin: 12
            },
            legend: {
                show: true,
                margin: [0, -24],
                noColumns: 0,
                labelBoxBorderColor: null
            },
            yaxis: {min: $graph['data'][$tenure]['minValue'], max: $graph['data'][$tenure]['maxValue'],tickFormatter: function numberWithCommas(x) {
                return x.toString().replace(/\B(?=(?:\d{3})+(?!\d))/g, ",");
            }},
            xaxis: {
                mode: "time",
            }
        };
        var graphOptions = options;
        plot = $.plot($(".plots"), dataset, options);
        var previousPoint = null;
        $(".plots").bind("plothover", function (event, pos, item) {
            if (item) {
                $("#tooltip").remove();
                var hoverSeries = item.series;
                var x = item.datapoint[0],
                    y = item.datapoint[1];

                var ts = new Date(x);

                var strTip = "<b>" + ts.toDateString() + "</b>";
                strTip += "<table border='0' cellpadding='5'>";

                if(item.series.label != "Benchmark"){
                    strTip += "<tr><td><div style='background-color: "+ item.series.color +";'></div></td><td>" + item.series.label + "</td> <td><b>" + parseFloat(y).toFixed(2) + "</b></td></tr>";
                }

                var allSeries = plot.getData();
                $.each(allSeries, function(i,s){
                    if (s == hoverSeries) return;
                    $.each(s.data, function(j,p){
                        if (p[0] == x){
                            strTip += "<tr><td><div style='background-color: "+ s.color +";'></div></td><td>" + s.label + "</td> <td><b>" + parseFloat(p[1]).toFixed(2) + "</b></td></tr>";
                        }
                    });
                });

                if(item.series.label == "Benchmark"){
                    strTip += "<tr><td><div style='background-color: "+ item.series.color +";'></div></td><td>" + item.series.label + "</td> <td><b>" + parseFloat(y).toFixed(2) + "</b></td></tr>";
                }

                strTip += "</table>";
                console.log(strTip);
                showTooltip(item.pageX, item.pageY, strTip);
            }
            /*if (item) {
                if (previousPoint != item.dataIndex) {
                    $(".metro_tips").hide();
                    previousPoint = item.dataIndex;
                    $(".charts_tooltip").fadeOut("fast").promise().done(function(){
                        $(this).remove();
                    });
                    var x = item.datapoint[0].toFixed(2),
                        y = item.datapoint[1].toFixed(2);
                    metro.showTooltip(item.pageX, item.pageY, item.series.label + " value: " +  y);
                }
            }
            else {
                $(".metro_tips").fadeOut("fast").promise().done(function(){
                    $(this).remove();
                });
                previousPoint = null;
            }*/

        });


    }

    printGraph();








/*$(window).load(function() {
    console.log('test');
    $.ajax({
        url: base_url + "baskets/performance",
        dataType: "json",
        beforeSend: function validator() {
            $("#overlay").show();
            //return $("#riskProfiler").valid();
        },
        success: function (data) {
            var metro = {
                showTooltip: function (x, y, contents) {
                    $('<div class="metro_tips">' + contents + '</div>').css( {
                        position: 'absolute',
                        display: 'none',
                        top: y + 5,
                        left: x + 5
                    }).appendTo("body").fadeIn(200);
                }
            }

            $("#overlay").hide();

            if (data['status'] == "true" || data['status'] == true) {
                var graphData = data['graphData'];
                console.log(graphData);
                //graphData = graphData.replace('"', '');

                if(data['hurdleDataArray'] == ""){
                    var dataset = [
                        {label: data['product_name'], data: data['graphData'], color: "#10bdd0"}
                    ];
                }else{
                    var dataset = [
                        {label: data['product_name'], data: data['graphData'], color: "#10bdd0"},
                        {label: "Benchmark ", data: data['hurdleData'], color: "#fc6e41"}
                    ];

                }
                var graphDataset = dataset;
                console.log(dataset);
                var options = {
                    series: {
                        stack: true,
                        lines: {
                            show: true,
                            lineWidth: 2,
                            fill: false
                        },
                        points: {show: true},
                        shadowSize: 2
                    },
                    grid: {
                        hoverable: true,
                        show: true,
                        borderWidth: 0,
                        labelMargin: 12
                    },
                    legend: {
                        show: true,
                        margin: [0, -24],
                        noColumns: 0,
                        labelBoxBorderColor: null
                    },
                    yaxis: {min: data['minValue'], max: data['maxValue'],tickFormatter: function numberWithCommas(x) {
                        return x.toString().replace(/\B(?=(?:\d{3})+(?!\d))/g, ",");
                    }},
                    xaxis: {
                        mode: "time",
                    }
                };
                var graphOptions = options;
                $.plot($(".plots"), dataset, options);
                var previousPoint = null;
                $(".plots").bind("plothover", function (event, pos, item) {
                    if (item) {
                        if (previousPoint != item.dataIndex) {
                            $(".metro_tips").hide();
                            previousPoint = item.dataIndex;
                            $(".charts_tooltip").fadeOut("fast").promise().done(function(){
                                $(this).remove();
                            });
                            var x = item.datapoint[0].toFixed(2),
                                y = item.datapoint[1].toFixed(2);
                            metro.showTooltip(item.pageX, item.pageY, item.series.label + " value: " +  y);
                        }
                    }
                    else {
                        $(".metro_tips").fadeOut("fast").promise().done(function(){
                            $(this).remove();
                        });
                        previousPoint = null;
                    }
                });
                $('#overlay').hide();
            }
            if(data['message']){
                alert(data['message']);
                //lobibox(data['msgType'], data['message']);
            }
        },
        dataType: 'json'
    });
});*/

