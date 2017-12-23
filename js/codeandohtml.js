// === Create Article / Markdown === //
// ================================= //
getTagsByTag = function(){
    
    var tagsElem = $(".tagsd");
    var tagObj = [];
    
    $.each(tagsElem , function (index, value){
        tagObj.push($(value).attr("data-tag"));
    });
    
    return tagObj;    
}

$("#btnSave").click(function(){

    var title = $("#titulo").val();
    var content = $(".editormd-markdown-textarea").val();
    var url = $("#urlBase").val();
    var id_img = $("#path_img").val();
    //Obtener tags seleccionado
    var tagsObj = getTagsByTag();

    if(validate(title, content, id_img, tagsObj.length)){
        MaterialDialog.dialog("¿Desea publicar este artículo? <br> - Quedará pendiente de revisón por un Administrador.", {
            title:"Confirmación",
            modalType:"modal", // Can be empty, modal-fixed-footer or bottom-sheet
            buttons:{
                // Use by default close and confirm buttons
                close:{
                    className:"red",
                    text:"Cerrar",
                    callback:function(){
                        // alert("closed!");
                    }
                },
                confirm:{
                    className:"blue",
                    text:"Publicar",
                    modalClose:true,
                    callback:function(){
                        $("#save_exit").val(1);
                        saveArticle(0, $("#article_id").val(), url, $("#preview_id").val());
                    }
                }
            }
        });
    }

});

$("#btnPreview").click(function(){
    var url = $("#urlBase").val();
    var article_id = $("#article_id").val();
    var preview_id = $("#preview_id").val();
    saveArticle(1, article_id, url, preview_id);
});

function saveArticle(preview,id, url, preview_id){
    
    var title = $("#titulo").val();
    var subtitle = $("#subtitulo").val();
    var content = $(".editormd-markdown-textarea").val();
    var id_img = $("#path_img").val();
    
    var urlInsert = url + "php/insert-article.php";
    // console.log(url, urlInsert); return false;
    //Obtener tags seleccionado
    var tagsObj = getTagsByTag();
    
    if(validate(title, content, id_img, tagsObj.length)){
        $.ajax({
            type: 'POST',
            url: urlInsert,
            data: {"titulo":title,"subtitulo":subtitle,"contenido":content,"id":id,"preview":preview,"id_img":id_img,"tags":tagsObj,"idPreview":preview_id},
            beforeSend: function(){
                $(".loading").slideDown(400);
                $("#preview-article").slideUp(400);
            },
            complete: function(){
                $(".loading").slideUp(400);
                $("#preview-article").slideDown(400);
            },
            success: function(data){
                if(data.success){
                    //Si se retorna el ID y el valor preview == 1, quiere decir que es un preview
                    if((data.id || data.idPreview) && data.preview == 1){
                        $("#preview-article").load(url+"src/preview.php/" + data.idPreview);
                        $("#article_id").val(data.id);
                        $("#preview_id").val(data.idPreview);
                    }else{ //De lo contrario sólo redireccionará a la página principal
                        console.log("TODO OK...");
                        $(location).attr('href',url+'index.php');
                    }
                }else{
                    console.log(data.message);
                }
            }
        });    
    }
    
}

//Función que valida los campos vación al guardar o preview el artículo
function validate(title, content, img, tags){
    var text = "";
    if(title == ""){
        text += "- <b>Título no puede estar vacío.</b>";
    }
    if(img == ""){
        text += "<br>- <b>Debe seleccionar una imagen.</b>";
    }
    if(content == ""){
        text += "<br>- <b>Se tiene que agregar un contenido al artículo.</b>";
    }
    if(tags == 0){
        text += "<br>- <b>Se tiene que agregar al menos un tag.</b>";
    }
    
    if(text != ""){
        MaterialDialog.alert( text, {
            title:'Validando datos', // Modal title
            buttons:{ // Receive buttons (Alert only use close buttons)
                close:{
                    text:'Cerrar', //Text of close button
                    className:'red', // Class of the close button
                    callback:function(){ }// Function for modal click
                }
            }
        });
        return false;
    }else{
        console.log("VALIDACIÓN BIEN");
        return true;
    }
}

//Load more card in Index
var loadMoreCard = function(last_id){
    
    $.ajax({
        type: 'POST',
        url: "php/load-cards.php",
        data: {"last_id":last_id},
        beforeSend: function(){
            $(".loading").slideDown(400);
            // $("#preview-article").slideUp(400);
        },
        complete: function(){
            // $(".progress").hide();
            // $("#preview-article").slideDown(400);
        },
        success: function(data){
            $(".button-more").remove();
            
            setTimeout(function() {
                $(".content-card").append(data);
                $('.card-data').fadeIn(1000);
                $(".loading").hide();
            }, 1000);
            
            
        }
    });    
    
}

//Eliminar un registro preview
$(".btn-cancel-preview").click(function(){
    var id_preview = $(this).attr("data-preview");
    var url = $("#urlBase").val();
    
    MaterialDialog.dialog("¿Desea cancelar el artículo pendiente?", {
        title:"Confirmación",
        modalType:"modal", // Can be empty, modal-fixed-footer or bottom-sheet
        buttons:{
            // Use by default close and confirm buttons
            close:{
                className:"red",
                text:"Cerrar",
                callback:function(){}
            },
            confirm:{
                className:"red",
                text:"Aceptar",
                modalClose:true,
                callback:function(){
                    $.ajax({
                        type: 'POST',
                        url: url + 'php/request-ajax.php',
                        data: {type: '1',"id":id_preview},
                        success: function(data){
                            if(data.success){ //page reload
                                location.reload();
                            }else{ //show error
                                Materialize.toast("Ha ocurrido un error al cancelar el artículo", 5000 );
                            }
                        }
                    });
                }
            }
        }
    });
    
});

$( ".form-login" ).on( "submit", function( event ) {
    event.preventDefault();

    var email = $("#email").val();
    var password = $("#password").val();

    if(email == "" || password == ""){
      
      //class error
      $("#email").addClass('error-form');
      $("#password").addClass('error-form');
      
    }else{
        //submit login
        $.ajax({
            type: 'POST',
            url: 'php/login-user',
            data: {"email":email,"password":password},
            beforeSend: function(){},
            complete: function(){},
            success: function(data){
                if(data.success){
                    $(".error-pass").hide();
                    $(location).attr('href','index');
                    //redirect
                }else{
                    $(".error-pass").show();
                }
              
            }
        });
      
    }
  
});