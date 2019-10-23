
async function voltarAoTopo() {
  var i = document.documentElement.scrollTop;

  for (i; i > 0; i--) {
    document.documentElement.scrollTop -= 20;
    i -= 19;
    await sleep(1);
  }
}