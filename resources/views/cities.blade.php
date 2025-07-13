<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <title>Cadastro de Cidade</title>
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
            gap: 5px;
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
    </style>
</head>

<body>
    <h1>Cadastro de Cidade</h1>

    <form id="city-form" onsubmit="createCity(event)">
        <input type="hidden" id="editing_id" value="">
        <input type="text" id="city_name" placeholder="Nome da cidade" required>
        <input type="text" id="city_uf" placeholder="UF" maxlength="2" required>
        <button type="submit">Cadastrar Cidade</button>
        <button type="button" id="cancel-edit" style="display:none; margin-top:10px;" onclick="cancelEdit()">Cancelar Edição</button>
    </form>

    <h2>Cidades Cadastradas</h2>
    <ul id="cities-list"></ul>

    <script>
        async function loadCities() {
            try {
                const res = await fetch('/api/cities');
                const data = await res.json();
                const list = document.getElementById('cities-list');
                list.innerHTML = '';

                data.data.forEach(city => {
                    const li = document.createElement('li');

                    // Div com info da cidade
                    const infoDiv = document.createElement('div');
                    infoDiv.className = 'city-info';
                    infoDiv.textContent = `${city.city_name} - ${city.city_uf}`;

                    // Grupo de botões
                    const btnGroup = document.createElement('div');
                    btnGroup.className = 'btn-group';

                    // Botão editar
                    const btnEdit = document.createElement('button');
                    btnEdit.className = 'btn-edit';
                    btnEdit.textContent = 'Editar';
                    btnEdit.onclick = () => editCity(city);

                    // Botão deletar
                    const btnDelete = document.createElement('button');
                    btnDelete.className = 'btn-delete';
                    btnDelete.textContent = 'Excluir';
                    btnDelete.onclick = () => deleteCity(city.city_id);

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

        async function createCity(event) {
            event.preventDefault();

            const city_name = document.getElementById('city_name').value.trim();
            const city_uf = document.getElementById('city_uf').value.trim();
            const editingId = document.getElementById('editing_id').value;

            if (!city_name || !city_uf) {
                alert('Preencha todos os campos!');
                return;
            }

            try {
                let res;
                if (editingId) {
                    // PUT para atualizar
                    res = await fetch(`/api/cities/${editingId}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            city_name,
                            city_uf
                        })
                    });
                } else {
                    // POST para criar
                    res = await fetch('/api/cities', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            city_name,
                            city_uf
                        })
                    });
                }

                const data = await res.json();

                if (res.ok) {
                    alert(editingId ? 'Cidade atualizada com sucesso!' : 'Cidade cadastrada com sucesso!');
                    document.getElementById('city-form').reset();
                    document.getElementById('editing_id').value = '';
                    document.getElementById('cancel-edit').style.display = 'none';
                    loadCities();
                } else {
                    alert(data.message ?? 'Erro ao salvar cidade.');
                }
            } catch (err) {
                console.error(err);
                alert('Erro ao salvar cidade.');
            }
        }

        function editCity(city) {
            document.getElementById('city_name').value = city.city_name;
            document.getElementById('city_uf').value = city.city_uf;
            document.getElementById('editing_id').value = city.city_id;
            document.getElementById('cancel-edit').style.display = 'inline-block';
        }

        function cancelEdit() {
            document.getElementById('city-form').reset();
            document.getElementById('editing_id').value = '';
            document.getElementById('cancel-edit').style.display = 'none';
        }

        async function deleteCity(id) {
            if (!confirm('Tem certeza que deseja excluir esta cidade?')) return;

            try {
                const res = await fetch(`/api/cities/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });

                const data = await res.json();

                if (res.ok) {
                    alert('Cidade deletada com sucesso!');
                    loadCities();
                } else {
                    alert(data.message ?? 'Erro ao deletar cidade.');
                }
            } catch (err) {
                console.error(err);
                alert('Erro ao deletar cidade.');
            }
        }

        document.addEventListener('DOMContentLoaded', loadCities);
    </script>
</body>

</html>