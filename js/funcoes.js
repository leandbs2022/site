function mudaFoto(foto){
document.getElementById("icone").src=foto
}

function cal_total() {
    let qtd = document.getElementById('cqua').value
    tot = qtd * 1500
    document.getElementById('cpre').value =Number(tot)
}  
