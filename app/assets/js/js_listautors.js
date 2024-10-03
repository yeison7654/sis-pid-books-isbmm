document.addEventListener("DOMContentLoaded", () => {
    loadTable();
    setTimeout(() => {
        deleteAutor();
        updateAutor();
    }, 1000);
})
document.addEventListener("click", () => {
    deleteAutor();
    updateAutor();
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
        })
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
                                            <button data-id="${element.autorId}" data-name="${element.a_name}" data-nacionalidad="${element.a_nacionalidad}" class="btn-update">Actualizar</button>
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
            Swal.fire({
                title: "¿Estas seguro?",
                text: "Estas seguro de eliminar el registro " + name,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, eliminalo"
            }).then((result) => {
                if (result.isConfirmed) {
                    try {
                        fetch(url, config)
                            .then(response => response.json())
                            .then(result => {
                                if (result.status) {
                                    Swal.fire({
                                        title: "Eliminado",
                                        text: "Se elimino correctamente el registro",
                                        icon: "success"
                                    });
                                    loadTable();
                                } else {
                                    alertas(result, 3);
                                }
                            })
                    } catch (error) {
                        console.log(error)
                    }
                }
            });

        })
    })
}
function updateAutor() {
    let btnUpdate = document.querySelectorAll(".btn-update");
    btnUpdate.forEach(element => {
        element.addEventListener("click", () => {
            let formUpdate = document.querySelector(".form-update");
            formUpdate.classList.toggle("hidden")
            document.querySelector("#idAutor") = element.getAttribute("data-id");
            document.querySelector("#txtName") = element.getAttribute("data-name");
        })
    });
}