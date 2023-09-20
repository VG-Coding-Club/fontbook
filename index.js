'use strict'

async function indexJSON(requestURL) {
    const request = new Request(requestURL);
    const response = await fetch(request);
    const jsonIndex = await response.text();
    const index = JSON.parse(jsonIndex);
    allTheThings(index);
}

function allTheThings(obj) {
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

        const dialogModal = document.querySelector('#modal');
        thingLi.addEventListener('click', function () {
            onModal()

            dialogModal.className = thing.class;
            document.querySelector('header').className = thing.class;
            document.querySelector('#org').className = thing.class;

            const family = document.querySelector('#name');
            family.innerHTML = `
            ${thing.name}<br/>
            <small>by ${thing.by}</small>
            `;
            const moreinfo = document.querySelector('#moreinfo');
            moreinfo.innerHTML = thing.description;
            const link = document.querySelector('#link');
            link.href = thing.link;
        });

        function onModal() {
            if (typeof dialogModal.showModal === "function") {
                dialogModal.showModal();
            } else {
                alert("The <dialog> API is not supported by this browser");
            }
        }

        const closeBtn = document.querySelector('#closeBtn');
        closeBtn.addEventListener('click', () => {
            dialogModal.close();
        });
    }
}

document.addEventListener('readystatechange', event => {
    if (event.target.readyState === 'interactive') {
        const thisTitle = document.title
        document.querySelector('#title').textContent = thisTitle;
        const thisDescription = document.querySelector('meta[name="description"]').content;
        document.querySelector('#description').textContent = thisDescription;

        indexJSON('index.json')
    } else if (event.target.readyState === 'complete') {
        //****** for all select ******
        const filter = document.querySelectorAll('#org input[type="radio"]')
        for (let i of filter) {
            i.addEventListener('change', () => {
                let value = i.value
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
