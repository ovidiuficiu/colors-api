const apiUrl = 'http://localhost:8000';

/**
 * Listen for submit form. Show validation messages and prevent submitting if failing.
 */
function formSubmitListener() {
    const form = document.getElementById('color-form')
    form.addEventListener('submit', function (event) {
        event.preventDefault()
        if (!form.checkValidity()) {
            event.stopPropagation()
            form.classList.add('was-validated')
            return;
        }

        const data = new URLSearchParams(new FormData(form));

        fetch(`${apiUrl}/color`, {
            mode: 'cors',
            method: 'POST',
            body: data
        })
            .then(response => response.json())
            .then(showColors);
    });
}

/**
 * Fetch colors from server.
 */
function populateColorsTable() {
    fetch(`${apiUrl}/color`, {mode: 'cors'})
        .then(response => response.json())
        .then(showColors);
}

/**
 * Populate the table with colors from API.
 *
 * @param colors
 */
function showColors(colors) {
    if (!Array.isArray(colors)) {
        colors = [colors];
    }
    const tableBody = document.getElementById('color-table-body');
    colors.forEach((item) => {
        const html =
            `<tr>
                    <th scope="row">${item.id}</th>
                    <td>${item.name}</td>
                    <td class="colors" data-color="${item.color}">${item.color}</td>
                    <td>
                        <button class="delete-button btn btn-danger" data-color="${item.id}">Delete</button>
                    </td>
                    <td style="background-color: #${item.color}">
                    </td>
                </tr>`;
        tableBody
            .insertAdjacentHTML("beforeend", html);
    });

    addButtonListeners();
}

/**
 * Listen for delete button presses. Trigger delete request for selected item.
 */
function addButtonListeners() {
    document.querySelectorAll('.delete-button').forEach((item) => {
        item.addEventListener('click', (e) => {
            e.preventDefault();
            e.target.parentElement.parentElement.remove();
            fetch(`${apiUrl}/color/id/${item.dataset.color}`, {
                method: 'DELETE',
                mode: 'cors'
            })
                .then(res => res.json())
                .then(populateColorsTable)
                .catch(err => console.log(err))
        })
    })
}

function colorMadnessButton() {
    document.getElementById('color-madness').addEventListener('click', (e) => {
        const colors = [];
        document.querySelectorAll('.colors').forEach((item) => {
            colors.push(`#${item.dataset.color}`);
        });
        let index = 0;
        var timer = setInterval(function() {
            document.body.style.backgroundColor = colors[index++];
            if (index > colors.length) index = 0;
        }, 300);
    });
}

colorMadnessButton();
populateColorsTable();
formSubmitListener();


