document.addEventListener('click', function(event) {
    const clickedElement = event.target;
    if (clickedElement.tagName === 'INPUT' && clickedElement.id === 'powrot') {
        const inputs = document.querySelectorAll('input[name="do_kogo"], textarea[name="wiadomosc"]');
        for (const input of inputs) {
        input.required = false;
        }
    }})