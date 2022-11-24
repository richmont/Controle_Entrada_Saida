function relogio() {
  var today = new Date();
  var h = today.getHours();
  var m = today.getMinutes();
  var s = today.getSeconds();
  m = checarHora(m);
  s = checarHora(s);
  document.getElementById('relogio').innerHTML =
  h + ":" + m + ":" + s;
  var t = setTimeout(relogio, 500);
}
function checarHora(i) {
  if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
  return i;
}