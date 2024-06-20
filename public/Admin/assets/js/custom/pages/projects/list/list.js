"use strict";

var KTProjectList = {
    init: function () {
        !(function () {
            var t = document.getElementById("kt_project_list_chart");
            if (t) {
                var e = t.getContext("2d");
                new Chart(e, {
                    type: "doughnut",
                    data: {
                        datasets: [
                            {
                                data: [shipped,confirmed, delivered],
                                backgroundColor: [
                                    "#00A3FF",
                                    "#50CD89",
                                    "#E4E6EF",
                                ],
                            },
                        ],
                        labels: ["Shipped", "Confirmed", "Delivered"],
                    },
                    options: {
                        chart: { fontFamily: "inherit" },
                        cutout: "75%",
                        cutoutPercentage: 65,
                        responsive: true,
                        maintainAspectRatio: false,
                        title: { display: false },
                        animation: { animateScale: true, animateRotate: true },
                        tooltips: {
                            enabled: true,
                            intersect: false,
                            mode: "nearest",
                            bodySpacing: 5,
                            yPadding: 10,
                            xPadding: 10,
                            caretPadding: 0,
                            displayColors: false,
                            backgroundColor: "#20D489",
                            titleFontColor: "#ffffff",
                            cornerRadius: 4,
                            footerSpacing: 0,
                            titleSpacing: 0,
                        },
                        plugins: { legend: { display: false } },
                    },
                });
            }
        })();
    },
};

KTUtil.onDOMContentLoaded(function () {
    KTProjectList.init();
});

