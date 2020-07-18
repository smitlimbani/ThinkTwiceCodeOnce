function show_toast() {
    var x = document.getElementById("snackbar")
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2000);
}
function verify_delete() {
  var c=confirm("Do you want to delete all Problem Files?");
  if(c==true)
    window.location.href="delete_all_problems.php";
}

function clear_all() {
  var x=confirm("Are you sure you want to clear all Input-Output files?");
  if(x) {
    location.href="delete_all_io_files.php";
  }
}
