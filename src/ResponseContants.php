<?php

namespace DevDizs\MantarysSdk;

final class ResponseContants
{
    const SUCCESS_TRANSACTION           = '00';
    const NOT_VALID_REF                 = '01';
    const NOT_VALID_PHONE               = '02';
    const NOT_VALID_AMOUNT              = '03';
    const CAN_NOT_PAY                   = '04';
    const NOT_ENOUGH_BALANCE            = '05';
    const IN_MAINTENANCE                = '06';
    const CAN_NOT_PAY_2                 = '07';
    const SERVICE_NOT_FULL_AVAILABLE    = '08';
    const AUTH_NOT_AVAILABLE            = '09';
    const REGION_NOT_AVAILABLE          = '10';
    const OP_NOT_AVAILABLE              = '11';
    const NO_PERMISSIONS                = '12';
    const NOT_VALID_PDV                 = '13';
    const BLOCKED_USER                  = '14';
    const DUP                           = '15';
    const PRODUCT_NOT_AVAILABLE         = '16';
    const MOVEMENT_NOT_FOUND            = '17';
    const MOVEMENT_REVIEWED             = '18';
    const MOVEMENT_NOT_AUTH             = '19';
    const INDET                         = '20';
    const CANT_REVIEW                   = '21';
    const FRAUD                         = '22';
    const DB_ERROR                      = '23';
    const ON_HOLD                       = '24';
    const WRONG_USER_INFO               = '25';
    const SUBSCRIPTION_AVAILABLE        = '26';
    const PHONE_NO_AVAILABLE_ACTIVATION = '27';
    const PHONE_NO_AVAILABLE_PAY        = '29';
    const WRONG_REF                     = '30';
    const DAILY_BALANCE_CHECK           = '31';

    const MESSAGES = [
        self::SUCCESS_TRANSACTION           => 'TRANSACCIÓN EXITOSA',
        self::NOT_VALID_REF                 => 'REFERENCIA NO VALIDA / REVISAR OPERADOR',
        self::NOT_VALID_PHONE               => 'TELÉFONO SUBSCRIPTOR NO VALIDO',
        self::NOT_VALID_AMOUNT              => 'MONTO NO VALIDO',
        self::CAN_NOT_PAY                   => 'NO SE PUEDE ABONAR',
        self::NOT_ENOUGH_BALANCE            => 'SALDO INSUFICIENTE',
        self::IN_MAINTENANCE                => 'MANTENIMIENTO OPERADORA EN CURSO',
        self::CAN_NOT_PAY_2                 => 'NO SE PUEDE ABONAR',
        self::SERVICE_NOT_FULL_AVAILABLE    => 'INTERMITENCIA EN SERVICIO',
        self::AUTH_NOT_AVAILABLE            => 'AUTORIZADOR NO DISPONIBLE',
        self::REGION_NOT_AVAILABLE          => 'REGION NO PERMITIDA',
        self::OP_NOT_AVAILABLE              => 'OPERADORA NO DISPONIBLE',
        self::NO_PERMISSIONS                => 'NO TIENE PERMISO ASIGNADO',
        self::NOT_VALID_PDV                 => 'FECHA PDV NO VALIDA',
        self::BLOCKED_USER                  => 'USUARIO BLOQUEADO',
        self::DUP                           => 'POSIBLE DUPLICADO, REVISAR CORTE',
        self::PRODUCT_NOT_AVAILABLE         => 'PRODUCTO NO DISPONIBLE',
        self::MOVEMENT_NOT_FOUND            => 'MOVIMIENTO NO ENCONTRADO',
        self::MOVEMENT_REVIEWED             => 'MOVIMIENTO YA REVISADO',
        self::MOVEMENT_NOT_AUTH             => 'MOVIMIENTO NO AUTORIZADO',
        self::INDET                         => 'ERROR INDETERMINADO',
        self::FRAUD                         => 'SOSPECHA DE FRAUDE',
        self::DB_ERROR                      => 'ERROR EN LA BASE DE DATOS OPERADORA',
        self::ON_HOLD                       => 'RECARGA EN ESPERA',
        self::WRONG_USER_INFO               => 'USUARIO / PASSWORD INVALIDOS',
        self::SUBSCRIPTION_AVAILABLE        => 'CUENTA CON UNA SUBSCRIPCIÓN VIGENTE',
        self::PHONE_NO_AVAILABLE_ACTIVATION => 'TELÉFONO NO SUSCEPTIBLE DE ACTIVACIÓN',
        self::PHONE_NO_AVAILABLE_PAY        => 'TELÉFONO NO SUSCEPTIBLE DE ABONO',
        self::WRONG_REF                     => 'REFERENCIA INCORRECTA',
        self::DAILY_BALANCE_CHECK           => 'CORTE DEL DÍA EN PROGRESO',
    ];

    public static function getMessage( $code )
    {
        return self::MESSAGES[ $code ] ?? 'NOT MESSAGE AVAILABLE';
    }
}
