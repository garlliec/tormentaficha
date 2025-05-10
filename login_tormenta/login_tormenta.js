document.getElementById("loginform").addEventListener("submit", function(e){
    e.preventDefault();
   

    
    let email_userConfirm = document.getElementById("email_userConfirm").value;
    let senha_userConfirm = document.getElementById("senha_userConfirm").value;

    let alertausuario = document.getElementById("alertforuser"); //não é .value pq eu quero alterar a div
    // não o seu valor 
    let tevesubmit = 0;



    alertausuario.textContent = "";
    alertausuario.style.color = "";

    function userAlert(texto, corTexto) {
        alertausuario.textContent = texto;
        alertausuario.style.display = "block";
        alertausuario.style.fontSize = "20px";
        alertausuario.style.color = corTexto;
        

        
        
        // Faz a mensagem sumir depois de 3 segundos
        setTimeout(() => {
            alertausuario.style.display = "none";
        }, 2000);
    }

  

    if( !email_userConfirm || !senha_userConfirm){
        bordaVermelha(email_userConfirm, senha_userConfirm);
        userAlert("Por favor, preencha todos os campos.", "#F61A1A");
        
        return;
    };

    // if (senha_usuario !== senha_usuariook || senha_usuariook == ""){
    //     console.log("As senhas não coincidem. Tente novamente.");
    //     userAlert("As senhas não coincidem.", "#e74c3c");
        
    //     return;
    // };

    if (email_userConfirm && senha_userConfirm){
        tevesubmit = 1;
        console.log("Login realizado com sucesso.");
        userAlert("Login relizado com sucesso.", "color: #F2CAB0;");
        return;

    };

    
});


function bordaVermelha(email_userConfirm, senha_userConfirm){
    
   
    let inputemailuserLogin= document.getElementById("email_userConfirm");

    let inputsenhauserLogin = document.getElementById("senha_userConfirm"); 
   

   
    if (!email_userConfirm){
        inputemailuserLogin.style.border = "2.5px solid #F61A1A";
    };

    if (!senha_userConfirm){
        inputsenhauserLogin.style.border = "2.5px solid #F61A1A";
    };
  
    setTimeout(() => {
       
       inputemailuserLogin.style.border = "";
       inputsenhauserLogin.style.border = "";
    

    }, 2000);
};

