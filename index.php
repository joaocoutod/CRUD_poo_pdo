<?php
include_once "app/conexao/Conexao.php";
include_once "app/crud/produto_crud.php";
include_once "app/model/Produto.php";

//instancia as classes
$produto = new Produto();
$produtocrd = new ProdutoCRD();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <!-- CSS -->
    <link rel="stylesheet" href="lib/css/modal.css">
    <link rel="stylesheet" href="lib/css/stl.css">

    <!-- JQUERY -->
    <script type="text/javascript" src="lib/js/jquery.js"></script>
</head>
<body>
    <div class="container">

        <!-- formulario de inserção de produtos -->
        <div class="form-produto">
            <form id="inserir-form" method="POST">
                <div class="group-form" id="alert"></div>
                <div class="group-form">
                    <input type="hidden" name="cadastrar">

                    <label for="nome">Nome do Produto</label>
                    <input type="text" name="nome" id="nome">

                    <label for="preco">Preço</label>
                    <input type="number" name="preco" id="preco">

                    <label for="cor">Cor</label>
                    <select id="cor" name="cor">
                        <option value="azul">Azul </option>
                        <option value="vermelho">Vermelho</option>
                        <option value="amarelo">Amarelo</option>
                    </select>
                    <button type="submit" id="inserir">Inserir Produto</button>
                </div>
            </form>
        </div>

        <hr>


        <div class="listadeprodutos">
            <h2>Lista de produtos</h2>

            <!--formulario de busca-->
            <form class="busca">
                <input type="text" id="busca" placeholder="buscar por nome" onkeyup="filtro_nome()" name="buscar">
            </form>

            <!--Tabla de produtos-->
            <table id="produtos">
                <tr class="theader">
                    <th>Produto</th>
                    <th>Cor</th>
                    <th>Preço com desconto</th>
                    <th class='text-center'>Ações</th>
                </tr>

                <!-- exibe produtos do banco de dados -->
                <?php foreach ($produtocrd->read() as $produto) : ?>
                <tr class="tbody">
                    <td><?= $produto->getNome() ?></td>
                    <td><?= $produto->getCor() ?></td>
                    <td>$<?= number_format(substr($produto->getPreco(),1) , 2, ",", ".")?></td>
                    <td class='text-center'>
                        <button class="btn color-success" onclick="document.getElementById('editar><?= $produto->getId() ?>').style.display='block'">
                            Atualizar
                        </button>
                        <a href="app/controller/ProdutosController.php?del=<?= $produto->getId() ?>">
                            <button class="btn color-danger" type="button">Excluir</button>
                        </a>
                    </td>
                </tr>

                <!-- modal para editar produto -->
                <div id="editar><?= $produto->getId() ?>" class="modal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="close" onclick="document.getElementById('editar><?= $produto->getId() ?>').style.display='none'">&times;</span>
                            <h2>Atualizar produto</h2>
                        </div>
                        <div class="modal-body">
                            <form action="app/controller/ProdutosController.php" method="POST">
                                <div class="ctn">
                                    <label for="nome">Nome do Produto</label>
                                    <input type="text" name="nome" id="nome" value="<?= $produto->getNome() ?>" required>
                                </div>
                                <div class="modal-footer">
                                    <div class="ctn">
                                        <input type="hidden" name="id" value="<?= $produto->getId() ?>" />
                                        <button type="button" class="color-danger btn-close" onclick="document.getElementById('editar><?= $produto->getId() ?>').style.display='none'">Fechar</button>
                                        <button type="submit" class="color-success btn-att" name="editar">Atualizar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> <!-- ./modal -->
                <?php endforeach ?>
            </table>

        </div><!-- ./listaprodutos -->
    </div>


    <!-- JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script type="text/javascript" src="lib/js/modal.js"></script>
    <script type="text/javascript" src="lib/js/filtros.js"></script>
    <script type="text/javascript" src="lib/js/main.js"></script>
</body>
</html>