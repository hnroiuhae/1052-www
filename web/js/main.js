
$('#LoginModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var username = button.data('username') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var userid = button.data('userid')
  var modal = $(this)
  //modal.find('.modal-title').text(recipient)
  modal.find('.modal-body #username').val(username)
  modal.find('.modal-body #userid').val(userid)
  modal.find('.modal-body #userid_hidden').val(userid)
  logining = true;
})

$("#LoginModal").on('hidden.bs.modal', function () {
  logining = false;
});

$('#LoginModalM').on('show.bs.modal', function (event) {
  logining = true;
})

$("#LoginModalM").on('hidden.bs.modal', function () {
  logining = false;
});

function SearchClus() {
  var input, filter, table, tr, td, i;
  var key,str,col;
  
  input = document.getElementById("SearchForIn");
  filter = input.value.toUpperCase();
  str = filter.substr(filter.indexOf(',')+1,filter.length);
  key = filter.substr(0,filter.indexOf(','));

if(filter.indexOf(',')==-1){
    table = document.getElementById("regTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(str) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}else{

  switch(key){
    case "NO":
      col=0;
    break;
    case "MAC":
      col=1;
    break;
    case "RSSI":
      col=2;
    break;
    case "CHANNEL":
      col=3;
    break;
    case "RECEIVETIME":
      col=4;
    break;
    case "TYPE":
      col=5;
    break;
    default:
      col=0;
    break;
  }
  table = document.getElementById("regTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[col];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(str) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
        }
      }       
    }
  }  
}
