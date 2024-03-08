<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Inclua o jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Inclua o jQuery Mask Money -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
    <title>Calculadora de Empréstimos</title>
</head>
<body class="bg-gray-200 flex justify-center items-center h-screen">
    <div class="w-96 bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-center text-2xl font-bold">Calculadora de Empréstimos</h2>
        <form id="loanForm" action="processo.php" method="post" class="mt-4" onsubmit="removeMasks()">
            <label for="loan_amount">Valor do Empréstimo:</label><br>
            <!-- Aplicar máscara de moeda com jQuery Mask Money -->
            <input type="text" id="loan_amount" name="loan_amount" class="border-solid border-2 border-gray-100 rounded-md w-full py-2 px-4 mb-2" required><br>
            <label for="interest_rate">Taxa de Juros:</label><br>
            <!-- Aplicar máscara de percentual com jQuery Mask Money -->
            <input type="text" id="interest_rate" name="interest_rate" class="border-solid border-2 border-gray-100 rounded-md w-full py-2 px-4 mb-2" required><br>
            <label for="interest_type">Tipo de Taxa de Juros:</label><br>
            <select id="interest_type" name="interest_type" class="border-solid border-2 border-gray-100 rounded-md w-full py-2 px-4 mb-2" required>
                <option value="annual">Anual</option>
                <option value="monthly">Mensal</option>
            </select><br>
            <label for="loan_term">Prazo do Empréstimo (meses):</label><br>
            <!-- Aplicar máscara de número inteiro para o prazo do empréstimo -->
            <input type="text" id="loan_term" name="loan_term" class="border-solid border-2 border-gray-100 rounded-md w-full py-2 px-4 mb-4" required><br>
            <input type="submit" value="Calcular" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full">
        </form>
    </div>

    <!-- Script para inicializar as máscaras de valor -->
    <script>
        $(document).ready(function() {
            // Aplicar máscara de moeda para o valor do empréstimo
            $('#loan_amount').maskMoney({prefix: 'R$ ', thousands: '.', decimal: ','});

            // Aplicar máscara de percentual para a taxa de juros
            $('#interest_rate').maskMoney({suffix: ' %'});

            // Aplicar máscara de número inteiro para o prazo do empréstimo
            $('#loan_term').mask('000', {reverse: true});
        });

        // Função para remover as máscaras antes de enviar o formulário
        function removeMasks() {
            // Remover máscara de moeda
            var loanAmount = $('#loan_amount').maskMoney('unmasked')[0];
            $('#loan_amount').val(loanAmount);
            
            // Remover máscara de percentual
            var interestRate = $('#interest_rate').maskMoney('unmasked')[0];
            $('#interest_rate').val(interestRate);
        }
    </script>
</body>
</html>
