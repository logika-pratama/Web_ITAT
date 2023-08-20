<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<script>
$( document ).ready(function() {
    bulan = '<?=$this->uri->segment(4)?>';
    tahun = '<?=$this->uri->segment(5)?>';
    $('[name="tahun"]').val(tahun).change()
    $('[name="bulan"]').val(bulan).change()
    if(bulan == '' && tahun == ''){
        window.location.href = "<?=base_url()?><?=$this->uri->segment(1)?>/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>/<?=date('m')?>/<?=date('Y')?>";
    }
});

function searching(){
    bulan = $('[name="bulan"]').val();
    tahun = $('[name="tahun"]').val();
    window.location.href = "<?=base_url()?><?=$this->uri->segment(1)?>/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>/"+bulan+"/"+tahun;
}

const ctx = document.getElementById('gfd').getContext('2d');
const gfd = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
            <?php foreach($cabang as $c){ ?>
            '<?=$c['cabang']?>', 
            <?php } ?>
        ],
        datasets: [
        {
            label: 'Data Tahun ini',
            data: [
                <?php foreach($cabang as $c){ 
                    $this->db->select('SUM(jumlah_donasi) as total');
                    $this->db->where('id_cabang',$c['id_cabang']);
                    $this->db->where('YEAR(tanggal_donasi)',date('Y'));
                    $donasi = $this->db->get('donasi')->row_array();
                ?>
                <?=$donasi['total']?>, 
                <?php } ?>
            ],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)'

            ],
            borderColor: [
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)'
            ],
            borderWidth: 1
        },
        {
            label: 'Data Tahun lalu',
            data: [
                <?php foreach($cabang as $c){ 
                    $this->db->select('SUM(jumlah_donasi) as total');
                    $this->db->where('id_cabang',$c['id_cabang']);
                    $this->db->where('YEAR(tanggal_donasi)',date('Y') - 1);
                    $donasi = $this->db->get('donasi')->row_array();
                ?>
                <?=$donasi['total']?>, 
                <?php } ?>
            ],
            backgroundColor: [
                'rgba(153, 102, 255, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(153, 102, 255, 0.2)'
            ],
            borderColor: [
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)'
            ],
            borderWidth: 1
        }
    ]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});


const ctx2 = document.getElementById('da').getContext('2d');
const da = new Chart(ctx2, {
    type: 'pie',
    data: {
        labels: ['Aktif', 'Non-Aktif'],
        datasets: [{
            label: '# of Votes',
            data: [<?=$donatur_aktif?>, <?=$donatur_non_aktif?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

const ctx3 = document.getElementById('gfdt').getContext('2d');
const gfdt = new Chart(ctx3, {
    type: 'bar',
    data: {
        labels: [
            <?php foreach($cabang as $c){ ?>
            '<?=$c['cabang']?>', 
            <?php } ?>
        ],
        datasets: [{
            label: 'Data Bulan ini',
            data: [
                <?php foreach($cabang as $c){ 
                    $this->db->where('id_cabang',$c['id_cabang']);
                    $this->db->where('YEAR(tanggal_buat)',date('Y'));
                    $this->db->where('MONTH(tanggal_buat)',date('m'));
                    $donatur = $this->db->get('donatur')->num_rows();
                ?>
                <?=$donatur?>, 
                <?php } ?>
            ],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        },

        {
            label: 'Data Bulan lalu',
            data: [
                <?php foreach($cabang as $c){ 
                    $month = date('m', strtotime('-1 month', strtotime(date('Y-m-d'))));
                    $this->db->where('id_cabang',$c['id_cabang']);
                    $this->db->where('YEAR(tanggal_buat)',date('Y'));
                    $this->db->where('MONTH(tanggal_buat)',$month);
                    $donatur = $this->db->get('donatur')->num_rows();
                ?>
                <?=$donatur?>, 
                <?php } ?>
            ],
            backgroundColor: [
                'rgba(153, 102, 255, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(153, 102, 255, 0.2)'
            ],
            borderColor: [
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)'
            ],
            borderWidth: 1
        }
    ]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

const ctx4 = document.getElementById('kdr').getContext('2d');
const kdr = new Chart(ctx4, {
    type: 'pie',
    data: {
        labels: ['RUTIN', 'INSIDENTIL', 'TAMIA'],
        datasets: [{
            label: '# of Votes',
            data: [<?=$rutin?>, <?=$insidentil?>, <?=$tamia?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>