<?php
return array(
    'validate.null' => 'Este campo es requerido',
    'validate.blank' => 'Este campo es requerido',
    'validate.range' => 'El valor debe estar entre [{min}] y [{max}]',
    'validate.size' => 'La longitud permitidaes de [{min}] a [{max}] caracteres',
    'validate.min.value' => 'El valor mínimo permitido es [{min}]',
    'validate.max.value' => 'El valor máximo permitido es [{max}]',
    'validate.min.size' => 'El tamaño mínimo es de [{min}] caracteres',
    'validate.max.size' => 'El tamaño máximo es de [{max}}] caracteres',
    'validate.not.equal' => 'El valor "[{val}]" no esta permitido',
    'validate.email' => 'El valor ingresado no es un email válido',
    'validate.not.inlist' => 'El valor no se encuentra en la lista válida',
    'validate.unique' => 'Este valor ya se encuentra registrado',

    /* JobSuscriptor */
    'JobSuscriptor.NombreSimple.validate.size' => 'El nombre debe tener entre [{min}] y [{max}] caracteres',
    'JobSuscriptor.Email.validate.size' => 'El correo debe tener entre [{min}] y [{max}] caracteres',
    'JobSuscriptor.Email.validate.unique' => 'Este email ya se encuentra registrado',
    'JobSuscriptor.IdTmpFormacion.validate.null' => 'Debe especificar el área de su interés',

    /* JobEmpresaSuscrita */
    'JobEmpresaSuscrita.Nombre.validate.null' => 'Debe ingresar el nombre de la empresa',
    'JobEmpresaSuscrita.Nombre.validate.blank' => 'Debe ingresar el nombre de la empresa',
    'JobEmpresaSuscrita.Nombre.validate.size' => 'La longitud del nombre debe ser de [{min}] a [{max}] caracteres',
    'JobEmpresaSuscrita.Nombre.validate.unique' => 'Este nombre ya se encuentra registrado',
    'JobEmpresaSuscrita.Email.validate.null' => 'Debe ingresar el email de la empresa',
    'JobEmpresaSuscrita.Email.validate.blank' => 'Debe ingresar el email de la empresa',
    'JobEmpresaSuscrita.Email.validate.email' => 'Debe ingresar un email válido',
    'JobEmpresaSuscrita.Email.validate.unique' => 'Este email ya se encuentra registrado',
    'JobEmpresaSuscrita.Representante.validate.null' => 'Debe ingresar el nombre del representante',
    'JobEmpresaSuscrita.Representante.validate.blank' => 'Debe ingresar el nombre del representante',
    'JobEmpresaSuscrita.Representante.validate.size' => 'La longitud debe ser de [{min}] a [{max}] caracteres',
    'JobEmpresaSuscrita.EntityTypeId.validate.null' => 'Debe especificar el tipo de empresa o negocio',
    'JobEmpresaSuscrita.EntityTypeId.validate.blank' => 'Debe especificar el tipo de empresa o negocio',


    'Displayed related class attrib' => 'Displayed attrib of [{class}] class',
    
    'user.name.null' => 'Subtitulo',
    
    'message.uno' => 'Subtitulo',
    
    'Datasources Configs'           => 'Configuraciones de Base de Datos',
    'Domain classes'                => 'Clases de Dominio',
    'Select a class'                => 'Seleccione una clase para gestionar la generación de scaffolding',
    'CRUD Generation'               => 'Generación de CRUD',
    'Generate field'                => 'Generar campo',
    'Class'                         => 'Clase',
    'Yes'                           => 'Si',
    'No'                            => 'No',
    'Tabla de Datos'                => 'Tabla de Datos',
    '' => ''
);