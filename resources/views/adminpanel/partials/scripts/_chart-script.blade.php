<script>
    /*
    * This Function for draw charts
    */
    var drawAmChartsPie = function(_cart_id, _data){
        if (!KTUtil.getByID(_cart_id)) {
            return;
        }

        AmCharts.makeChart(_cart_id,{
            type: "pie",
            theme: "light",
            dataProvider: _data,
            titleField: "name",
            valueField: "count",
            balloon: {
                fixedPosition: false
            }
        });
    }

    AmCharts.addInitHandler(function (chart) {
        if (chart.dataProvider == undefined || chart.dataProvider.length == 0) {
            for (let index = 0; index <= 2; index++) {
                var db = {};
                db[chart.titleField] = "";
                db[chart.valueField] = 1;
                chart.dataProvider.push(db);
            }
        }
        if (chart.dataProvider[0]["name"] == "" && chart.dataProvider[1]["name"] == "") {
            chart.balloonText = "";
            chart.labelsEnabled = false;
            chart.addLabel("50%", "50%", "No Data To Show", "middle", 20);
            chart.alpha = 0.3;
        }
    });
</script>
