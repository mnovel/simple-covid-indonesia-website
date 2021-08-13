$(document).ready(function () {
    // var url = 'https://covid.magerin.xyz'
    var url = 'http://localhost/covid'
    $('#kasus').DataTable({
        'ajax': url + '/api/?type=kasus',
        'columns': [{
                'data': 'Provinsi'
            },
            {
                'data': 'Provinsi'
            },
            {
                'data': 'Kasus_Semb'
            },
            {
                'data': 'Kasus_Posi'
            },
            {
                'data': 'Kasus_Meni'
            }
        ],
        "columnDefs": [{
            "targets": 0,
            "data": 0,
            "render": function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        }, {
            "targets": 2,
            "data": 2,
            "render": $.fn.dataTable.render.number('.', 3, )
        }, {
            "targets": 3,
            "data": 3,
            "render": $.fn.dataTable.render.number('.', 3, )
        }, {
            "targets": 4,
            "data": 4,
            "render": $.fn.dataTable.render.number('.', 3, )
        }]
    });
    $('#rs').DataTable({
        'ajax': url + '/api/?type=rs',
        'columns': [{
                'data': 'name'
            },
            {
                'data': 'name'
            },
            {
                'data': 'address'
            },
            {
                'data': 'region'
            },
            {
                'data': 'phone'
            },
            {
                'data': 'province'
            }
        ],
        "columnDefs": [{
            "targets": 0,
            "data": 0,
            "render": function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        }]
    });

    let mybutton = document.getElementById("btn-back-to-top");
    window.onscroll = function () {
        scrollFunction();
    };

    function scrollFunction() {
        if (
            document.body.scrollTop > 20 ||
            document.documentElement.scrollTop > 20
        ) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }

    mybutton.addEventListener("click", backToTop);

    function backToTop() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }

    $.getJSON('api?type=indonesia', function (data) {

        function formatRupiah(angka) {
            var number_string = angka.toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return rupiah;
        }

        var mounth = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ]

        var yy, mm, dd, h, m, s
        var d = new Date(data.data.lastUpdate)
        yy = d.getFullYear()
        mm = d.getMonth()
        dd = d.getDate()
        h = d.getHours()
        m = d.getMinutes()
        s = d.getSeconds()
        var date = dd + ' ' + mounth[mm] + ' ' + yy + ' ' + h + ':' + m + ':' + s + ' WIB'

        $('#sembuh').text(`Total: ${formatRupiah(data.data.sembuh)}`)
        $('#positif').text(`Total: ${formatRupiah(data.data.positif)}`)
        $('#meninggal').text(`Total: ${formatRupiah(data.data.meninggal)}`)
        $('#dirawat').text(`Total: ${formatRupiah(data.data.dirawat)}`)
        $('#lastUpdate').text(`Last Update: ` + date)
    })

    const data = {
        labels: 'a',
        datasets: [{
            label: 'Sembuh',
            backgroundColor: 'rgb(75, 192, 192)',
            borderColor: 'rgb(75, 192, 192)',
            data: 0,
        }, {
            label: 'Positif',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: 0,
        }, {
            label: 'Meninggal',
            backgroundColor: 'rgb(255, 205, 86)',
            borderColor: 'rgb(255, 205, 86)',
            data: 0,
        }]
    };

    const config = {
        type: 'line',
        data,
        options: {}
    };

    var myChart = new Chart(
        document.getElementById('myChart'),
        config
    );

    setInterval(function () {
        $.getJSON('api/?type=harian&limit=50', function (res) {
            myChart.data.labels = res.data.tanggal
            myChart.data.datasets[0].data = res.data.sembuh
            myChart.data.datasets[1].data = res.data.positif
            myChart.data.datasets[2].data = res.data.meninggal
            myChart.update()
            console.log('Data Update')
        })
    }, 1000)

});