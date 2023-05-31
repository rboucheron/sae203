function color (){
    document.getElementById('btn3').classList.add('btn4');
}
function color2 (){
    document.getElementById('btn3').classList.remove('btn4');
}
function color1 (){
    document.getElementById('btn').classList.add('btn4');
}
function color3 (){
    document.getElementById('btn').classList.remove('btn4');
}

function ouvre(target) {
    var idBouton = target.id;
    document.getElementById('box_'+ idBouton).classList.add('ouvr');
  }
  
  function ferme(target) {
    var idFerme = target.id;
    document.getElementById('box_'+ idFerme).classList.remove('ouvr');
}