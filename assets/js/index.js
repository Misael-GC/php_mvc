document.addEventListener("DOMContentLoaded", function() {
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

});