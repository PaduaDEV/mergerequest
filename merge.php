<?php
//Conexão com o banco de dados
$conn = new mysqli("localhost", "usuario", "senha", "nome_do_banco");

//Verifica se houve erro na conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

//Consulta para buscar os dados
$sql = "SELECT Tb_banco.nome, Tb_convenio.verba, Tb_contrato.codigo, Tb_contrato.data_inclusao, Tb_contrato.valor, Tb_contrato.prazo 
        FROM Tb_contrato 
        INNER JOIN Tb_convenio_servico ON Tb_contrato.convenio_servico = Tb_convenio_servico.codigo 
        INNER JOIN Tb_convenio ON Tb_convenio_servico.convenio = Tb_convenio.codigo 
        INNER JOIN Tb_banco ON Tb_convenio.banco = Tb_banco.codigo";

$resultado = $conn->query($sql);

//Verifica se há resultados
if ($resultado->num_rows > 0) {
    //Exibição dos dados em uma tabela HTML
    echo "<table>
            <tr>
                <th>Nome do banco</th>
                <th>Verba</th>
                <th>Código do contrato</th>
                <th>Data de inclusão</th>
                <th>Valor</th>
                <th>Prazo</th>
            </tr>";
    //Saída de dados de cada linha
    while($linha = $resultado->fetch_assoc()) {
        echo "<tr>
                <td>".$linha["nome"]."</td>
                <td>".$linha["verba"]."</td>
                <td>".$linha["codigo"]."</td>
                <td>".$linha["data_inclusao"]."</td>
                <td>".$linha["valor"]."</td>
                <td>".$linha["prazo"]."</td>
            </tr>";
    }
    echo "</table>";
} else {
    echo "Não foram encontrados resultados.";
}

//Fecha a conexão com o banco de dados
$conn->close();
?>
