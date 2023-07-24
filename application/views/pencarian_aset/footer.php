
<script src="<?=base_url()?>assets/vendor/libs/jquery/jquery.js"></script>
<script src="<?=base_url()?>assets/vendor/libs/popper/popper.js"></script>
<script src="<?=base_url()?>assets/vendor/js/bootstrap.js"></script>
<script src="<?=base_url()?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="<?=base_url()?>assets/vendor/js/menu.js"></script>
<script src="<?=base_url()?>assets/js/main.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="https://unpkg.com/@zxing/library@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>

<script type="text/javascript">
var table;
var filter = {
  // page: 19591,
  page: 3,
  perPage: 10,
  PPK: '',
  tahun: '',
  assetId: ''
}
var pagingInfo = {
  page: 1,
  totalPage: 0,
  perPage: 10,
  totalShowingData: 0,
  showingDataFrom: 0,
  showingDataTo: 0,
  totalData: 0,
  slides: []
}


$(document).ready(function() {
  getComboPPK();
  setAssets();
});

// Belum ada apply filter menggunakan PPK dan tahun

function clearFilter() {
  filter.page = 1
  filter.perPage = 10

  // $(".input_PPK").val('');
  $('.input_PPK').val('').trigger('change.select2');
  $("#input_tahunPengadaan").val('');
  $("#input_IDAset").val('');
  filter.PPK = '';
  filter.tahun = '';
  filter.assetId = '';

  console.log("clearFilter");
  console.log(filter);

  setAssets();
}

function findAssets() {
  filter.page = 1
  filter.perPage = 10

  filter.PPK =  $(".input_PPK").val();
  filter.tahun =  $("#input_tahunPengadaan").val();
  filter.assetId =  $("#input_IDAset").val();

  console.log("findAssets");
  console.log(filter);

  setAssets();
}

function updatePagingInfo(totalShowingData, totalData) {
  pagingInfo.page = filter.page
  pagingInfo.perPage = filter.perPage
  pagingInfo.totalPage = Math.ceil(totalData / pagingInfo.perPage) 
  pagingInfo.totalData = totalData
  pagingInfo.totalShowingData = totalShowingData
  pagingInfo.showingDataFrom =  ((pagingInfo.page - 1) * pagingInfo.perPage) + 1 
  pagingInfo.showingDataTo =  ((pagingInfo.page - 1) * pagingInfo.perPage) + totalShowingData

  updatePagingSlides()
}

function setAssets(userFilter = null) {
  if (userFilter) {
    filter = userFilter;
  }
  resetTableContent();
  resetPagingInfo();
  resetPagingSlides();

  $.ajax({
      url : "<?=base_url()?>index.php/pencarian_aset/getAssets/",
      type: "GET",
      dataType:"JSON",
      data: {
        filter: filter
      },
      success: function(data){
        console.log(data)  
        if (!data.data || data?.data?.length == 0) {
          console.log('data tidak ditemukan')
          setTableContentNotFound();
          return;
        }
        updatePagingInfo(data.data.length, data.total_data);
        setPagingInfo();
        console.log(pagingInfo)
        setTableContent(data.data);
        setPagingSlides();
      },
      error: function (xhr, ajaxOptions, thrownError) {
        console.log(thrownError)
        console.log(xhr)
        console.log(ajaxOptions)
      }
  });
}

function updatePagingSlides() {
  const numberOfSlide = 2;
  const slides = [];

  // Get previous pages sebanyak numberOfSlide
  for (let i = pagingInfo.page - numberOfSlide; i <= pagingInfo.page; i++) {
    slides.push(i)
  }

  // Get next pages sebanyak numberOfSlide
  for (let i = pagingInfo.page + 1; i <= pagingInfo.page + numberOfSlide; i++) {
    slides.push(i)
  }

  // Get jumlah page yang yang kurang dari 0
  let result = slides.filter((value) => value <= 0);

  // Set tambahan next pages sebayak jumlah page yang kurang dari 0
  for (let i = 0; i < result.length; i++) {
    slides.push(slides[slides.length - 1] + 1)
  }

  // Buang page yang melebihi total-pages
  let maxResult = slides.filter((value) => value <= pagingInfo.totalPage);

  // Set tambahan previous pages sebayak jumlah page yang dibuang karena melebihi total-pages
  for (let i = 0; i <= slides.length - maxResult.length; i++) {
    if (slides.length - maxResult.length == 0) {
      continue;
    }
    maxResult.unshift(maxResult[0] - 1)
  }

  // Buang page yang kurang dari 0
  let currentResult = maxResult.filter((value) => value > 0);
  pagingInfo.slides = currentResult
}

function resetPagingSlides() {
  $('.pagination').html('')
}

function setPagingSlides() {
  let pagination = '';
  const userFilter = filter;
  if (pagingInfo.page - 1 > 0) {
    userFilter.page = pagingInfo.page - 1;
    pagination += `<li class="page-item" onclick="updateSetAssetsWithPaging()" data-id="${pagingInfo.page - 1}"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">&lt;</span></a></li>`
  }

  let slides = pagingInfo.slides
  for (let i in slides) {
    if (slides[i] == pagingInfo.page) {
      pagination += `<li class="page-item"><a class="page-link bg-dark text-white" href="#">${slides[i]}</a></li>`
    } else {
      pagination += `<li class="page-item" onclick="updateSetAssetsWithPaging()" data-id="${slides[i]}"><a class="page-link" href="#">${slides[i]}</a></li>`
    }
  }

  if (pagingInfo.page + 1 < pagingInfo.totalPage) {
    pagination += ` <li class="page-item" onclick="updateSetAssetsWithPaging()" data-id="${pagingInfo.page + 1}"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">&gt;</span></a></li>`
  }

  $('.pagination').append(pagination);
}

