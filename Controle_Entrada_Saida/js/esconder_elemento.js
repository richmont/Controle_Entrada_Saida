/**
source: https://www.w3schools.com/howto/howto_js_toggle_hide_show.asp
**/

function esconderElemento(id_elemento) {
  var x = document.getElementById(id_elemento);
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}