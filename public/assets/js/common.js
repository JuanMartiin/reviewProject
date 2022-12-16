
(function () {

    let form = document.getElementById('deleteForm');

    if(form) {
        document.addEventListener('click', clickElement);
        //este evento se dispara cuando se hace submit desde el formulario,
        //pero no cuando se hace form.submit() desde el código
        form.addEventListener('submit', submitForm);
    }

    function clickElement(event) {
        var target = event.target;
        if(target.tagName === 'A' && target.getAttribute('class') === 'deleteRow') {
            event.preventDefault();
            let text = target.dataset.name;
            let url = target.dataset.url;
            confirmDelete(text, url);
        }
    }

    function confirmDelete(text, url) {
        if(confirm('Delete ' + text + '?')) {
            form.action = url;
            form.submit();
        }
    }

    function submitForm(event) {
        if(!confirm('Delete?')) {
            event.preventDefault();
        }
    }

})();

