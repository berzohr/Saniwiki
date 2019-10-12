var categoryToDelete;
var categoryToEdit;
var counterEditor;
var path;

window.onload = function () {
    var counter = 1;
    var close = document.getElementById("close");
    var next = document.getElementById("next");
    var cont1 = document.getElementById("newCategoryInfo");
    var cont2 = document.getElementById("addSections");
    categoryToDelete = document.getElementById("cat_id");
    categoryToEdit = document.getElementById("cat_id");
    path = $('#newCat').attr('action').replace('addCategory', '');

    console.log('path: ' + path);



    next.onclick = function () {
        if (!cont1.classList.contains("hide")) {
            cont1.classList.remove("show");
            cont1.classList.add("hide");
            cont2.classList.remove("hide");
            cont2.classList.add("show");
            document.getElementById("save").classList.remove("hide");
            next.innerText = "Indietro";
        } else {
            cont1.classList.remove("hide");
            cont1.classList.add("show");
            cont2.classList.remove("show");
            cont2.classList.add("hide");
            document.getElementById("save").classList.add("hide");
            next.innerText = "Avanti";
        }
    }

    close.onclick = function () {
        $("#categoryBgImage").val('');
        cont1.classList.remove("hide");
        cont1.classList.add("show");
        cont2.classList.remove("show");
        cont2.classList.add("hide");
        document.getElementById("save").classList.add("hide");
        next.innerText = "Avanti";
        counter = 1;
        //pulizia pannello
        var initialSectionContent = '' +
            '<div>' +
            '   <div class="input-group mb-3">' +
            '       <div class="input-group-prepend">' +
            '           <span class="input-group-text" id="sectionName1-label">Nome</span>' +
            '       </div>\n' +
            '       <input type="text" class="form-control" placeholder="Nome sezione" aria-label="Name" aria-describedby="sectionName1-label" name="sectionName1" required>' +
            '   </div>\n' +
            '<div class="input-group mb-2">' +
            '   <div class="input-group-prepend">' +
            '       <div class="input-group-text">' +
            '           <span>Icona&nbsp;</span> <span class="input-group-addon"></span>' +
            '       </div>' +
            '   </div>' +
            '   <input data-placement="bottomRight" id="sectionImage1" class="form-control icp icp-auto icon-picker" value="fas fa-question" type="text" name="sections[section1][icon]" required/>\n' +
            '</div>'+
            '</div>' +
            '<hr>';
        var parent = document.getElementById("newSections");
        parent.innerHTML = initialSectionContent;
        $.getScript(path+"/js/fontawesome-iconpicker.min.js", function() {
            jQuery(document).ready(function($){
                $(function () {
                    $('.icon-picker').iconpicker();
                });
            });
        });
    }

    document.getElementById("addNewSection").onclick = function () {
        counter++;
        var newEl = '' +
            '<div id="sectionContent'+counter+'">' +
            '   <div class="input-group mb-3">' +
            '       <div class="input-group-prepend">' +
            '           <span class="input-group-text" id="sectionName' + counter + '-label">Nome</span>' +
            '       </div>' +
            '       <input type="text" class="form-control" placeholder="Nome sezione" aria-label="Name" aria-describedby="sectionName' + counter + '-label" name="sections[section' + counter + '][name]">' +
            '   </div>' +
            '<div class="input-group mb-2">' +
            '   <div class="input-group-prepend">' +
            '       <div class="input-group-text">' +
            '           <span>Icona&nbsp;</span> <span class="input-group-addon"></span>' +
            '       </div>' +
            '   </div>' +
            '   <input data-placement="bottomRight" id="sectionImage'+counter+'" class="form-control icp icp-auto icon-picker" value="fas fa-question" type="text" name="sections[section'+counter+'][icon]" required/>\n' +
            '</div>'+
            '<div class="deleteSectionDiv">' +
            '<button class="btn btn-danger deleteSection" onClick="deleteSection('+counter+')" ' +
            'data-catid={{$category-><i class="fas fa-trash-alt"></i></button></div>'+
            '</div><hr id="sectionHr'+counter+'">';
        console.log('counter:' + counter);
        var parent = document.getElementById("newSections");
        parent.insertAdjacentHTML('beforeend', newEl);

        $.getScript(path+"/js/fontawesome-iconpicker.min.js", function() {
            jQuery(document).ready(function($){
                $(function () {
                    $('.icon-picker').iconpicker();
                });
            });
        });
    }
}

function categoryDelete(id) {
    categoryToDelete.value = id;
}

