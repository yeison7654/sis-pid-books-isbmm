document.addEventListener("DOMContentLoaded", () => {
    loadTable();
    setTimeout(() => {
        deleteAutor()
    }, 1000);
})

function loadTable() {
    let url = url_logic + "autors/read.php";
    try {
        alertas({
            status: true,
            title: "Cargando",
            text: "La informacion de la tabla esta cargando",
            date: "",
            type: "info",
        }, 2)
        fetch(url)
            .then(response => response.json())
            .then(result => {
                if (result.status) {
                    data = result.data;
                    const tablebody = document.querySelector("#table tbody");
                    tablebody.innerHTML = "";
                    data.forEach(element => {
                        const row = document.createElement('tr');
                        row.innerHTML = `<td>${element.autorId}</td>
                                         <td>${element.a_name}</td>
                                         <td>${element.a_nacionalidad}</td>                                    
                                         <td>
                                            <button class="btn-update">Actualizar</button>
                                            <button data-id="${element.autorId}" data-name="${element.a_name}" class="btn-delete">Eliminar</button>
                                         </td>`
                        tablebody.appendChild(row);
                    });
                } else {
                    alertas(result, 3);
                }

            })
    } catch (error) {
        console.log(error);
    }
}

function deleteAutor() {
    let btnDelete = document.querySelectorAll(".btn-delete");
    btnDelete.forEach(element => {
        element.addEventListener("click", () => {
            let id = element.getAttribute("data-id");
            let name = element.getAttribute("data-name")
            let data = new FormData();
            data.append("idAutor", id);
            let encabezados = new Headers();
            let config = {
                method: "POST",
                headers: encabezados,
                node: "cors",
                cache: "no-cache",
                body: data,
            }
            let url = url_logic + "autors/delete.php";
            try {
                fetch(url, config)
                    .then(response => response.json())
                    .then(result => {
                        console.log(result)
                    })
            } catch (error) {
                console.log(error)
            }
        })
    })
}