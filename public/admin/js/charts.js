var options = function(type, height, numbers, color) {
    return {
        chart: {
            height: height,
            width: "100%",
            type: type,
            sparkline: {
                enabled: true
            },
            toolbar: {
                show: false
            }
        },
        grid: {
            show: false,
            padding: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0
            }
        },
        dataLabels: {
            enabled: false
        },
        legend: {
            show: false
        },
        series: [
            {
                name: "serie1",
                data: numbers
            }
        ],
        fill: {
            colors: [color]
        },
        stroke: {
            colors: [color],
            width: 3
        },
        yaxis: {
            show: false
        },
        xaxis: {
            show: false,
            labels: {
                show: false
            },
            axisBorder: {
                show: false
            },
            tooltip: {
                enabled: false
            }
        }
    };
};

var analytics_1 = document.getElementsByClassName("analytics_1");

if (analytics_1 != null && typeof analytics_1 != "undefined") {
    var chart = new ApexCharts(
        analytics_1[0],
        options("area", "51px", numArr(10, 99), "#4fd1c5")
    );
    var chart_1 = new ApexCharts(
        analytics_1[1],
        options("area", "51px", numArr(10, 99), "#4c51bf")
    );
    chart.render();
    chart_1.render();
}

var sealsOptions = {
    chart: {
        height: 350,
        type: "line",
        stacked: false
    },
    dataLabels: {
        enabled: false
    },
    colors: ["#99C2A2", "#C5EDAC", "#66C7F4"],
    series: [
        {
            name: "Column A",
            type: "column",
            data: [21.1, 23, 33.1, 34, 44.1, 44.9, 56.5, 58.5]
        },
        {
            name: "Column B",
            type: "column",
            data: [10, 19, 27, 26, 34, 35, 40, 38]
        },
        {
            name: "Line C",
            type: "column",
            data: [1.4, 2, 2.5, 1.5, 2.5, 2.8, 3.8, 4.6]
        }
    ],
    stroke: {
        width: [4, 4, 4]
    },
    plotOptions: {
        bar: {
            columnWidth: "20%"
        }
    },
    xaxis: {
        categories: [2009, 2010, 2011, 2012, 2013, 2014, 2015, 2016]
    },
    yaxis: [
        {
            seriesName: "Column A",
            axisTicks: {
                show: true
            },
            axisBorder: {
                show: true
            },
            title: {
                text: "Columns"
            }
        },
        {
            seriesName: "Column A",
            show: false
        },
        {
            opposite: true,
            seriesName: "Line C",
            axisTicks: {
                show: true
            },
            axisBorder: {
                show: true
            },
            title: {
                text: "Line"
            }
        }
    ],
    tooltip: {
        shared: false,
        intersect: true,
        x: {
            show: false
        }
    },
    legend: {
        horizontalAlign: "left",
        offsetX: 40
    }
};

var sealsOverview = document.getElementById("sealsOverview");
var sealsOverviewChart = new ApexCharts(
    sealsOverview,
    options("bar", "100%", numArr(20, 999), "#30aba0")
);
sealsOverviewChart.render();
var options = {
    chart: {
        //   height: 280,
        width: "100%",
        type: "area",
        toolbar: {
            show: false
        }
    },
    grid: {
        show: false,
        padding: {
            top: 0,
            right: 0,
            bottom: 0,
            left: 0
        }
    },
    dataLabels: {
        enabled: false
    },
    legend: {
        show: false
    },
    series: [
        {
            name: "serie1",
            data: [44, 55, 41, 67, 22, 43, 21, 41, 56, 27, 43]
        },
        {
            name: "serie2",
            data: [54, 45, 51, 57, 32, 33, 31, 31, 46, 37, 33]
        }
    ],
    fill: {
        type: "gradient",
        gradient: {
            shadeIntensity: 1,
            opacityFrom: 0.9,
            opacityTo: 0.7,
            stops: [0, 90, 100]
        },
        colors: ["#4fd1c5"]
    },
    stroke: {
        colors: ["#4fd1c5"],
        width: 3
    },
    yaxis: {
        show: false
    },
    xaxis: {
        categories: [1, 2, 3, 4, 5, 6, 6, 7, 8, 9, 10],
        labels: {
            show: false
        },
        axisBorder: {
            show: false
        },
        tooltip: {
            enabled: false
        }
    }
};

var SummaryChart = document.getElementById("SummaryChart");

if (SummaryChart != null && typeof SummaryChart != "undefined") {
    var chart = new ApexCharts(
        document.querySelector("#SummaryChart"),
        options
    );
    chart.render();
}
