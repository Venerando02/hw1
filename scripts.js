function OnJson(json) {
    const section_h = document.querySelector('#notizie');
    section_h.innerHTML = '';
    let numero_risultati = json.totalArticles;
    if (numero_risultati > 9)
    {
        numero_risultati = 9;
    }
    for (let i = 0; i < numero_risultati; i++) {
        const notizia = json.articles[i];
        const title = notizia.title;
        const desc = notizia.description;
        const url = notizia.url;
        const img = notizia.image;

        const blocco_notizia_completa = document.createElement('div');
        blocco_notizia_completa.classList.add('stile_div_notizia');

        const checkbox = document.createElement('label');
        const input = document.createElement('input');
        input.type = 'checkbox';
        input.dataset.urlArticolo = url;
        input.dataset.titolo = title;
        input.dataset.descrizione = desc;
        input.dataset.immagine = img; 
        input.addEventListener('change', ReadArticle); 
        const div = document.createElement('div');
        checkbox.classList.add('container');
        div.classList.add('checkmark');
        checkbox.appendChild(input);
        checkbox.appendChild(div);

        const im = document.createElement('img');
        im.src = img;
        im.classList.add('stile_immagine');

        const block_a = document.createElement('div');
        block_a.classList.add('stile_div_scrittura');

        const titolo = document.createElement('h1');
        titolo.textContent = title;
        titolo.classList.add('stile_titolo');

        const descrizione = document.createElement('span');
        descrizione.textContent = desc;

        const link = document.createElement('a');
        link.classList.add('stile_link');
        link.href = url;
        link.textContent = 'Leggi di più...';

        block_a.appendChild(titolo);
        block_a.appendChild(descrizione);
        block_a.appendChild(link);

        blocco_notizia_completa.appendChild(im);
        blocco_notizia_completa.appendChild(block_a);
        blocco_notizia_completa.appendChild(checkbox);

        section_h.appendChild(blocco_notizia_completa);
    }
}

function OnLectureData(data) 
{

    console.log("Lettura dell'articolo registrata con successo!");
    console.log(data);
}

function OnLectureResponse(response) {
    if (response.ok) {
        console.log("Lettura dell'articolo registrata con successo!");
        console.log(response);
        return response.text();
    } else {
        console.log('Errore: ' + response.statusText);
    }
}

function OnLectureError(error)
{
    console.log('Errore: ' + error);
}

function ReadArticle(event) {
    event.stopPropagation();
    const checkbox = event.currentTarget;
    checkbox.disabled = true;

    const url_articolo = checkbox.dataset.urlArticolo;
    const titolo_articolo = checkbox.dataset.titolo;
    const descrizione_articolo = checkbox.dataset.descrizione;
    const immagine_articolo = checkbox.dataset.immagine;

    console.log(url_articolo);
    const formdata = new FormData();
    formdata.append('url_articolo', url_articolo);
    formdata.append('titolo_articolo', titolo_articolo);
    formdata.append('descrizione_articolo', descrizione_articolo);
    formdata.append('immagine_articolo', immagine_articolo);

    if (checkbox.checked) 
    {
        fetch('db_lettura.php', 
        {
            method: 'POST',
            body: formdata
        })
        .then(OnLectureResponse, OnLectureError)
        .then(OnLectureData);
    }
}

function onError(error) {
    console.error('Error: ' + error);
}

function OnResponse(response) {
    console.log('JSON RICEVUTO.');
    return response.json();
}

function search(event) {
    event.preventDefault();
    const n_input = document.querySelector('#notizia');
    const n_value = encodeURIComponent(n_input.value);
    console.log('Eseguo ricerca: ' + n_value);
    const rest_url = 'gnews.php?query=' + n_value;
    console.log('URL: ' + rest_url);
    fetch(rest_url).then(OnResponse, onError).then(OnJson).catch(onError);
}

const form = document.querySelector('#help');
form.addEventListener('submit', search);
