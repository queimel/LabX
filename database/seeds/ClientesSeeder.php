<?php

use Illuminate\Database\Seeder;

class ClientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = \Carbon\Carbon::now();
        $clientes = [
            // CLIENTES
            [1,NULL, 'Centro Nacional de Conservacion y Restauracion','60905000-4','Recoleta 683',92,'Cliente'],
            [2,NULL, 'Instituto de Salud Publica','61605000-1','Av. Marathon 1000',99,'Cliente'],
            [3,NULL, 'Universidad San Sebastian','71631900-8','Calle General Cruz 1577',233,'Cliente'],
            [4,NULL, 'Universidad Autonoma de Chile','71633300-0','Llano Subercaseaux 2801',89,'Cliente'],
            [5,NULL, 'Compania de Cervecerias Unidas','90413000-1','Avenida Panamericana Norte 8000',94,'Cliente'],
            [6,NULL, 'UNIVERSIDAD DE CHILE','60910000-1','AV INDEPENDENCIA 1027',111,'Cliente'],
            [7,NULL, 'SOC. DENNIS MORAGA Y PALACIOS CASTRO LTDA','77870670-9','BLANCO 1199 PISO 2',65,'Cliente'],
            [8,NULL, 'SERVICIOS MEDICOS EIRL','76546240-1','CONDELL 1443, PISO 2 OF. 206',65,'Cliente'],
            [9,NULL, 'POLICIA DE INVESTIGACIONES','60506000-5','BROWN NORTE 235',99,'Cliente'],
            [10,NULL, 'GALENICA BODEGA','79622060-0','PATRICIA VINUELA 357',84,'Galenica'],
            [11,NULL, 'MUNICIPALIDAD DE COIHUECO','69141102-8','AV. ARTURO PRATS 1675',215,'Cliente'],
            [12,NULL, 'MORALES, SAEZ Y MIRANDA LTDA.','76730590-7','ESTADO 47 ',148,'Cliente'],
            [13,NULL, 'LOPEZ Y ORELLANA LTDA.','77687110-9','AV. MANUEL RODRIGUEZ 2989',100, 'Cliente'],
            [14,NULL, 'LABORATORIO SOMERUNO SA','96673590-2','CALLE ISABEL RIQUELME 446',199,'Cliente'],
            [15,NULL, 'LABORATORIO OMESA ','96617350-5','CALLE WALKER MARTINEZ 1380',109,'Cliente'],

            // SUCURSALES
            [16,1, 'SUC. RECOLETA','60905000-4','Recoleta 683',92,'Sucursal'],
            [17,2, 'SUC. ÑUÑOA','61605000-1','Av. Marathon 1000',99,'Sucursal'],
            [18,3, 'SUC. CONCEPCIÓN','71631900-8','Calle General Cruz 1577',233,'Sucursal'],
            [19,4, 'SUC. SAN MIGUEL','71633300-0','Llano Subercaseaux 2801',89,'Sucursal'],
            [20,5, 'SUC. QUILICURA','90413000-1','Avenida Panamericana Norte 8000',94,'Sucursal'],
            [21,6, 'SUC. INDEPENDENCIA','60910000-1','AV INDEPENDENCIA 1027',111,'Sucursal'],
            [22,7, 'SUC. VALPARAÍSO','77870670-9','BLANCO 1199 PISO 2',65,'Sucursal'],
            [23,8, 'SUC. VALPARAÍSO','76546240-1','CONDELL 1443, PISO 2 OF. 206',65,'Sucursal'],
            [24,9, 'SUC. ÑUÑOA','60506000-5','BROWN NORTE 235',99,'Sucursal'],
            [25,10,'SUC. LAMPA','79622060-0L','PATRICIA VINUELA 357',84,'Sucursal'],
            [26,11,'SUC. COIHUECO','69141102-8','AV. ARTURO PRATS 1675',215,'Sucursal'],
            [27,12,'SUC. RANCAGUA','76730590-7','ESTADO 47 ',148,'Sucursal'],
            [28,13,'SUC. MAIPÚ','77687110-9','AV. MANUEL RODRIGUEZ 2989',100,'Sucursal'],
            [29,14,'SUC. CHILLÁN','96673590-2','CALLE ISABEL RIQUELME 446',199,'Sucursal'],
            [30,15,'SUC. LA FLORIDA','96617350-5','CALLE WALKER MARTINEZ 1380',109,'Sucursal'],
            [31,15,'SUC. VIÑA DEL MAR','96617350-5','13 NORTE CON LIBERTAD',66,'Sucursal'],

            // SECCIONES
            [32,24,'HEMATOLOGIA','60506000-5','BROWN NORTE 235',99,'Sección'],
            [33,24,'HEMATOLOGIA','60506000-5','BROWN NORTE 235',99,'Sección'],
            [34,24,'QUIMICA','60506000-5','BROWN NORTE 235',99,'Sección'],
            [35,24,'INMUNOHEMATOLOGIA','60506000-5','BROWN NORTE 235',99,'Sección'],
            [36,24,'INMUNOHEMATOLOGIA','60506000-5','BROWN NORTE 235',99,'Sección'],
            [37,24,'INMUNOHEMATOLOGIA','60506000-5','BROWN NORTE 235',99,'Sección'],
            [38,16,'SEC. MICROSCOPIA','60905000-4','Recoleta 683',92,'Sección'],
            [39,17,'SEC. INVESTIGACION','61605000-1','Av. Marathon 1000',99,'Sección'],
            [40,18,'SEC. INVESTIGACION','71631900-8','Calle General Cruz 1577',233,'Sección'],
            [41,19,'SEC. INVESTIGACION','71633300-0','Llano Subercaseaux 2801',89,'Sección'],
            [42,20,'SEC. MICROSCOPIA','90413000-1','Avenida Panamericana Norte 8000',94,'Sección'],
            [43,21,'SEC. MICROSCOPIA','60910000-1','AV INDEPENDENCIA 1027',111,'Sección'],
            [44,22,'SEC. HEMATOLOGIA','77870670-9','BLANCO 1199 PISO 2',65,'Sección'],
            [45,23,'SEC. HEMATOLOGIA','76546240-1','CONDELL 1443, PISO 2 OF. 206',65,'Sección'],
            [46,27,'SEC. HORMONAS','76730590-7','ESTADO 47 ',148,'Sección'],
            [47,29,'SEC. QUIMICA','96673590-2','CALLE ISABEL RIQUELME 446',199,'Sección'],
            // [48,25,'ORINAS','79622060-0L','PATRICIA VINUELA 357',84,'Sección'],
            [49,25,'BODEGA','79622060-0','PATRICIA VINUELA 357',84,'Sección'],
            // [50,25,'QUIMICA','79622060-0L','PATRICIA VINUELA 357',84,'Sección'],
            [51,26,'HEMATOLOGIA','69141102-8','AV. ARTURO PRATS 1675',215,'Sección'],
            [52,26,'ORINAS','69141102-8','AV. ARTURO PRATS 1675',215,'Sección'],
            [53,26,'QUIMICA','69141102-8','AV. ARTURO PRATS 1675',215,'Sección'],
            [54,30,'ORINAS','96617350-5','CALLE WALKER MARTINEZ 1380',66,'Sección'],
            [55,30,'QUIMICA','96617350-5','CALLE WALKER MARTINEZ 1380',66,'Sección'],
            [56,31,'ORINAS','96617350-5','13 NORTE CON LIBERTAD',66,'Sección'],
            [57,28,'QUIMICA','77687110-9','AV. MANUEL RODRIGUEZ 2989',100,'Sección'],
            [58,28,'QUIMICA','77687110-9','AV. MANUEL RODRIGUEZ 2989',100,'Sección'],
            [59,28,'HEMATOLOGIA','77687110-9','AV. MANUEL RODRIGUEZ 2989',100,'Sección'],
            [60,28,'HEMATOLOGIA','77687110-9','AV. MANUEL RODRIGUEZ 2989',100,'Sección'],
            [61,28,'HEMATOLOGIA','77687110-9','AV. MANUEL RODRIGUEZ 2989',100,'Sección'],
            [62,28,'QUIMICA','77687110-9','AV. MANUEL RODRIGUEZ 2989',100,'Sección'],
            [63,28,'QUIMICA','77687110-9','AV. MANUEL RODRIGUEZ 2989',100,'Sección'],
        ];

        $clientes = array_map(function ($cliente) use ($now) {
            return [
                'id' =>$cliente[0],
                'parent_id' => $cliente[1],
                'nombre_cliente' => $cliente[2],
                'rut_cliente' => $cliente[3],
                'direccion_cliente' => $cliente[4],
                'id_comuna' => $cliente[5],
                'descripcion_cliente' => $cliente[6],
                'updated_at' => $now,
                'created_at' => $now,
            ];
        }, $clientes);
        \DB::table('clientes')->insert($clientes);

    }
}
