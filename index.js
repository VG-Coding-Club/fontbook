'use strict'

async function indexJSON() {
    const requestURL = 'index.json';
    const request = new Request(requestURL);
    const response = await fetch(request);
    const jsonIndex = await response.text();

    const index = JSON.parse(jsonIndex);
    indexHead(index);
    indexORG(index);
    indexItems(index);
}

function indexHead(obj) {
    const head = document.querySelector('head');
    const orgTitle = document.querySelector('#title');
    orgTitle.textContent = obj['title'];

    const indexTitle = document.createElement('title');
    const ogTitle = document.createElement('meta');
    indexTitle.textContent = obj['title'] + ' | ' + obj['author'];
    ogTitle.setAttribute("property", "og:title");
    ogTitle.setAttribute("content", obj['title']);
    head.appendChild(indexTitle);
    head.appendChild(ogTitle);

    const orgDescription = document.querySelector('#description');
    orgDescription.textContent = obj['description'];

    const indexDescription = document.createElement('meta');
    const ogDescription = document.createElement('meta');
    indexDescription.setAttribute("name", "description");
    indexDescription.setAttribute("content", obj['description']);
    ogDescription.setAttribute("property", "og:description");
    ogDescription.setAttribute("content", obj['description']);
    head.appendChild(indexDescription);
    head.appendChild(ogDescription);

    const indexAuthor = document.createElement("meta");
    indexAuthor.setAttribute("name", "author");
    indexAuthor.setAttribute("content", obj['author']);
    head.appendChild(indexAuthor);

    const indexEmail = document.createElement("meta");
    indexEmail.setAttribute("name", "reply-to");
    indexEmail.setAttribute("content", obj['email']);
    head.appendChild(indexEmail);

    const ogType = document.createElement("meta");
    ogType.setAttribute("property", "og:type");
    ogType.setAttribute("content", obj['type']);
    head.appendChild(ogType);

    const ogIMG = document.createElement("meta");
    ogIMG.setAttribute("property", "og:image");
    ogIMG.setAttribute("content", obj['src']);
    head.appendChild(ogIMG);

    const ogSite = document.createElement("meta");
    ogSite.setAttribute("property", "og:site_name");
    ogSite.setAttribute("content", location.hostname);
    head.appendChild(ogSite);

    const ogURL = document.createElement("meta");
    ogURL.setAttribute("property", "og:url");
    ogURL.setAttribute("content", location.href);
    head.appendChild(ogURL);

    const iconCC = document.createElement("link");
    iconCC.rel = "icon";
    iconCC.type = "image/png";
    iconCC.href = obj['icon'];
    head.appendChild(iconCC);
}

function indexORG(obj) {
    const navORG = document.querySelector('#org');
    const orgAll = obj.org;

    for (const orgEach of orgAll) {
        const inputORG = document.createElement('input');
        const labelORG = document.createElement('label');

        inputORG.setAttribute("type", "radio");
        inputORG.setAttribute("name", "org");
        inputORG.id = orgEach.id;
        inputORG.value = orgEach.id;
        labelORG.setAttribute("for", orgEach.id);
        labelORG.classList.add(orgEach.id);
        labelORG.innerHTML = orgEach.name;

        navORG.appendChild(inputORG);
        navORG.appendChild(labelORG);
    }
}

function indexItems(obj) {
    const mainThings = document.querySelector('#things');
    const thingsUL = document.createElement('ul');
    const thingAll = obj.things;

    mainThings.appendChild(thingsUL);

    for (const thing of thingAll) {
        const thingLi = document.createElement('li');
        thingLi.setAttribute("data-org", thing.org);
        thingLi.setAttribute("data-name", thing.name);
        thingLi.classList.add(thing.class);
        thingLi.innerHTML = `
        <h3>${thing.name}</h3>
        <small>by <i>${thing.by}</i></small>
        <p>${thing.description}</p>
        `
        thingsUL.appendChild(thingLi);
    }
}

indexJSON()
