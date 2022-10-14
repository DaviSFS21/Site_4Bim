// Função para verificar as senhas
function check_senha() {
    var senha = document.getElementById("n_senha").value;
    var rep_senha = document.getElementById("n_rep_senha").value;

    // If password not entered
    if (senha == ''){
        document.getElementById("confirm_button").disabled = true;
    }else{
        if (rep_senha == ''){
            document.getElementById("confirm_button").disabled = true;
        }else{
            if (senha != rep_senha){
                document.getElementById("confirm_button").disabled = true;
            }else{
                document.getElementById("confirm_button").disabled = false;
            }
        }
    }
}