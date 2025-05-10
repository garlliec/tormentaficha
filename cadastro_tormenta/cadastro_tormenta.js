document.getElementById("cadastroform").addEventListener("submit", function(e){
    e.preventDefault();
   

    let username = document.getElementById("username").value;
    let email_user = document.getElementById("email_user").value;
    let senha_user = document.getElementById("senha_user").value;

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

  

    if( !email_user || !senha_user || !username){
        bordaVermelha(email_user, senha_user, username);
        userAlert("Por favor, preencha todos os campos.", "#F61A1A");
        
        return;
    };

    // if (senha_usuario !== senha_usuariook || senha_usuariook == ""){
    //     console.log("As senhas não coincidem. Tente novamente.");
    //     userAlert("As senhas não coincidem.", "#e74c3c");
        
    //     return;
    // };

    if (email_user && senha_user && username){
        tevesubmit = 1;
        console.log("Login realizado com sucesso.");
        userAlert("Login relizado com sucesso.", "color: #F2CAB0;");
        return;

    };

    
});


function bordaVermelha(email_user, senha_user, username){
    
   
    let inputemailuser = document.getElementById("email_user");
    let inputusername = document.getElementById("username");
    let inputsenhauser = document.getElementById("senha_user"); 
   

   
    if (!email_user){
        inputemailuser.style.border = "2.5px solid #F61A1A";
    };

    if (!senha_user){
        inputsenhauser.style.border = "2.5px solid #F61A1A";
    };
    if(!username){
        inputusername.style.border = "2.5px solid #f61a1a"
    }
    setTimeout(() => {
       inputusername.style.border = "";
       inputemailuser.style.border = "";
       inputsenhauser.style.border = "";
    

    }, 2000);
};

