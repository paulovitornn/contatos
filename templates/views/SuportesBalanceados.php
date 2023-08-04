<?php 
function colchetesValidos($entrada) {
    $pilha = []; // Aqui crio a pilha para armazenar os colchetes de abertura
    $colchetesPares = [')' => '(', '}' => '{', ']' => '['];  // Aqui tenho o array que armazena os pares entre cada tipo de array

    for ($i = 0; $i < strlen($entrada); $i++) { //aqui vamos percorrer o array de caracteres até que ele acabe
        $charAtual = $entrada[$i];
        if ($charAtual === '(' || $charAtual === '{' || $charAtual === '[') {
            array_push($pilha, $charAtual); //aqui foi feito uma verificação para saber se é um arrray de abertura, para ser inserido na pilha
        } elseif ($charAtual === ')' || $charAtual === '}' || $charAtual === ']') { 
            if (empty($pilha) || ($colchetesPares[$charAtual] !== array_pop($pilha))) { //caso seja um fechamento, será verificado se a pilha não está vazia, e também se a ultima abertura corresponde ao fechamento em questao
                return false;                                                         //caso encontre uma abertura para o fechamento, esse colchete de abertura é removido da pilha e o loop avança para o proximo caracter
            }
        }
    }

    return empty($pilha);
}

echo "Exemplo1   -   (){}[]   -   ",  colchetesValidos("(){}[]") ? "Válido<br>" : "Inválido<br>";
echo "Exemplo2   -   [{()}](){}   -   ",  colchetesValidos("[{()}](){}") ? "Válido<br>" : "Inválido<br>";
echo "Exemplo3   -   []{()   -   ",  colchetesValidos("[]{()") ? "Válido<br>" : "Inválido<br>";
echo "Exemplo4   -   [{)]   -   ",  colchetesValidos("[{)]") ? "Válido<br>" : "Inválido<br>";
echo "Exemplo5   -   ()   -   ", colchetesValidos("()") ? "Válido<br>" : "Inválido<br>";
echo "Exemplo6   -   ()[]{}   -   ", colchetesValidos("()[]{}") ? "Válido<br>" : "Inválido<br>";
echo "Exemplo7   -   ([{}])   -   ", colchetesValidos("([{}])") ? "Válido<br>" : "Inválido<br>";
echo "Exemplo8   -   ({[}])   -   ", colchetesValidos("({[}])") ? "Válido<br>" : "Inválido<br>";
echo "Exemplo9   -   ({[}]})   -   ", colchetesValidos("({[}]})") ? "Válido<br>" : "Inválido<br>";
echo "Exemplo10   -   ([)]   -   ", colchetesValidos("(]") ? "Válido<br>" : "Inválido<br>";

