function fetch_articles() {
    fetch('fetch_letture.php')
        .then(fetchResponse, error => console.log(error))
        .then(jsonfetchArticle);
}

function fetchResponse(response) {
    return response.json();
}

function jsonfetchArticle(json) {
    console.log(json);
    const body = document.querySelector('#articoli-letti');
    body.innerHTML = '';
    if (json.length === 0) {
        const message = document.createElement('h3');
        message.textContent = "Non hai ancora aggiunto nulla";
        message.classList.add('stile_h3');
        body.appendChild(message);
    }
    else {
        json.forEach(item => {
            const IDlettura = item.id;
            const article = item.lettura;
            const blocco_notizia_completa = document.createElement('div');
            blocco_notizia_completa.classList.add('stile_div_notizia');

            const im = document.createElement('img');
            im.src = article.img;
            im.classList.add('stile_immagine');

            const block_a = document.createElement('div');
            block_a.classList.add('stile_div_scrittura');

            const titolo = document.createElement('h1');
            titolo.textContent = article.title;
            titolo.classList.add('stile_titolo');

            const deleteButton = document.createElement('button');
            deleteButton.classList.add('noselect', 'delete-button');
            deleteButton.innerHTML = '<span class="text">Delete</span><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z"></path></svg></span>';
            deleteButton.dataset.id_articolo = IDlettura;
            deleteButton.addEventListener('click', EliminaArticolo);


            block_a.appendChild(titolo);

            blocco_notizia_completa.appendChild(im);
            blocco_notizia_completa.appendChild(block_a);
            blocco_notizia_completa.appendChild(deleteButton);

            body.appendChild(blocco_notizia_completa);
        })
    }
}

fetch_articles();

function fetch_player() {
    fetch('fetch_giocatori.php')
        .then(OnPlayerResponse, error => console.log(error))
        .then(OnJsonPlayer);
}

function OnPlayerResponse(response) {
    return response.json();
}

function OnJsonPlayer(json) {
    const body = document.querySelector('#Calciatori-preferiti');
    body.innerHTML = '';
    console.log(json);
    if (json.length === 0) {
        const message = document.createElement('h3');
        message.textContent = "Non hai ancora aggiunto nulla";
        message.classList.add('stile_h3');
        body.appendChild(message);
    } else {
        json.forEach(item => {
            const id_player = item.id_player;
            const player = item.giocatore;
            const schedaGiocatore = document.createElement('div');
            schedaGiocatore.classList.add('scheda-tecnica');
            schedaGiocatore.dataset.id = id_player;

            const immagine = document.createElement('img');
            immagine.src = player.immagine_giocatore;
            immagine.classList.add('immagine');

            const nomeCognomeElement = document.createElement('h2');
            nomeCognomeElement.textContent = player.name;

            const clubElement = document.createElement('div');
            clubElement.classList.add('club');

            const clubImage = document.createElement('img');
            clubImage.src = player.immagine_club;

            const clubName = document.createElement('span');
            clubName.textContent = player.nome_club;


            const deleteButton = document.createElement('button');
            deleteButton.classList.add('noselect', 'delete-button');
            deleteButton.innerHTML = '<span class="text">Delete</span><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z"></path></svg></span>';
            deleteButton.dataset.idGiocatore = id_player;
            deleteButton.addEventListener('click', EliminaGiocatore);


            clubElement.appendChild(clubImage);
            clubElement.appendChild(clubName);

            schedaGiocatore.appendChild(immagine);
            schedaGiocatore.appendChild(nomeCognomeElement);
            schedaGiocatore.appendChild(clubElement);
            schedaGiocatore.appendChild(deleteButton);

            body.appendChild(schedaGiocatore);
        });
    }
}

fetch_player();

function EliminaGiocatore(event) {
    event.stopPropagation();
    const button = event.currentTarget;
    const id_giocatore = button.dataset.idGiocatore;
    const code_id = encodeURIComponent(id_giocatore);
    fetch('elimina_giocatore.php?q=' + code_id)
        .then(OnDeleteResponse, error => console.log(error))
        .then(json => {

            console.log(json);
            const div = button.parentNode;
            div.remove();

            const body = document.querySelector('#Calciatori-preferiti');
            // controllo se #calciatori-preferiti ha dei figli
            if (!body.hasChildNodes()) {
                body.innerHTML = '';
                const message = document.createElement('h3');
                message.textContent = "Non hai ancora aggiunto nulla";
                message.classList.add('stile_h3');
                body.appendChild(message);
            }

        });
}

function OnDeleteResponse(response) {
    return response.json();
}

function EliminaArticolo(event) {
    event.stopPropagation();
    const button = event.currentTarget;
    const id = button.dataset.id_articolo;
    const coded_id = encodeURIComponent(id);
    fetch('elimina_articolo.php?q=' + coded_id)
    .then(OnArticleResponse, error => console.log(error))
    .then(json => {
        console.log(json);
        const div = button.parentNode;
        div.remove();

        const body = document.querySelector('#articoli-letti');
        if (!body.hasChildNodes()) {
            body.innerHTML = '';
            const message = document.createElement('h3');
            message.textContent = "Non hai ancora aggiunto nulla";
            message.classList.add('stile_h3');
            body.appendChild(message);
        }
    })
}

function OnArticleResponse(response) {
    return response.json();
}