function ControlloDatiLogin(event){
    if( form.username.value.length === 0 | form.password.value.length === 0)
    {
        alert("Non hai inserito tutti i campi.");
        event.preventDefault();
    }
}

const form = document.querySelector('#login');
form.addEventListener('submit', ControlloDatiLogin);