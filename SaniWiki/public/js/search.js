/* --- USER SEARCH --- */
$(document).ready( function () {
    $('#usersTable').DataTable({
        "page": 1,
        "iDisplayLength": 25,
        "iDisplayStart": 25,
        "oLanguage": {
            "oPaginate": {
                "sFirst": "Prima pagina", // This is the link to the first page
                "sPrevious": "Pagina precedente", // This is the link to the previous page
                "sNext": "Pagina successiva", // This is the link to the next page
                "sLast": "Ultima pagina" // This is the link to the last page
            },
            "sSearch": "Ricerca",
            "sEmptyTable": "Non ci sono utenti nella tabella",
            "sInfo": "Ci sono in totale _TOTAL_ utenti (_START_ to _END_)",
            "sInfoEmpty": "Non ci sono utenti da mostrare",
            "sInfoFiltered": " - filtrati al massimo _MAX_ utenti",
            "sLengthMenu": "Mostra _MENU_ utenti",
        }
    }).page('first').draw();


} );

/* --- POST SEARCH --- */
$(document).ready( function () {

    $('#postsTable').DataTable({
        "page": 1,
        "iDisplayLength": 25,
        "iDisplayStart": 25,
        "ordering": false,
        "oLanguage": {
            "oPaginate": {
                "sFirst": "Prima pagina", // This is the link to the first page
                "sPrevious": "Pagina precedente", // This is the link to the previous page
                "sNext": "Pagina successiva", // This is the link to the next page
                "sLast": "Ultima pagina" // This is the link to the last page
            },
            "sSearch": "Ricerca",
            "sEmptyTable": "Non ci sono articoli nella tabella",
            "sInfo": "Ci sono in totale _TOTAL_ articoli (_START_ to _END_)",
            "sInfoEmpty": "Non ci sono articoli da mostrare",
            "sInfoFiltered": " - filtrati al massimo _MAX_ articoli",
            "sLengthMenu": "Mostra _MENU_ articoli"
        }
    }).page('first').draw();
} );