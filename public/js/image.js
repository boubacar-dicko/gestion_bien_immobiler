window.onload = () => {
    // gestion des boutons supprimer
    let links = document.querySelectorAll("[data-delete]")

    // On boucle sur links
    for(l of links){
        // On ecoute le click
        l.addEventListener("click", function(e){
            // On empeche la navigation
            e.preventDefault()

            // On demande confirmation
            if(confirm('Voulez-vous supprimer cette image ?')){
                // On envoie une requete ajax vers le href du lien avec la methode DELETE
                fetch(this.getAttribute("href"), {
                    method: "DELETE",
                    headers: {
                        "X-Requested-With": "XMLHttpRequest",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({"_token": this.dataset.token})
                }).then(
                    // On recupere la reponse en json
                    response => response.json()
                ).then(data => {
                    if(data.success)
                        this.parentElement.remove()
                    else
                        alert(data.error)
                }).catch(e => alert(e))

            }
        })
    }
}