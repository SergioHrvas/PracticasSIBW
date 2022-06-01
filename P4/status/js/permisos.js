document.getElementById('gestor').addEventListener('click', function () { cambiarValor("gestor") }, false);
document.getElementById('moderador').addEventListener('click', function () { cambiarValor("moderador") }, false);
document.getElementById('super').addEventListener('click', function () { cambiarValor("super") }, false);

function cambiarValor(id){
    var x = document.getElementById(id);
    x.value = (x.value+1)%2;
}
