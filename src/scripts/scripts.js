//guardar scripts pra usar dps

function v1(){
    let senha = form.senha.value;
    let confirmsenha = form.confirmsenha.value;

    if (senha != confirmsenha){
        document.getElementById("errada").innerHTML = "As senhas não coincidem";
    } else{
        document.getElementById("errada").innerHTML = "";
    }
}