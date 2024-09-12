function showToast(type, info) {
    const toastElement = document.getElementById('toast');
    const toastTextElement = document.getElementById('toastText')
    toastElement.classList.remove('text-bg-danger', 'text-bg-success')
    toastTextElement.innerHTML = '';

    toastElement.classList.add('bg-' + type);

    toastTextElement.innerHTML = info;
    const toast = new bootstrap.Toast(toastElement);
    toast.show();
}

function fetchUsers() {
    fetch('/api/users')
        .then(response => response.json())
        .then(users => {
            const tableBody = document.querySelector('#usersTable tbody');
            tableBody.innerHTML = '';

            users.forEach(user => {
                const row = document.createElement('tr');

                row.innerHTML = `
                        <td>${user.name}</td>
                        <td>${user.email}</td>
                        <td>${user.debt}</td>
                    `;

                tableBody.appendChild(row);
            });
        })
        .catch(error => {
            console.error('Error:', error)
            showToast('danger', 'Something unexpected happened');
        });
}

document.addEventListener('DOMContentLoaded', function() {
    const button = document.getElementById('userFormSubmit');

    button.addEventListener('click', function(event) {
        event.preventDefault();

        const nameInput = document.getElementById('nameInput');
        const emailInput = document.getElementById('emailInput');

        fetch('/api/users', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `name=${encodeURIComponent(nameInput.value)}&email=${encodeURIComponent(emailInput.value)}`
        })
            .then(response => response.json())
            .then(data => {
                const errorsDiv = document.getElementById('errors');
                errorsDiv.innerHTML = '';
                nameInput.classList.remove('border-danger');
                emailInput.classList.remove('border-danger');

                if (data.errors.length !== 0) {

                    const ul = document.createElement('ul');
                    ul.classList.add('list-group');

                    if (data.errors.name) {
                        nameInput.classList.add('border-danger');

                        data.errors.name.forEach(function(error) {
                            const li = document.createElement('li');
                            li.textContent = error;
                            li.classList.add('list-group-item', 'list-group-item-danger');
                            ul.appendChild(li);
                        });
                    }

                    if (data.errors.email) {
                        emailInput.classList.add('border-danger');

                        data.errors.email.forEach(function(error) {
                            const li = document.createElement('li');
                            li.textContent = error;
                            li.classList.add('list-group-item', 'list-group-item-danger');
                            ul.appendChild(li);
                        });
                    }

                    errorsDiv.classList.add('mb-3')
                    errorsDiv.appendChild(ul);

                } else {
                    fetchUsers();
                    showToast('success', 'Success! User was created successfully.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });

    const resetButton = document.getElementById('userReset');

    resetButton.addEventListener('click', function(event) {
        event.preventDefault();

        fetch('/api/users', {
            method: 'DELETE'
        })
            .then(response => response.json())
            .then(() => {
                fetchUsers();
                showToast('success', 'Success! Users were reset successfully.');
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('danger', 'Something unexpected happened');
            });
    });
});