function categoryEdit(category) {
    var parent = document.getElementById("categoryEditor");
    console.log("category ID init: " + category['id']);
    var html =
        '<div class="modal-header">' +
        '<h4 class="modal-title">Modifica categoria</h4>' +
        '<button type="button" class="close" data-dismiss="modal">x</button>' +
        '</div>' +
        '<div class="modal-body">' +
        '<!--alert errori? -->' +
        '<section id="newCategoryInfoEdit">' +
        '<h4>Informazioni categoria</h4>' +
        '<div class="input-group mb-3">' +
        '<div class="input-group-prepend">' +
        '<span class="input-group-text" id="categoryNameEditor-label">Nome</span>' +
        '</div>' +
        '<input type="text" class="form-control" placeholder="Nome categoria"' +
        '       aria-label="Name" aria-describedby="categoryNameEditor-label"' +
        '       name="name" value="' + category['name'] + '" required>' +
        '<input type="hidden" name="categoryID" value="'+category['id']+'" class="form-control hidden">'+
        '</div>' +
        '<div class="input-group mb-3">' +
        '<div class="input-group-prepend">' +
        '<span class="input-group-text" id="categoryOrderEditor-label">Ordine</span>' +
        '</div>' +
        '<select class="form-control" aria-label="Order" aria-describedby="categoryOrderEditor-label" name="type" required>' +
        '<option value="" selected disabled>Seleziona un ordine di visualizzazione</option>';

    if (category['type'] == 1) {
        html += '<option value=1 selected>Nomi dalla A-Z</option>' +
            '<option value=2>Dal più recente</option>' +
            '<option value=3>Dal più vecchio</option>';
    } else if (category['type'] == 2) {
        html += '<option value=1>Nomi dalla A-Z</option>' +
            '<option value=2 selected>Dal più recente</option>' +
            '<option value=3>Dal più vecchio</option>';
    } else {
        html += '<option value=1>Nomi dalla A-Z</option>' +
            '<option value=2>Dal più recente</option>' +
            '<option value=3 selected>Dal più vecchio</option>';
    }
    html += '</select>' +
        '</div>' +
        '<div class="input-group mb-2">' +
        '   <div class="input-group-prepend">' +
        '       <div class="input-group-text">' +
        '           <span>Icona&nbsp;</span> <span class="input-group-addon"></span>' +
        '       </div>' +
        '   </div>' +
        '   <input data-placement="bottomRight" class="form-control icp icp-auto icon-picker" value="'+category['iconFontAw']+'" type="text" name="categoryIcon" />\n' +
        '</div>'+
        '</section>' +

        '<section id="addSectionsEdit" class="hide">' +
        '<h4>Modifica del template</h4>' +
        '<section id="editSections">';

    $.getJSON(path+'/api/sections/' + category["id"], function (data) {
        counterEditor = 0;
        let idSection;
        $.each(data, function (key, val) {
            counterEditor++;
            $.each(val, function (k, v) {
                console.log(k + ": " + v);

                if(k.localeCompare('id') == 0){
                    idSection = v;
                }
                if (k.localeCompare('name') == 0) {
                    html += '<div id="sectionContentEdit'+counterEditor+'"><div class="input-group mb-3"><div class="input-group-prepend">' +
                        '<span class="input-group-text" id="sectionName1-label">Nome</span></div>' +
                        '<input type="text" class="form-control" placeholder="Nome sezione" ' +
                        'aria-label="Name" aria-describedby="sectionName1-label" ' +
                        'name="sections[section'+counterEditor+'][name]" value="'+v+'" required>' +
                        '<input type="hidden" name="sections[section'+counterEditor+'][id]" value="'+idSection+'">';
                    html += '</div>'
                } else if (k.localeCompare('iconFontAw') == 0) {
                    html += '<div class="input-group mb-2">' +
                        '   <div class="input-group-prepend">' +
                        '       <div class="input-group-text">' +
                        '           <span>Icona&nbsp;</span> <span class="input-group-addon"></span>' +
                        '       </div>' +
                        '   </div>' +
                        '   <input data-placement="bottomRight" id="sectionImage'+counterEditor+'" class="form-control icp icp-auto icon-picker" value="'+v+'" type="text" name="sections[section'+counterEditor+'][icon]" required/>\n' +
                        '</div>';
                    html +=  '</div><hr id="sectionHrEdit'+counterEditor+'">';

                }
            })
        });
        html += '</div>' +
            '<div class="modal-footer">' +
            '<!-- controllo errori? -->' +
            '<button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeEdit">Chiudi</button>' +
            '<button type="button" class="btn btn-primary" id="nextEdit">Avanti</button>' +
            '<button type="submit" class="btn btn-primary hide" id="saveEdit">Salva</button>' +
            '</div>';

        parent.innerHTML = html;

        var cont1Edit = document.getElementById("newCategoryInfoEdit");
        var cont2Edit = document.getElementById("addSectionsEdit");
        document.getElementById("nextEdit").onclick = function () {
            if (!cont1Edit.classList.contains("hide")) {
                cont1Edit.classList.remove("show");
                cont1Edit.classList.add("hide");
                cont2Edit.classList.remove("hide");
                cont2Edit.classList.add("show");
                document.getElementById("saveEdit").classList.remove("hide");
                nextEdit.innerText = "Indietro";
            } else {
                cont1Edit.classList.remove("hide");
                cont1Edit.classList.add("show");
                cont2Edit.classList.remove("show");
                cont2Edit.classList.add("hide");
                document.getElementById("saveEdit").classList.add("hide");
                nextEdit.innerText = "Avanti";
            }
        }
    });


    setTimeout(loadIconPick, 500);
}

function loadIconPick(){
    $.getScript(path+"/js/fontawesome-iconpicker.min.js", function() {
        jQuery(document).ready(function($){
            $(function () {
                $('.icon-picker').iconpicker();
            });
        });
    });
}

function deleteSection(id) {
    document.getElementById('sectionContent'+id).remove();
    document.getElementById('sectionHr'+id).remove();
}

function deleteSectionEdit(id) {
    document.getElementById('sectionContentEdit'+id).remove();
    document.getElementById('sectionHrEdit'+id).remove();
}



//funzione per selezione file category background
$(function() {
    $(document).on('change', ':file', function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
    });
    $(document).ready( function() {
        $(':file').on('fileselect', function(event, numFiles, label) {

            var input = $(this).parents('.input-group').find(':text'),
                log = numFiles > 1 ? numFiles + ' files selected' : label;
            if( input.length ) {
                input.val(log);
            } else {
                if( log ) alert(log);
            }
        });
    });

});

