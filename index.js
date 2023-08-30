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
        thingLi.classList.add(thing.class);
        thingLi.innerHTML = `
        <h3>
        ${thing.name}<br/>
        <small>by ${thing.by}</small>
        </h3>
        <p hidden>${thing.description}</p>
        `
        thingsUL.appendChild(thingLi);
    }
}

indexJSON()

window.onload = function () {
    let targets = document.querySelectorAll("#things ul li")
    let filter = document.querySelectorAll('#org input[type="radio"]')
    if (filter) {
        //****** for all select ******
        for (let i of filter) {
            i.addEventListener('change', () => {
                let value = i.value
                let name = i.getAttribute('name')
                //*** for each target ***
                for (let ii of targets) {
                    //*** delete hidden class ***
                    ii.classList.remove('hidden')
                    ii.hidden = false
                    //*** check target every select ***
                    let item_data = ii.getAttribute('data-' + name)
                    //*** set hidden class ***
                    if (value && value !== 'all' && value !== item_data && !ii.classList.contains('hidden')) {
                        ii.classList.add('hidden')
                        ii.hidden = true
                    }
                }
            })
        }
    }
};

