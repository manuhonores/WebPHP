document.addEventListener("DOMContentLoaded", function(){
    let btn = document.getElementById("cambiosPass");
    if(btn != null) {
        btn.addEventListener("click", function(){
            if(document.querySelector("input[name=password1]").value != document.querySelector("input[name=password2]").value) {
                event.preventDefault();
                let divError = document.getElementById("error");
                divError.innerHTML = "*Las contraseñas son distintas";
            }
        })
    }
})
