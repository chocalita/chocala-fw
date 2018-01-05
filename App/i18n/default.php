<?php
return array(
    'validate.null' => 'La propiedad no puede ser nula',
    'validate.blank' => 'La propiedad no puede ser vacía',
    'validate.range' => 'El valor de la propiedad debe estar dentro del rango [{min}] - [{max}]',
    'validate.size' => 'El tamaño de la propiedad debe estar entre el rango [{min}] - [{max}]',
    'validate.min.value' => 'El valor mínimo de la propiedad es [{min}]',
    'validate.max.value' => 'El valor máximo de la propiedad es [{max}]',
    'validate.min.size' => 'El tamaño mínimo de la propiedad es [{min}]',
    'validate.max.size' => 'El tamaño máximo de la propiedad es [{max}}]',
    'validate.not.equal' => 'El valor de la propiedad no puede ser [{val}]',
    'validate.email' => 'El valor de la propiedad no es un email válido',
    'validate.not.inlist' => 'El valor de la propiedad no corresponde a la lista válida',
    'validate.unique' => 'La propiedad debe ser ùnica',

    /* JobSuscriptor */
    'JobSuscriptor.NombreSimple.validate.size' => 'La longitud del nombre debe ser de [{min}] a [{max}] caracteres',
    'JobSuscriptor.Email.validate.unique' => 'Este email ya se encuentra registrado',
    'JobSuscriptor.IdTmpFormacion.validate.null' => 'Debe ingresar la Formación de su interés',

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