function creaSchedaTecnica(giocatore) 
{
    const body = document.querySelector('#sezione-calciatore');
    
    const schedaGiocatore = document.createElement('div');
    schedaGiocatore.classList.add('scheda-tecnica');

    const immagine = document.createElement('img');
    immagine.src = giocatore.playerImage;
    immagine.classList.add('immagine');

    const nomeCognomeElement = document.createElement('h2');
    nomeCognomeElement.textContent = giocatore.playerName;

    const clubElement = document.createElement('div');
    clubElement.classList.add('club');

    const clubImage = document.createElement('img');
    clubImage.src = giocatore.clubImage;
  
    const clubName = document.createElement('span');
    clubName.textContent = giocatore.club;

    clubElement.appendChild(clubImage);
    clubElement.appendChild(clubName);

    const dettagli = document.createElement('div');
    dettagli.classList.add('dettagli');

    const dettagliContent = [
        { label: 'Luogo di nascita:', value: giocatore.birthplace },
        { label: 'Data di nascita:', value: giocatore.dateOfBirth },
        { label: 'Numero maglia:', value: giocatore.playerShirtNumber },
        { label: 'Età:', value: giocatore.age },
        { label: 'Piede:', value: giocatore.foot },
        { label: 'Nazionale:', value: giocatore.internationalTeamImage },
        { label: 'Gol in nazionale:', value: giocatore.internationalGoals },
        { label: 'Valore di mercato:', value: giocatore.marketValue + ' ' + giocatore.marketValueNumeral + ' ' +'€' },
        { label: 'Ruolo:', value: giocatore.playerMainPosition }
    ];

    dettagliContent.forEach(item => {
        const p = document.createElement('p');
        const strong = document.createElement('strong');
        strong.textContent = item.label + ' ';
        p.appendChild(strong);
        if(item.label === 'Nazionale:'){
            const imgNazionale = document.createElement('img');
            imgNazionale.src = item.value;
            p.appendChild(imgNazionale);
        } else {
            p.appendChild(document.createTextNode(item.value));
        }
        dettagli.appendChild(p);
    });

    const labelContainer = document.createElement('label');
    labelContainer.classList.add('container');

    const checkbox = document.createElement('input');
    checkbox.type = 'checkbox';
    checkbox.dataset.IDGiocatore = giocatore.playerID;
    checkbox.dataset.NomeGiocatore = giocatore.playerName;
    checkbox.dataset.ImmagineGiocatore = giocatore.playerImage;
    checkbox.dataset.ImmagineClub = giocatore.clubImage; 
    checkbox.dataset.NomeClub = giocatore.club; 
    checkbox.dataset.LuogoNascita = giocatore.birthplace; 
    checkbox.dataset.DataNascita = giocatore.dateOfBirth 
    checkbox.dataset.Maglia = giocatore.playerShirtNumber;
    checkbox.dataset.Eta = giocatore.age;
    checkbox.dataset.Piede = giocatore.foot;
    checkbox.dataset.GolNazionale = giocatore.internationalGoals;
    checkbox.dataset.ValoreMercato = giocatore.marketValue + ' ' + giocatore.marketValueNumeral + ' ' + '€';
    checkbox.dataset.Ruolo = giocatore.playerMainPosition;
    
    checkbox.addEventListener('change', PreferPlayer);

    const checkmark = document.createElement('div');
    checkmark.classList.add('checkmark');
    
    labelContainer.appendChild(checkbox);
    labelContainer.appendChild(checkmark);

    
    schedaGiocatore.appendChild(labelContainer);
    schedaGiocatore.appendChild(immagine);
    schedaGiocatore.appendChild(nomeCognomeElement);
    schedaGiocatore.appendChild(clubElement);
    schedaGiocatore.appendChild(dettagli);
    body.appendChild(schedaGiocatore);
}

function PreferInsert(data){
    console.log('Registrazione avvenuta:\n' + data);
}

function ErrorInsert(error){
    console.log('Errore: ' + error);
}

function ResponsePrefer(response)
{
    if(response.ok){
        console.log('Giocatore inserito tra i preferiti!');
        return response.text();
    }
}

function PreferPlayer(event)
{
    event.stopPropagation();
    const c = event.currentTarget;
    c.disabled = true;

    const ID = c.dataset.IDGiocatore;
    const name = c.dataset.NomeGiocatore;
    const img_p = c.dataset.ImmagineGiocatore;
    const img_c = c.dataset.ImmagineClub;
    const club = c.dataset.NomeClub;
    const p_birth = c.dataset.LuogoNascita;
    const birthday = c.dataset.DataNascita;
    const age = c.dataset.Eta;
    const numbershirt = c.dataset.Maglia;
    const goals = c.dataset.GolNazionale;
    const value = c.dataset.ValoreMercato;
    const pos = c.dataset.Ruolo;

    const formdata = new FormData();

    formdata.append('id', ID);
    formdata.append('nome_g', name);
    formdata.append('img_p' , img_p);
    formdata.append('img_c',img_c);
    formdata.append('club', club);
    formdata.append('p_birth',p_birth);
    formdata.append('birthday', birthday);
    formdata.append('age', age);
    formdata.append('number', numbershirt);
    formdata.append('goal', goals);
    formdata.append('value', value);
    formdata.append('pos', pos);

    fetch('dbplayer.php' , {
        method: 'POST', 
        body: formdata
    }).then(ResponsePrefer, ErrorInsert).then(PreferInsert);
}

function JsonGiocatore(json) {
    const giocatore = json.playerProfile;
    creaSchedaTecnica(giocatore);
}

function ErrorGiocatore(error){
    console.log('Errore nel caricamento del giocatore: ' + error);
}

function ResponseGiocatore(response) {
    return response.json();
}

function ricerca_info(id_giocatore) 
{
    fetch('transfermarkt2.php?id=' + id_giocatore)
    .then(ResponseGiocatore, ErrorGiocatore)
    .then(JsonGiocatore);
}

function onJson(json) {
    console.log(json);
    const body = document.querySelector('#sezione-calciatore');
    body.innerHTML = '';
    if (json.players && json.players.length > 0)
    {
        for (let i=0; i<5; i++)
        {
            const giocatore = json.players[i];
            const id_player = giocatore.id;
            console.log(id_player);
            ricerca_info(id_player);
        }
    } 
}

function OnResponse(response) 
{
    console.log('JSON RICEVUTO');
    return response.json();
}

function Search(event) 
{
    event.preventDefault();
    const calciatore = document.querySelector('#calciatore');
    const value = encodeURIComponent(calciatore.value);
    const rest_url = 'transfermarkt.php?query=' + value;
    fetch(rest_url)
    .then(OnResponse)
    .then(onJson);
}

const form = document.querySelector('#Search-Player');
form.addEventListener('submit', Search);
