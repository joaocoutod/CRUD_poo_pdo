$(document).ready(function(){
    
    $("#inserir").click(function(){

        var nome = $("#nome").val();
        var preco = $("#preco").val();
        var cor = $("#cor").val();

        if(nome == "" || nome == null || preco == "" || preco == null || cor == "" || cor == null){
            viewalert("danger", "Informe todos os campos corretamente.");
            return false;
        }

    });

    $("#inserir-form").submit(function(){
        
        var insertform = $("#inserir-form")[0];
        var formData = new FormData(insertform);
    
        $.ajax({
            url: "app/controller/ProdutosController.php",
            type: "POST",
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(feedback) {
                if (feedback.status == 1) {
                    document.location.reload();
                } else {
                    viewalert("danger", feedback.msg);
                }
            }
        });

        return false;
    });


    //utilitarios
    function viewalert(type, msg){

        const alerta = `
            <div class="alert color-${type}" role="alert">
                ${msg}
            </div>
        `;

        $("#alert").html(alerta);
    }

});