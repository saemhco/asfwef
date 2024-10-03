<?php

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

class MigracionAdmisionPostulantesArchivo extends Migration
{
    public function up()
    {
        $this->morphTable(
            'admision_postulantes_archivo',
            [
                'columns' => [
                    new Column(
                        'id',
                        [
                            'type'          => Column::TYPE_INTEGER,
                            'size'          => 11,
                            'unsigned'      => true,
                            'notNull'       => true,
                            'autoIncrement' => true,
                        ]
                    ),
                    new Column(
                        'id_postulante',
                        [
                            'type'      => Column::TYPE_INTEGER,
                            'size'      => 11,
                            'unsigned'  => true,
                            'notNull'   => true,
                        ]
                    ),
                    new Column(
                        'tipo',
                        [
                            'type'    => Column::TYPE_VARCHAR,
                            'size'    => 50,
                            'notNull' => true,
                        ]
                    ),
                    new Column(
                        'archivo',
                        [
                            'type'    => Column::TYPE_VARCHAR,
                            'size'    => 255,
                            'notNull' => true,
                        ]
                    ),
                ],
                'indexes' => [
                    new Index(
                        'PRIMARY',
                        ['id']
                    ),
                    new Index(
                        'fk_admision_postulantes_archivo_admision_postulantes1_idx',
                        ['id_postulante']
                    ),
                ],
                'references' => [
                    new Reference(
                        'fk_admision_postulantes_archivo_admision_postulantes1',
                        [
                            'referencedTable'   => 'admision_postulantes',
                            'referencedSchema'  => 'public',
                            'columns'           => ['id_postulante'],
                            'referencedColumns' => ['id'],
                        ]
                    ),
                ],
                'options' => [
                    'TABLE_TYPE'      => 'BASE TABLE',
                    'AUTO_INCREMENT'  => '1',
                    'ENGINE'          => 'InnoDB',
                    'TABLE_COLLATION' => 'utf8_general_ci',
                ],
            ]
        );
    }

    public function down()
    {
        // Código para realizar la migración hacia atrás
    }
}
