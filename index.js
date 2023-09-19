'use strict'

async function indexJSON() {
    const requestURL = 'index.json';
    const request = new Request(requestURL);
    const response = await fetch(request);
    const jsonIndex = await response.text();
    const index = JSON.parse(jsonIndex);
    indexItems(index);
}

function indexItems(obj) {
    const thingsUL = document.querySelector('#things');
    const thingAll = obj.things;

    for (const thing of thingAll) {
        const thingLi = document.createElement('li');
        thingLi.setAttribute("data-org", thing.org);
        thingLi.classList.add(thing.class);
        thingLi.innerHTML = `
        <h3>${thing.name}</h3>
        <small>by <i>${thing.by}</i></small>
        `
        thingsUL.appendChild(thingLi);

        thingLi.addEventListener('click', function () {
            const header = document.querySelector('header');
            header.className = thing.class;
            const title = document.querySelector('#title');
            title.innerHTML = `
            ${thing.name}<br/>
            <small>by ${thing.by}</small>
            `;
            const description = document.querySelector('#description');
            description.innerHTML = `
            ${thing.description}
            `;
            const link = document.querySelector('#link');
            link.href = thing.link;
            link.textContent = "Download";
        });
    }
}

document.addEventListener('readystatechange', event => {
    if (event.target.readyState === 'interactive') {
        indexJSON()

        const thisTitle = document.title
        document.querySelector('#title').textContent = thisTitle;

        const thisDescription = document.querySelector('meta[name="description"]').content;
        document.querySelector('#description').textContent = thisDescription;
    } else if (event.target.readyState === 'complete') {
        const filter = document.querySelectorAll('#org input[type="radio"]')
        //****** for all select ******
        for (let i of filter) {
            i.addEventListener('change', () => {
                let value = i.value
                let name = i.getAttribute('name')
                //*** for each target ***
                let targets = document.querySelectorAll('#things li')
                for (let ii of targets) {
                    //*** delete hidden items ***
                    ii.hidden = false
                    //*** check target every select ***
                    let item_data = ii.getAttribute('data-org')
                    //*** set hidden items ***
                    if (value && value !== 'all' && value !== item_data && !ii.classList.contains('hidden')) {
                        ii.hidden = true
                    }
                }
            })
        }
    }
});
