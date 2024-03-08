<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Função para limpar os valores
    function cleanValue($value) {
        // Remover espaços em branco extras e caracteres não numéricos, exceto ponto decimal
        $cleanedValue = preg_replace("/[^0-9.]/", "", $value);
        // Se o valor termina com .0, remova apenas o ponto decimal
        $cleanedValue = rtrim($cleanedValue, ".");
        return $cleanedValue;
    }

    // Limpar os valores dos campos de entrada
    $loanAmount = cleanValue($_POST['loan_amount']);
    $interestRate = cleanValue($_POST['interest_rate']);
    $loanTerm = cleanValue($_POST['loan_term']);
    $interestType = $_POST['interest_type'];

    // Verificar se os valores são numéricos
    if (is_numeric($loanAmount) && is_numeric($interestRate) && is_numeric($loanTerm)) {
        // Converter a taxa de juros para a forma decimal se estiver em porcentagem
        if (strpos($interestRate, '%') !== false) {
            $interestRate = rtrim($interestRate, '%') / 100; // Remove o símbolo de porcentagem e converte para decimal
        }

        // Calculando os pagamentos mensais
        $interestMultiplier = ($interestType === 'annual') ? 1 : 12; // Define o multiplicador com base no tipo de juros
        $monthlyInterest = $interestRate / $interestMultiplier;
        $monthlyPayments = ($loanAmount * $monthlyInterest) / (1 - pow(1 + $monthlyInterest, -$loanTerm * $interestMultiplier));

        // Calculando o total de juros
        $totalPayments = $monthlyPayments * $loanTerm * $interestMultiplier;
        $totalInterest = $totalPayments - $loanAmount;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Resultado do Empréstimo</title>
   
</head>
<body class="bg-gray-200 flex justify-center items-center h-screen">
    <div class="w-96 bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-center text-2xl font-bold">Resultado do Empréstimo</h2>
        <p class="border-solid border-2 border-gray-100 rounded-md w-full py-2 px-4 mb-2" >Pagamento Mensal: R$<?php echo number_format($monthlyPayments, 2, '.', ''); ?></p>
        <p class="border-solid border-2 border-gray-100 rounded-md w-full py-2 px-4 mb-2" >Total de Juros: R$<?php echo number_format($totalInterest, 2, '.', ''); ?></p>
        <!-- Formulário oculto para redirecionar de volta para index.php -->
        <form action="index.php" method="get">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full mt-10">Simular Outras Condições</button>
        </form>
    </div>
</body>
</html>
<?php
    } else {
        echo "Por favor, insira valores numéricos válidos.";
    }
}
?>
