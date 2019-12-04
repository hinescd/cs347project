function approveCover(shift, coverer) {
    fetch(`/php/approve_cover.php?shift=${shift}&coverer=${coverer}`)
    .then(response => {
        if(response.ok) {
            Array.from(document.querySelectorAll(`.coverFor${shift}`)).forEach(btn => btn.disabled = true)
        } else {
            alert('Could not approve shift')
        }
    })
}