<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

<style>
    table{
        width:100%;
        text-align:center;
    }
    .caixa{
        width:60%;
        margin:auto;
        background:#eee;
        border: black 1px solid;
        padding:10px;
    }    
</style>
    <h1 class="mt-3 text-primary">
        Bicho Eventos
    </h1>
    <hr>
<div class='caixa'>
<?php
        include_once('bd/conexao.php');
        $operacao = $_GET['op']??"n";
        if($operacao=="ins"){
            $stmt = $conn->prepare("INSERT INTO agenda (evento, artista, dt) 
            VALUES(:EV, :AR, :DT)");

            $evento = $_GET['evento']??"";
            $artista = $_GET['artista']??"";
            $dt = $_GET['dt']??"";
            
            $stmt->bindParam(":EV", $evento);
            $stmt->bindParam(":AR", $artista);
            $stmt->bindParam(":DT", $dt);
            
            $stmt->execute();
        }
        if($operacao=="del"){
            $stmt = $conn->prepare("DELETE FROM agenda WHERE id = :ID");
            $id = $_GET['id']??"";
            $stmt->bindParam(":ID", $id);
            $stmt->execute();
        }

        if($operacao=="atu"){
            $stmt = $conn->prepare("SELECT * FROM agenda WHERE id = :ID");
            $id = $_GET['id']??"";
            $stmt->bindParam(":ID", $id);
            $stmt->execute();
        }
    ?>

    <form>
        <label class="label_control">Evento</label>                        
        <?php
            $op = $_GET['op']??"";            
            if($op=="ins"){
                echo "
                <input type='hidden' name='op' value='ins'>
                <input class='form_control' type='text' name='evento'>
                <label class='label_control'>Artista</label>
                <input class='form_control'  type='text' name='artista'>
                <label class='label_control'>Data</label>
                <input class='form_control' type='date' name='dt'>
                ";
            }
            if($op=="atu"){
                echo "<input type='hidden' name='op' value='atu'>";
            }   
        ?>
        <input class="form_control" type="text" name="evento">
        <label class="label_control">Artista</label>
        <input class="form_control"  type="text" name="artista">
        <label class="label_control">Data</label>
        <input class="form_control" type="date" name="dt">
        <button onclick="acao()">
            <?php
                $ac = $_GET['op']??"n";
                if($ac=="atu"){
                    echo "Atualizar";
                }
                else{
                    echo "Cadastrar";
                }
            ?>
        </button>
    </form>

    <?php
        // Conexão com Banco de Dados
        include_once('bd/conexao.php');


        $exibe = $conn->prepare("SELECT * FROM AGENDA");
        $exibe->execute();
        $resultado = $exibe->fetchAll();

        echo "<table class='table table-striped'>
            <tr>
            <td>
            id
            </td>
            <td>
            Evento
            </td>
            <td>
            Artista
            </td>
            <td>
            Data
            </td>
            <td>
            Ação
            </td>
            </tr>      
            ";

        foreach ($resultado as $campo){
            $id = $campo['id'];
            echo "<tr>";
            echo "<td>".$campo['id']."</td>";
            echo "<td>".$campo['evento']."</td>";
            echo "<td>".$campo['artista']."</td>";
            echo "<td>".$campo['dt']."</td>";
            echo "<td>"; 
            echo" <a onclick='acao()' href='index.php?op=del&id=".$id."'>Excluir</a>";
            echo" <a href='index.php?op=atu&id=".$id."'>Atualizar</a>";
            echo" </td>";
            echo "</tr>";
        }
            echo " </table>";
    ?>

    <hr>

    <form action="bd/delete.php">
        <label> Qual ID deletar?</label>
        <input type="number" name="id">
        <button>
            Delete!!
        </button>
    </form>  
</div>

<script>
    acao(){
        location.reload();
    }
</script>