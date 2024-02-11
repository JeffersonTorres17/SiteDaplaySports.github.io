<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

// Recebe os dados do placar via POST
$time = $_POST['time'];
$valor = intval($_POST['valor']);

// Carrega os valores atuais do placar
$placarA = intval(file_get_contents('placarA.txt'));
$placarB = intval(file_get_contents('placarB.txt'));

// Atualiza o placar conforme a ação recebida
if ($time == 'A') {
    $placarA += $valor;
} elseif ($time == 'B') {
    $placarB += $valor;
}

// Salva os novos valores do placar
file_put_contents('placarA.txt', $placarA);
file_put_contents('placarB.txt', $placarB);

// Retorna os novos valores do placar como JSON
echo "data: " . json_encode(['placarA' => $placarA, 'placarB' => $placarB]) . "\n\n";
flush();
?>
