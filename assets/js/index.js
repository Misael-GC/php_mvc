document.addEventListener("DOMContentLoaded", function() {
    // Enviar formulario de contacto
    const send = document.querySelector('#send_contact');

    if(send){
        send.addEventListener('click', async (e)=>{
            e.preventDefault();

            let removerClase = document.querySelectorAll('.remover-this');
            if(removerClase.length > 0){
                for(let i = 0; i < removerClase.length; i++){
                    removerClase[i].parentNode.removeChild(removerClase[i]);
                }
            }

            const form = new FormData(document.querySelector('#form_contact'));
            await sendForm(form);
        });
    }

    async function sendForm(form) {
        try {
            const res = await fetch(base_url + 'contact', {
                method: 'POST',
                body: form
            })

            if(res.ok){
                const result = await res.json();
                alert(result.data);
                location.href = base_url;
            }else{
                // const error = await res.json();
                // alert(error)

            // 1. (Opcional pero recomendado) Limpiar errores anteriores
            document.querySelectorAll('.remove-this').forEach(el => el.remove());
            document.querySelectorAll('.resaltar').forEach(el => el.classList.remove('resaltar'));

            // 2. Obtener el objeto JSON del error
            const errorResponse = await res.json();
            
            // 3. Acceder a la propiedad 'data'
            const errorData = errorResponse.data;

            // 4. Iterar sobre las claves del objeto de error (ej. "name", "email", "age")
            for (const resultadoKey in errorData) {
                
                // 5. Buscar el input correspondiente (ej. id="name")
                const inputElement = document.querySelector('#' + resultadoKey);

                if (inputElement) {
                    // 6. Aplicar la lógica para mostrar el error
                    let padre = inputElement.parentNode;
                    padre.classList.add('resaltar');
                    
                    let txt = document.createElement('p');
                    txt.classList.add('text-danger');
                    txt.classList.add('remove-this'); // Esta clase ayudará a limpiarlo después
                    txt.innerHTML = errorData[resultadoKey]; // El mensaje de error
                    
                    // 7. Insertar el mensaje de error después del input
                    inputElement.insertAdjacentElement('afterend', txt);
                }
            }
            }
        } catch (error) {
            console.log(`error de red o fallo del fetch`, error);
            alert("Hubo un error con el servidor " + error);
        }
    }

    // Eliminar contacto
    const deleteContact = document.querySelectorAll('.delete');
    deleteContact.forEach(contact => {
        contact.addEventListener('click', async function handleClick(e){
            const contactId = e.target.dataset.id;
            // console.log('Eliminar contacto con ID:', contactId);
            deleteContactById(contactId);
        })
    });


    async function deleteContactById(contactId) {
        try {
            const res = await fetch(base_url + 'contact/' + contactId, {
                method: 'DELETE'
            })
            if(res.ok){
                const result = await res.json();
                alert(result.data);
                location.href = base_url;
            }else{
                const error = await res.json();
                alert(error);
            }
        } catch (error) {
            console.log(`error de red o fallo del fetch`, error);
            alert("Hubo un error con el servidor " + error);
        }
    }

    // Editar contacto
    const edit = document.querySelector('#edit_contact');
    if(edit){
        edit.addEventListener('click', async (e)=>{
            e.preventDefault();

            const myHeaders = new Headers();
            myHeaders.append("Content-Type", "application/x-www-form-urlencoded");
            const form = new FormData(document.querySelector('#form_contact'));
            const urlencoded = new URLSearchParams(form);

            const requestOption = {
                method: 'PUT',
                headers: myHeaders,
                body: urlencoded,
                redirect: 'follow'
            };

            editData(requestOption, id_contact);
        });
    }

    async function editData(requestOption, id_contact) {
        try {
            const res = await fetch(base_url + 'contact/' + id_contact, requestOption);
            if(res.ok){
                const result = await res.json();
                alert(result.data);
                location.href = base_url;
            }else{
                const error = await res.json();
                alert(error);
            }
        } catch (error) {
            // let e = error.json();
            alert("Hubo un error con el servidor " + error);
        }
    }

});