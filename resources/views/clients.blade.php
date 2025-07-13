<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <title>Cadastro de Cliente</title>
    <link rel="stylesheet" href="{{ asset('css/clients.css') }}">
</head>

<body>
    <h1>Cadastro de Cliente</h1>

    <form id="client-form" onsubmit="createOrUpdateClient(event)">
        <input type="hidden" id="editing_id">
        <input type="text" id="client_name" placeholder="Nome do cliente" required>
        <input type="text" id="client_address" placeholder="Endereço" required>
        <input type="text" id="client_cpf" placeholder="CPF" required>
        <input type="text" id="client_sex" placeholder="Sexo" required>
        <select id="city_id" required></select>

        <button type="submit">Cadastrar Cliente</button>
        <button type="button" id="cancel-edit" style="display:none; margin-top:10px;" onclick="cancelEdit()">Cancelar Edição</button>
    </form>

    <h2>Clientes Cadastrados</h2>
    <ul id="clients-list"></ul>

    <script>
        async function loadCities() {
            try {
                const res = await fetch('/api/cities');
                const data = await res.json();
                const select = document.getElementById('city_id');
                select.innerHTML = '';

                data.data.forEach(city => {
                    const option = document.createElement('option');
                    option.value = city.city_id;
                    option.text = `${city.city_name} - ${city.city_uf}`;
                    select.appendChild(option);
                });
            } catch (err) {
                console.error(err);
                // alert('Erro ao carregar cidades.');
            }
        }

        async function loadClients() {
            try {
                const res = await fetch('/api/clients');
                const data = await res.json();
                const list = document.getElementById('clients-list');
                list.innerHTML = '';

                data.data.forEach(client => {
                    const li = document.createElement('li');

                    const infoDiv = document.createElement('div');
                    infoDiv.className = 'client-info';
                    infoDiv.textContent = `${client.client_name} | ${client.client_sex} | ${client.client_cpf}`;

                    const btnGroup = document.createElement('div');
                    btnGroup.className = 'btn-group';

                    const btnEdit = document.createElement('button');
                    btnEdit.className = 'btn-edit';
                    btnEdit.textContent = 'Editar';
                    btnEdit.onclick = () => editClient(client);

                    const btnDelete = document.createElement('button');
                    btnDelete.className = 'btn-delete';
                    btnDelete.textContent = 'Excluir';
                    btnDelete.onclick = () => deleteClient(client.client_id);

                    btnGroup.appendChild(btnEdit);
                    btnGroup.appendChild(btnDelete);

                    li.appendChild(btnGroup);
                    li.appendChild(infoDiv);

                    list.appendChild(li);
                });
            } catch (err) {
                console.error(err);
                // alert('Erro ao carregar clientes.');
            }
        }

        async function createOrUpdateClient(event) {
            event.preventDefault();

            const client_name = document.getElementById('client_name').value.trim();
            const client_address = document.getElementById('client_address').value.trim();
            const client_cpf = document.getElementById('client_cpf').value.trim();
            const client_sex = document.getElementById('client_sex').value.trim();
            const city_id = document.getElementById('city_id').value;
            const editingId = document.getElementById('editing_id').value;

            if (!client_name || !client_address || !client_cpf || !client_sex || !city_id) {
                alert('Preencha todos os campos!');
                return;
            }

            const payload = {
                client_name,
                client_address,
                client_cpf,
                client_sex,
                city_id
            };

            try {
                let res;
                if (editingId) {
                    res = await fetch(`/api/clients/${editingId}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(payload)
                    });
                } else {
                    res = await fetch('/api/clients', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(payload)
                    });
                }

                const data = await res.json();

                if (res.ok) {
                    alert(editingId ? 'Cliente atualizado com sucesso!' : 'Cliente cadastrado com sucesso!');
                    document.getElementById('client-form').reset();
                    document.getElementById('editing_id').value = '';
                    document.getElementById('cancel-edit').style.display = 'none';
                    loadClients();
                } else {
                    alert(data.message ?? 'Erro ao salvar cliente.');
                }
            } catch (err) {
                console.error(err);
                alert('Erro ao salvar cliente.');
            }
        }

        function editClient(client) {
            document.getElementById('client_name').value = client.client_name;
            document.getElementById('client_address').value = client.client_address;
            document.getElementById('client_cpf').value = client.client_cpf;
            document.getElementById('client_sex').value = client.client_sex;
            document.getElementById('city_id').value = client.city_id;
            document.getElementById('editing_id').value = client.client_id;
            document.getElementById('cancel-edit').style.display = 'inline-block';
        }

        function cancelEdit() {
            document.getElementById('client-form').reset();
            document.getElementById('editing_id').value = '';
            document.getElementById('cancel-edit').style.display = 'none';
        }

        async function deleteClient(id) {
            if (!confirm('Tem certeza que deseja excluir este cliente?')) return;

            try {
                const res = await fetch(`/api/clients/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });

                const data = await res.json();

                if (res.ok) {
                    alert('Cliente deletado com sucesso!');
                    loadClients();
                } else {
                    alert(data.message ?? 'Erro ao deletar cliente.');
                }
            } catch (err) {
                console.error(err);
                alert('Erro ao deletar cliente.');
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            loadCities();
            loadClients();
        });
    </script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f6f6f6;
            padding: 20px;
        }

        h1,
        h2 {
            color: #333;
            text-align: center;
        }

        form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            max-width: 400px;
            margin: 0 auto 20px auto;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        input[type="text"],
        input[type="email"],
        select {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
            transition: border-color 0.2s;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        select:focus {
            border-color: #007BFF;
            outline: none;
        }

        button {
            padding: 8px 12px;
            font-size: 14px;
            background: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.2s;
        }

        button:hover {
            background: #0056b3;
        }

        ul {
            max-width: 400px;
            margin: 0 auto;
            list-style: none;
            padding: 0;
        }

        ul li {
            background: #fff;
            padding: 10px;
            margin: 5px 0;
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .city-info,
        .client-info,
        .representative-info {
            flex-grow: 1;
            padding-left: 10px;
        }

        .btn-group {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .btn-edit {
            background-color: #28a745;
        }

        .btn-edit:hover {
            background-color: #1e7e34;
        }

        .btn-delete {
            background-color: #dc3545;
        }

        .btn-delete:hover {
            background-color: #bd2130;
        }

        #cancel-edit {
            background-color: #6c757d;
        }

        #cancel-edit:hover {
            background-color: #5a6268;
        }

        @media (min-width: 500px) {
            .btn-group {
                flex-direction: row;
            }
        }
    </style>
</body>

</html>