function updateSetAssetsWithPaging() {
  let page = event.currentTarget.dataset.id;
  let userFilter = {
    page: parseInt(page),
    perPage: pagingInfo.perPage
  }
  setAssets(userFilter);
}

function resetPagingInfo() {
  $('#pagingInfo').html('');
}

function setPagingInfo() {
  $('#pagingInfo').append(`
    <p class="m-1">
      Menampilkan ${pagingInfo.showingDataFrom} sampai ${pagingInfo.showingDataTo} dari ${pagingInfo.totalData} total data
    </p>
  `);
}

function resetTableContent() {
  $('.listtable').html('');
}

function setTableContent(asset) {
  for (let i in asset) {
    $('.listtable').append(`
      <tr onclick="showAssetDetails()" data-id="${asset[i].asset_id}" style="cursor: pointer;">
        <td>${formatNullable(asset[i].asset_id)}</td>
        <td>${formatNullable(asset[i].name_asset)}</td>
        <td>${formatNullable(asset[i].ppk_user)}</td>
        <td>${formatNullable(asset[i].name_project)}</td>
        <td>${formatNullable(asset[i].year_project)}</td>
        <td>${formatNullable(asset[i].name_vendor)}</td>
        <td>${formatNullable(formatPriceToIDR(asset[i].price))}</td>
      </tr>
    `);
  }
}

function setTableContentNotFound() {
  $('.listtable').append(`
      <tr>
        <td colspan="6" style="text-align: center;">Data tidak ditemukan</td>
      </tr>
    `);
}

function resetModalBody() {
  $(".list-data-history").html('');
  $(".list-data").html('');

  $('.asset_id').text('');
  $('.name_asset').text('');
  $('.price').text('');
  $('.serial_number').text('');
  $('.year_project').text('');
  $('.ppk_user').text('');
  $('.no_kontrak').text('');
  $('.name_project').text('');
  $('.name_vendor').text('');
}

function setModalBody(data) {
  const asset = data.asset
  $('.asset_id').text(formatNullable(asset['asset_id']));
  $('.name_asset').text(formatNullable(asset['name_asset']));
  $('.price').text(formatNullable(formatPriceToIDR(asset['price'])));
  $('.serial_number').text(formatNullable(asset['serial_number']));
  $('.year_project').text(formatNullable(asset['year_project']));
  $('.ppk_user').text(formatNullable(asset['ppk_user']));
  $('.no_kontrak').text(formatNullable(asset['no_kontrak']));
  $('.name_project').text(formatNullable(asset['name_project']));
  $('.name_vendor').text(formatNullable(asset['name_vendor']));

  // Spek Tek
  const spekTek = asset.product_attribute
  for (let i in spekTek) {
      if (spekTek[i].description) {
        $('.list-data').append("<tr><td>"+ spekTek[i].name+"</td><td>"+spekTek[i].description +"</td></tr>");
      }
  }

  // History
  const history = data.history
  if (history.length > 0) {
    for (let i in history) {
      let todaydate = new Date(history[i].tanggal); 
      let dd = todaydate .getDate();
      let mm = todaydate .getMonth()+1;
      let yyyy = todaydate .getFullYear();
      if(dd<10){  dd='0'+dd } 
      if(mm<10){  mm='0'+mm } 
      let date = dd+'-'+mm+'-'+yyyy+' '+todaydate.getHours() + ':' + todaydate.getMinutes();
      $('.list-data-history').append("<tr><td>"+history[i].location_awal+"</td><td>"+history[i].location_tujuan+"</td><td>"+date+"</td></tr>");
    }
  }
  $('#modalLong').modal('show');
}

function showAssetDetails(){
  let assetId = event.currentTarget.dataset.id;
  
  console.log(assetId, "assetId")
  resetModalBody();

  $.ajax({
      url : "<?=base_url()?>index.php/pencarian_aset/getScanAsset/",
      type: "GET",
      dataType:"JSON",
      data: {
        assetId: assetId
      },
      success: function(data){
        console.log(data);
        if (data.meta.code != 200) {
          Toast.fire({
              icon: 'error',
              title: data.meta.message // "Data tidak ditemukan"
          })
          return;
        }
        setModalBody(data.data); 
      },
      error: function (xhr, ajaxOptions, thrownError) {
        Toast.fire({
            icon: 'error',
            title: 'Request data dari ITAM gagal lakukan scan ulang'
        })
      }
  });
}

function closeModalContent(){
  $('#modalLong').modal('hide');
}

function formatPriceToIDR(value) {
  if (!value) return value;

  // Convert the value to a string
  let valueStr = String(value);

  if (valueStr.length <= 3) return 'Rp'+valueStr
      
  // Determine the position to start inserting dots
  let startPos = valueStr.length % 3;

  // Insert dots every three characters
  let result = valueStr.slice(0, startPos) + '.' + valueStr.slice(startPos).match(/\d{3}/g).join('.');

  if (result[0] == '.') {
      result = result.substr(1)
  }

  return 'Rp'+result;
}

function formatNullable(value) {
  if (!value || value == 'undefined' || value == 'null') {
    return '-'
  }

  return value
}

function getComboPPK() {
  $('.input_PPK').select2();
  $.ajax({
      url : "<?=base_url()?>index.php/pencarian_aset/getKontrak/",
      type: "GET",
      dataType:"JSON",
      success: function(data){
        console.log(data)
        let PPK = data.map(kontrak => kontrak.nama_ppk?.trim());
        PPK = [...new Set(PPK)]
        PPK = PPK.filter(p => p)
        PPK.sort()
        console.log(PPK)
        for (let i in PPK) {
          $('.input_PPK').append(`<option value="${PPK[i]}">${PPK[i]}</option>`);
        }   
      },
  });
}

</script>