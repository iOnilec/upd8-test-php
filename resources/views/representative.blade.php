<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <title>Cadastro de Representante</title>
    <link rel="stylesheet" href="{{ asset('css/clients.css') }}">
</head>

<body>
    <h1>Cadastro de Representante</h1>

    <form id="representative-form" onsubmit="createOrUpdateRepresentative(event)">
        <input type="hidden" id="editing_id">
        <input type="text" id="representative_name" placeholder="Nome do representante" required>
        <input type="email" id="representative_email" placeholder="Email" required>
        <input type="text" id="representative_phone" placeholder="Telefone" required>
        <select id="city_id" required></select>

        <button type="submit">Cadastrar Representante</button>
        <button type="button" id="cancel-edit" style="display:none; margin-top:10px;" onclick="cancelEdit()">Cancelar Edição</button>
    </form>

    <h2>Representantes Cadastrados</h2>
    <ul id="representatives-list"></ul>

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
            }
        }

        async function loadRepresentatives() {
            try {
                const res = await fetch('/api/representatives');
                const data = await res.json();
                const list = document.getElementById('representatives-list');
                list.innerHTML = '';

                data.data.forEach(rep => {
                    const li = document.createElement('li');

                    const infoDiv = document.createElement('div');
                    infoDiv.className = 'representative-info';
                    infoDiv.textContent = `${rep.representative_name} | ${rep.representative_email} | ${rep.representative_phone}`;

                    const btnGroup = document.createElement('div');
                    btnGroup.className = 'btn-group';

                    const btnEdit = document.createElement('button');
                    btnEdit.className = 'btn-edit';
                    btnEdit.textContent = 'Editar';
                    btnEdit.onclick = () => editRepresentative(rep);

                    const btnDelete = document.createElement('button');
                    btnDelete.className = 'btn-delete';
                    btnDelete.textContent = 'Excluir';
                    btnDelete.onclick = () => deleteRepresentative(rep.representative_id);

                    btnGroup.appendChild(btnEdit);
                    btnGroup.appendChild(btnDelete);

                    li.appendChild(btnGroup);
                    li.appendChild(infoDiv);

                    list.appendChild(li);
                });
            } catch (err) {
                console.error(err);
            }
        }

        async function createOrUpdateRepresentative(event) {
            event.preventDefault();

            const representative_name = document.getElementById('representative_name').value.trim();
            const representative_email = document.getElementById('representative_email').value.trim();
            const representative_phone = document.getElementById('representative_phone').value.trim();
            const city_id = document.getElementById('city_id').value;
            const editingId = document.getElementById('editing_id').value;

            if (!representative_name || !representative_email || !representative_phone || !city_id) {
                alert('Preencha todos os campos!');
                return;
            }

            const payload = {
                representative_name,
                representative_email,
                representative_phone,
                city_id
            };

            try {
                let res;
                if (editingId) {
                    res = await fetch(`/api/representatives/${editingId}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(payload)
                    });
                } else {
                    res = await fetch('/api/representatives', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(payload)
                    });
                }

                const data = await res.json();

                if (res.ok) {
                    alert(editingId ? 'Representante atualizado com sucesso!' : 'Representante cadastrado com sucesso!');
                    document.getElementById('representative-form').reset();
                    document.getElementById('editing_id').value = '';
                    document.getElementById('cancel-edit').style.display = 'none';
                    loadRepresentatives();
                } else {
                    alert(data.message ?? 'Erro ao salvar representante.');
                }
            } catch (err) {
                console.error(err);
                alert('Erro ao salvar representante.');
            }
        }

        function editRepresentative(rep) {
            document.getElementById('representative_name').value = rep.representative_name;
            document.getElementById('representative_email').value = rep.representative_email;
            document.getElementById('representative_phone').value = rep.representative_phone;
            document.getElementById('city_id').value = rep.city_id;
            document.getElementById('editing_id').value = rep.representative_id;
            document.getElementById('cancel-edit').style.display = 'inline-block';
        }

        function cancelEdit() {
            document.getElementById('representative-form').reset();
            document.getElementById('editing_id').value = '';
            document.getElementById('cancel-edit').style.display = 'none';
        }

        async function deleteRepresentative(id) {
            if (!confirm('Tem certeza que deseja excluir este representante?')) return;

            try {
                const res = await fetch(`/api/representatives/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json'
                    }
                });

                const data = await res.json();

                if (res.ok) {
                    alert('Representante deletado com sucesso!');
                    loadRepresentatives();
                } else {
                    alert(data.message ?? 'Erro ao deletar representante.');
                }
            } catch (err) {
                console.error(err);
                alert('Erro ao deletar representante.');
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            loadCities();
            loadRepresentatives();
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