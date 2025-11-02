document.addEventListener("DOMContentLoaded", function() {
    // Enviar formulario de contacto
    const send = document.querySelector('#send_contact');

    if(send){
        send.addEventListener('click', async (e)=>{
            e.preventDefault();
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
                const error = await res.json();
                alert(error);
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