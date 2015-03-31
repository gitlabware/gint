$('#listaventas').dataTable({
    'bProcessing': true,
    'sAjaxSource': urljsontablatrab,
    'sServerMethod': 'POST',
    "order": []
});