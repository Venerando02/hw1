fetch('spotify.php').then(OnResponse, error => console.log(error)).then(OnJson);

function OnResponse(response) {
    return response.json();
}

function OnJson(json) {
    console.log(json);
    const albums = json.albums.items;
    console.log(albums);
    const limitedAlbums = albums.slice(0, 20);
    limitedAlbums.forEach(album => {
        const formdata = new FormData();
        const id_album = album.id;
        const nomeAlbum = album.name;
        const artista = album.artists[0].name;
        const immagine_album = album.images[1].url;
        const data_rilascio = album.release_date;
        const url = album.href;
        formdata.append('id', id_album);
        formdata.append('nome', nomeAlbum);
        formdata.append('artista', artista);
        formdata.append('immagine', immagine_album);
        formdata.append('data', data_rilascio);
        formdata.append('url', url);
        fetch('insert_album.php', {
            method: 'POST',
            body: formdata
        })
            .then(OnInsertResponse, error => console.log(error))
            .then(OnInsertJson);
    });
}

function OnInsertResponse(response) {
    return response.json();
}

function OnInsertJson(json) {
    console.log(json);
}

Inserimento()


function Inserimento() {
    fetch('fetch_album.php')
        .then(ResponseInserimento, error => console.log(error))
        .then(JsonInserimento);
}


function ResponseInserimento(response) {
    return response.json();
}

function JsonInserimento(data) {
    console.log(data);
    if (data.response) {
        const albums = data.albums;

        const albumSection = document.getElementById('sezione-album');

        albums.forEach(album => {

            const id = album.id;

            const albumDiv = document.createElement('div');
            albumDiv.classList.add('album');

            const albumName = document.createElement('h2');
            albumName.textContent = album.nome;

            const artistName = document.createElement('p');
            artistName.textContent = 'Artista: ' + album.artista;

            const releaseDate = document.createElement('p');
            releaseDate.textContent = 'Data di rilascio: ' + album.data;

            const albumImage = document.createElement('img');
            albumImage.src = album.immagine;

            const commentReactDiv = document.createElement('div');
            commentReactDiv.classList.add('comment-react');

            const likeButton = document.createElement('button');
            const likeCount = document.createElement('span');

            const likeSvg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
            likeSvg.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
            likeSvg.setAttribute('width', '22');
            likeSvg.setAttribute('height', '22');
            likeSvg.setAttribute('viewBox', '0 0 24 24');
            likeSvg.setAttribute('fill', 'none');

            const likePath = document.createElementNS('http://www.w3.org/2000/svg', 'path');
            likePath.setAttribute('d', 'M19.4626 3.99415C16.7809 2.34923 14.4404 3.01211 13.0344 4.06801C12.4578 4.50096 12.1696 4.71743 12 4.71743C11.8304 4.71743 11.5422 4.50096 10.9656 4.06801C9.55962 3.01211 7.21909 2.34923 4.53744 3.99415C1.01807 6.15294 0.221721 13.2749 8.33953 19.2834C9.88572 20.4278 10.6588 21 12 21C13.3412 21 14.1143 20.4278 15.6605 19.2834C23.7783 13.2749 22.9819 6.15294 19.4626 3.99415Z');
            likePath.setAttribute('stroke', '#707277');
            likePath.setAttribute('stroke-width', '2');
            likePath.setAttribute('stroke-linecap', 'round');
            likePath.setAttribute('fill', '#707277');

            likeSvg.appendChild(likePath);
            likeButton.appendChild(likeSvg);

            commentReactDiv.appendChild(likeButton);
            commentReactDiv.appendChild(likeCount);
            commentReactDiv.dataset.id_album = id;
            commentReactDiv.addEventListener('click', LikeAlbum);

            albumDiv.appendChild(albumName);
            albumDiv.appendChild(artistName);
            albumDiv.appendChild(releaseDate);
            albumDiv.appendChild(albumImage);
            albumDiv.appendChild(commentReactDiv);

            albumSection.appendChild(albumDiv);
        });
    }
}


function LikeAlbum(event) {
    event.stopPropagation();
    const formdata = new FormData();
    const button = event.currentTarget;
    const albumDiv = button.parentNode;
    const button_like = button.querySelector('button');
    button_like.classList.add('liked');
    const contatore_like = button.querySelector('span');
    const id = button.dataset.id_album;
    formdata.append('id', id);
    fetch('insert_like.php', {
        method: 'POST',
        body: formdata
    }).then(OnResponseLike).then(json => OnDataLike(json, contatore_like, albumDiv, button_like));
}

function OnResponseLike(response) {
    return response.json();
}

function OnDataLike(json, contatore_like, albumDiv, button_like) {
    console.log(json);
    if (json.response) {
        contatore_like.textContent = json.numero_like;
        button_like.removeEventListener('click', LikeAlbum);
    } else {
        contatore_like.textContent = json.numero_like;
        const message = json.message;
        const existingError = albumDiv.querySelector('.Error');
        if (!existingError) {
            const text = document.createElement('p');
            text.classList.add('Error');
            text.textContent = message;
            albumDiv.appendChild(text);
        } else {
            existingError.textContent = message;
        }

        button_like.removeEventListener('click', LikeAlbum);
    }
}