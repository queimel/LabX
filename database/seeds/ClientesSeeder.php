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
            // [1, 0, 0, 'Centro Nacional de Conservacion y Restauracion', '60905000-4', 'Recoleta 683', 92, 'Cliente'],
            // [1, 0, 1, 'Microscopia', '60905000-4', 'Recoleta 683', 92, 'Seccion'],


            [1,0,0,'Centro Nacional de Conservacion y Restauracion','60905000-4','CASA MATRIZ',1,'Cliente'],
            [2,0,0,'Instituto de Salud Publica','61605000-1','CASA MATRIZ',1,'Cliente'],
            [3,0,0,'Universidad San Sebastian','71631900-8','CASA MATRIZ',1,'Cliente'],
            [4,0,0,'Universidad Autonoma de Chile','71633300-0','CASA MATRIZ',1,'Cliente'],
            [5,0,0,'Compania de Cervecerias Unidas','90413000-1','CASA MATRIZ',1,'Cliente'],
            [6,0,0,'UNIVERSIDAD DE CHILE','60910000-1','CASA MATRIZ',1,'Cliente'],
            [7,0,0,'SOC. DENNIS MORAGA Y PALACIOS CASTRO LTDA','77870670-9','CASA MATRIZ',1,'Cliente'],
            [8,0,0,'SERVICIOS MEDICOS EIRL','76546240-1','CASA MATRIZ',1,'Cliente'],
            [9,0,0,'POLICIA DE INVESTIGACIONES','60506000-5','CASA MATRIZ',1,'Cliente'],
            [10,0,0,'GALENICA BODEGA','79622060-0','PATRICIA VINUELA 357',1,'Galenica'],
            [11,0,0,'MUNICIPALIDAD DE COIHUECO','69141102-8','CASA MATRIZ',1,'Cliente'],
            [12,0,0,'MORALES, SAEZ Y MIRANDA LTDA.','76730590-7','CASA MATRIZ',1,'Cliente'],
            [13,0,0,'LOPEZ Y ORELLANA LTDA.','77687110-9','CASA MATRIZ',1,'Cliente'],
            [14,0,0,'LABORATORIO SOMERUNO SA','96673590-2','CASA MATRIZ',1,'Cliente'],
            [15,0,0,'LABORATORIO OMESA ','96617350-5','CASA MATRIZ',1,'Cliente'],
            [1,1,0,'SUC. RECOLETA','60905000-4','Recoleta 683',92,'Sucursal'],
            [2,1,0,'SUC. ÑUÑOA','61605000-1','Av. Marathon 1000',99,'Sucursal'],
            [3,1,0,'SUC. CONCEPCIÓN','71631900-8','Calle General Cruz 1577',233,'Sucursal'],
            [4,1,0,'SUC. SAN MIGUEL','71633300-0','Llano Subercaseaux 2801',89,'Sucursal'],
            [5,1,0,'SUC. QUILICURA','90413000-1','Avenida Panamericana Norte 8000',94,'Sucursal'],
            [6,1,0,'SUC. INDEPENDENCIA','60910000-1','AV INDEPENDENCIA 1027',111,'Sucursal'],
            [7,1,0,'SUC. VALPARAÍSO','77870670-9','BLANCO 1199 PISO 2',65,'Sucursal'],
            [8,1,0,'SUC. VALPARAÍSO','76546240-1','CONDELL 1443, PISO 2 OF. 206',65,'Sucursal'],
            [9,1,0,'SUC. ÑUÑOA','60506000-5','BROWN NORTE 235',99,'Sucursal'],
            [10,1,0,'SUC. LAMPA','79622060-0L','PATRICIA VINUELA 357',84,'Sucursal'],
            [11,1,0,'SUC. COIHUECO','69141102-8','AV. ARTURO PRATS 1675',215,'Sucursal'],
            [12,1,0,'SUC. RANCAGUA','76730590-7','ESTADO 47 ',148,'Sucursal'],
            [13,1,0,'SUC. MAIPÚ','77687110-9','AV. MANUEL RODRIGUEZ 2989',100,'Sucursal'],
            [14,1,0,'SUC. CHILLÁN','96673590-2','CALLE ISABEL RIQUELME 446',199,'Sucursal'],
            [15,1,0,'SUC. LA FLORIDA','96617350-5','CALLE WALKER MARTINEZ 1380',109,'Sucursal'],
            [15,2,0,'SUC. VIÑA DEL MAR','96617350-5','13 NORTE CON LIBERTAD',66,'Sucursal'],
            [9,1,1,'SEC. HEMATOLOGIA','60506000-5','BROWN NORTE 235',99,'Sección'],
            [9,1,2,'SEC. HEMATOLOGIA','60506000-5','BROWN NORTE 235',99,'Sección'],
            [9,1,3,'SEC. QUIMICA','60506000-5','BROWN NORTE 235',99,'Sección'],
            [9,1,4,'SEC. INMUNOHEMATOLOGIA','60506000-5','BROWN NORTE 235',99,'Sección'],
            [9,1,5,'SEC. INMUNOHEMATOLOGIA','60506000-5','BROWN NORTE 235',99,'Sección'],
            [9,1,6,'SEC. INMUNOHEMATOLOGIA','60506000-5','BROWN NORTE 235',99,'Sección'],
            [1,1,1,'SEC. MICROSCOPIA','60905000-4','Recoleta 683',92,'Sección'],
            [2,1,1,'SEC. INVESTIGACION','61605000-1','Av. Marathon 1000',99,'Sección'],
            [3,1,1,'SEC. INVESTIGACION','71631900-8','Calle General Cruz 1577',233,'Sección'],
            [4,1,1,'SEC. INVESTIGACION','71633300-0','Llano Subercaseaux 2801',89,'Sección'],
            [5,1,1,'SEC. MICROSCOPIA','90413000-1','Avenida Panamericana Norte 8000',94,'Sección'],
            [6,1,1,'SEC. MICROSCOPIA','60910000-1','AV INDEPENDENCIA 1027',111,'Sección'],
            [7,1,1,'SEC. HEMATOLOGIA','77870670-9','BLANCO 1199 PISO 2',65,'Sección'],
            [8,1,1,'SEC. HEMATOLOGIA','76546240-1','CONDELL 1443, PISO 2 OF. 206',65,'Sección'],
            [12,1,1,'SEC. HORMONAS','76730590-7','ESTADO 47 ',148,'Sección'],
            [14,1,1,'SEC. QUIMICA','96673590-2','CALLE ISABEL RIQUELME 446',199,'Sección'],
            [10,1,1,'SEC. ORINAS','79622060-0L','PATRICIA VINUELA 357',84,'Sección'],
            [10,1,2,'SEC. HEMATOLOGIA','79622060-0L','PATRICIA VINUELA 357',84,'Sección'],
            [10,1,3,'SEC. QUIMICA','79622060-0L','PATRICIA VINUELA 357',84,'Sección'],
            [11,1,1,'SEC. HEMATOLOGIA','69141102-8','AV. ARTURO PRATS 1675',215,'Sección'],
            [11,1,2,'SEC. ORINAS','69141102-8','AV. ARTURO PRATS 1675',215,'Sección'],
            [11,1,3,'SEC. QUIMICA','69141102-8','AV. ARTURO PRATS 1675',215,'Sección'],
            [15,1,1,'SEC. ORINAS','96617350-5','CALLE WALKER MARTINEZ 1380',66,'Sección'],
            [15,1,2,'SEC. ORINAS','96617350-5','CALLE WALKER MARTINEZ 1380',66,'Sección'],
            [15,1,3,'SEC. ORINAS','96617350-5','CALLE WALKER MARTINEZ 1380',66,'Sección'],
            [15,1,4,'SEC. QUIMICA','96617350-5','CALLE WALKER MARTINEZ 1380',66,'Sección'],
            [15,2,1,'SEC. ORINAS','96617350-5','13 NORTE CON LIBERTAD',66,'Sección'],
            [13,1,1,'SEC. QUIMICA','77687110-9','AV. MANUEL RODRIGUEZ 2989',100,'Sección'],
            [13,1,2,'SEC. QUIMICA','77687110-9','AV. MANUEL RODRIGUEZ 2989',100,'Sección'],
            [13,1,3,'SEC. HEMATOLOGIA','77687110-9','AV. MANUEL RODRIGUEZ 2989',100,'Sección'],
            [13,1,4,'SEC. HEMATOLOGIA','77687110-9','AV. MANUEL RODRIGUEZ 2989',100,'Sección'],
            [13,1,5,'SEC. HEMATOLOGIA','77687110-9','AV. MANUEL RODRIGUEZ 2989',100,'Sección'],
            [13,1,6,'SEC. QUIMICA','77687110-9','AV. MANUEL RODRIGUEZ 2989',100,'Sección'],
            [13,1,7,'SEC. QUIMICA','77687110-9','AV. MANUEL RODRIGUEZ 2989',100,'Sección'],
        ];

        $clientes = array_map(function ($cliente) use ($now) {
            return [
                'id' =>$cliente[0],
                'id_sucursal' => $cliente[1],
                'id_seccion' => $cliente[2],
                'nombre_cliente' => $cliente[3],
                'rut_cliente' => $cliente[4],
                'direccion_cliente' => $cliente[5],
                'id_comuna' => $cliente[6],
                'descripcion_cliente' => $cliente[7],
                'updated_at' => $now,
                'created_at' => $now,
            ];
        }, $clientes);
        \DB::table('clientes')->insert($clientes);

    }
}
