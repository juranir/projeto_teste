<?php
    include_once('db/conexao.php');
    include_once('pdf/mpdf.php');

    $conn = Conexao::getInstance();


    $sql_relatorio = "SELECT email, status FROM newsletter_email ORDER BY id";
    $resultado_relatorio = mysqli_query($conn, $sql_relatorio);
//    $rows_relatorio = mysqli_fetch_assoc($resultado_relatorio);

    $corpo_relatorio = '';
    while ($rows_relatorio = mysqli_fetch_array($resultado_relatorio)){
        $corpo_relatorio = $corpo_relatorio . "<p>E-mail: ".$rows_relatorio['email']."</p>";
        $status = '';
        if ($rows_relatorio['status'] == 1) {
            $status = 'Ativo';
        }else{
            $status = 'Inativo';
        }
        $corpo_relatorio = $corpo_relatorio . "<p>Status: ". $status ."</p> <br />";

    }

    $pagina = "
        <!DOCTYPE html>
            <html lang='pt-br'>
            <head>
                <meta charset='UTF-8'>
                <title>Relatório</title>
            </head>
            <body>
                <img src='images/faculdade_mauricio_nassau.jpeg' alt='Imagem da faculdade Maurício de Nassau'>
                <h1>E-mail cadastrados</h1>
                        ". $corpo_relatorio ."
            </body>
            </html>
        ";

    $arquivo = "Relatorio.pdf";

    $mpdf = new mPDF();
    $mpdf->WriteHTML($pagina);

    $mpdf->Output($arquivo, 'I');

    // I - Arbre no navegador
    // F - Salva no servidor
    // D - Salva o arquivo no computador do usuário