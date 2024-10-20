<?php

// Configuración para Teguh02/FilamentDbSync
return [

    /**
     * The host where the data will be synced
     */
    'sync_host' => env('SYNC_HOST', 'http://localhost'),

    /**
     * The token to be used for authentication
     */
    'auth_token' => env('SYNC_TOKEN', 'default_token'),

    /**
     * Models configuration
     */
    'models' => [
        /**
         * Auto scan de modelos habilitado. Esto escanea automáticamente
         * todos los modelos dentro de app/Models.
         */
        'auto_scan' => env('AUTO_SCAN_MODELS', true),

        /**
         * Si no quieres excluir ningún modelo, deja el array vacío.
         */
        'excluded' => [
            // No excluimos ningún modelo para incluir todos
        ],

        /**
         * Si el escaneo automático está habilitado, no es necesario especificar
         * manualmente los modelos en la clave 'included'.
         */
        'included' => [
            // No es necesario incluir manualmente los modelos si 'auto_scan' está activado
        ],

        /**
         * Columna clave para la sincronización de datos.
         * Puedes usar el nombre de las tablas aquí si lo prefieres.
         */
        'column_as_key' => [
            // Definir el campo clave para sincronizar, usando nombres de tablas.
            'attendance_control' => 'attendance_id', // Usar nombres de tablas en lugar de clases si es necesario.
            'users' => 'email',
            'orders' => 'order_id', // Puedes agregar tantas tablas como necesites
            // Añadir más tablas según sea necesario.
        ],
    ],

    /**
     * Configuración de sincronización
     */
    'sync' => [
        /**
         * Acción a realizar en caso de datos duplicados:
         * - 'update': actualiza los datos existentes
         * - 'duplicate': crea nuevos datos duplicados
         */
        'duplicate_data_action' => env('DUPLICATE_DATA_ACTION', 'update'),
    ],
];
