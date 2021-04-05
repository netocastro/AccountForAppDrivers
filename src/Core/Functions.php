<?php

function debug($data)
{

    echo "<pre>";
    var_dump($data);
    echo "</pre>";
}

/**
 * função que gera uma url absoluta apartir de uma uri
 */

function url($uri = null)
{

    if ($uri) {
        return BASE_PATH . "/{$uri}";
    }
    return BASE_PATH;
}

/**
 * função de validação de cpf
 */

function validateName($name): bool
{

    if (preg_match('/^[a-zA-Z ]+$/', $name)) {
        return true;
    } else {
        return false;
    }
}

function mes($data)
{
    switch ($data) {
        case '01':
            return 'Janeiro';
        case '02':
            return 'Fevereiro';
        case '03':
            return 'Março';
        case '04':
            return 'Abril';
        case '05':
            return 'Maio';
        case '06':
            return 'Junho';
        case '07':
            return 'Julho';
        case '08':
            return 'Agosto';
        case '09':
            return 'Setembro';
        case '10':
            return 'Outubro';
        case '11':
            return 'Novembro';
        case '12':
            return 'Dezembro';

        default:
            return 'Valor de mes invalido';

            break;
    }
}

function validateMoney($money): bool
{

    if (preg_match('/^[0-9]+\,[0-9]{2}$/', $money)) {
        return true;
    } else {
        return false;
    }
}

/**
 * função de validação de cpf
 */

function validateCpf($cpf): bool
{

    if (preg_match('/^[0-9]{3}\.[0-9]{3}\.[0-9]{3}\-[0-9]{2}$/', $cpf)) {
        return true;
    } else {
        return false;
    }
}

/**
 * função de validação de email
 */

function validateEmail($email): bool
{

    if (preg_match('/^[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\.\-]+\.[a-z]{2,4}$/', $email)) {
        return true;
    } else {
        return false;
    }
}

/**
 * função de validação de Phone
 */

function validatePhone($phone): bool
{

    if (preg_match('/^\([0-9]{2}\)[0-9]{4}\-[0-9]{4}$/', $phone)) {
        return true;
    } else {
        return false;
    }
}

/**
 * função de validação de Cell Phone
 */

function validateCellPhone($cellPhone): bool
{

    if (preg_match('/^\([0-9]{2}\)[9][0-9]{4}\-[0-9]{4}$/', $cellPhone)) {
        return true;
    } else {
        return false;
    }
}

/**
 * Transforma objetos do tipo DataLayer em arrays
 */

function objectToArray($object): array
{
    $teste = [];
    if ($object == null) {
        return (array)$teste;
    }

    if (is_array($object)) {

        foreach ($object as $item => $value) {
            $teste[] = (array)$value->data();
        }
        return  (array) $teste;
    } else {
        $teste = [];
        $teste[] = (array)$object->data();
        return (array)$teste;
    }
}

/**
 * função que verifica se valores existem dentro de um objeto DataLayer
 */

function objectsExist($model, array $data, array $filter): array
{

    $arrayFilter = [];
    $error = [];
    $response = [];

    /**
     * condição para verificar se o array $filter foi passado vazio
     */

    if (empty($filter)) {
        $error['filter'] = 'filter empty';
        return $error;
    }

    /**
     * verificar se o o valores do array $filter existem no array data
     */

    foreach ($filter as $key1) {
        $cont = 0;
        foreach ($data as $key2 => $value) {
            if ($key1 == $key2) {
                $arrayFilter[$key1] = $value;
                $cont = 1;
            }
        }

        /**
         * retornando valores do array $filter que não existem no array $data
         */

        if ($cont == 0) {
            $error[] = $key1;
        }
    }

    /**
     * retornando o erro com os nomes dos indices do array filter
     * que não estãono array data
     */

    if (!empty($error)) {
        return ["indiceNaoExiste" => $error];
    }

    /**
     * Consultando o banco de dados com os names filtrados e retornando o resultado caso
     * exista registro
     */

    foreach ($arrayFilter as $key => $value) {

        if ($model->find("{$key} = :{$key}", "{$key}=" . $data[$key])->fetch()) {
            $response[] = $key;
        }
    }

    if ($response) {
        return $response;
    } else {
        return [];
    }
}

/**
 * função que verifica se valores existem dentro de um objeto DataLayer DEBUG
 */

function objectsExistEcho($model, array $data, array $filter)
{
    $arrayFilter = [];
    $error = [];

    if (empty($filter)) {
        $error['filter'] = 'filter empty';
        print_r($error);
        return;
    }
    foreach ($filter as $key1) {
        $cont = 0;
        foreach ($data as $key2 => $value) {
            if ($key1 == $key2) {
                $arrayFilter[$key1] = $value;
                $cont = 1;
            }
        }
        if ($cont == 0) {
            $error[] = $key1;
        }
    }
    if (!empty($error)) {
        print_r(["indiceNaoExiste" => $error]);
        return;
    }
    //print_r(['arrayFilter' =>$arrayFilter]);
    print_r($arrayFilter);

    $response = [];

    foreach ($arrayFilter as $key => $value) {
        echo "<h1>$key</h1>";
        echo "<pre>";
        //print_r($model->find("$key = :$key", "$key=" . $data[$key])->fetch()->data());
        ($model->find("$key = :$key", "$key=" . $data[$key])->fetch()) ? $response[] = $key : '';


        echo "</pre>";
    }
    print_r($response);
}

function valueReceiveAccountToday($model, $contaAtual, $id_app, $date_register)
{

    $appsAccounts = $model->find("id_app = :id_app", "id_app={$id_app}")->limit(6)->fetch(true);
    $week = new DateTime($date_register);

    if ($week->format('w') == 1) {
        return $contaAtual;
    }

    if ($appsAccounts) {
        foreach ($appsAccounts as $appAccount) {
            if ((new DateTime($appAccount->date()))->format('W') == $week->format('W')) {
                $contaAtual -= $appAccount->money;
            }
        }
    }
    return $contaAtual;
}


function balance()
{
}
