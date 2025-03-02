<?php
return array(
    'validate.value' => 'El valor ingresado no es válido',
    'validate.required' => 'Este campo es requerido',
    'validate.null' => 'Este campo es requerido',
    'validate.blank' => 'Este campo es requerido',
    'validate.equal' => 'El valor permitido es "[{val}]"',
    'validate.notEsqual' => 'El valor "[{val}]" no esta permitido',
    'validate.min' => 'El valor mínimo debe ser [{min}]',
    'validate.max' => 'El valor máximo debe ser [{max}]',
    'validate.range' => 'El valor debe estar entre [{min}] y [{max}]',
    'validate.size' => 'La longitud permitida es de [{min}] a [{max}] caracteres',
    'validate.size.min' => 'El tamaño mínimo es de [{min}] caracteres',
    'validate.size.max' => 'El tamaño máximo es de [{max}}] caracteres',
    'validate.size.fix' => 'El tamaño permitido es de [{fix}] caracteres',
    'validate.email' => 'El valor ingresado no es un email válido',
    'validate.inList' => 'El valor no se encuentra en la entre los valores permmitidos',
    'validate.notInList' => 'El valor se encuentra entre los valores no permitidos',
    'validate.unique' => 'Este valor ya se encuentra registrado',


    'SysUser.Password2.validate.password2' => 'Debe repetir la contraseña ingresada',

    /* JobAviso */
    'JobAviso.validate.telefonoCorreo' => 'Debe ingresar un teléfono o correo de contacto',
    'JobAviso.validate.telefonoCorreo' => 'Debe ingresar un teléfono o correo de contacto',
    'JobAviso.validate.agree' => 'Debe aceptar los términos y condiciones para completar su publicación',
    'JobAviso.FormacionesReferencia.validate.null' => 'Debe indicar al menos una formación requerida',
    'JobAviso.Localizacion.validate.null' => 'Debe indicar una localización',

    /* JobSuscriptor */
    'JobSuscriptor.NombreSimple.validate.size' => 'El nombre debe tener entre [{min}] y [{max}] caracteres',
    'JobSuscriptor.Email.validate.size' => 'El correo debe tener entre [{min}] y [{max}] caracteres',
    'JobSuscriptor.Email.validate.unique' => 'Este email ya se encuentra registrado',
    'JobSuscriptor.IdTmpFormacion.validate.null' => 'Debe especificar el área de su interés',

    /* JobEmpresaSuscrita */
    'JobEmpresaSuscrita.Nombre.validate.null' => 'Debe ingresar el nombre de la empresa',
    'JobEmpresaSuscrita.Nombre.validate.blank' => 'Debe ingresar el nombre de la empresa',
    'JobEmpresaSuscrita.Nombre.validate.size' => 'El nombre debe tener de [{min}] a [{max}] caracteres',
    'JobEmpresaSuscrita.Nombre.validate.unique' => 'Este nombre ya se encuentra registrado',
    'JobEmpresaSuscrita.Email.validate.null' => 'Debe ingresar el email de la empresa',
    'JobEmpresaSuscrita.Email.validate.blank' => 'Debe ingresar el email de la empresa',
    'JobEmpresaSuscrita.Email.validate.email' => 'Debe ingresar un email válido',
    'JobEmpresaSuscrita.Email.validate.unique' => 'Este email ya se encuentra registrado',
    'JobEmpresaSuscrita.Representante.validate.null' => 'Debe ingresar el nombre del representante',
    'JobEmpresaSuscrita.Representante.validate.blank' => 'Debe ingresar el nombre del representante',
    'JobEmpresaSuscrita.Representante.validate.size' => 'La longitud debe ser de [{min}] a [{max}] caracteres',
    'JobEmpresaSuscrita.Representante.validate.nombreCompleto' => 'Debe ingresar el nombre y apellido del representante',
    'JobEmpresaSuscrita.EntityTypeId.validate.null' => 'Debe especificar el tipo de empresa o negocio',
    'JobEmpresaSuscrita.EntityTypeId.validate.blank' => 'Debe especificar el tipo de empresa o negocio',

    'JobEmpresaSuscrita.LocationId.validate.required' => 'La localización es requerida',
    'JobEmpresaSuscrita.Direccion.validate.null' => 'Debe ingresar la dirección de la empresa',
    'JobEmpresaSuscrita.Direccion.validate.blank' => 'Debe ingresar la dirección de la empresa',
    'JobEmpresaSuscrita.Direccion.validate.size' => 'La dirección debe tener de [{min}] a [{max}] caracteres',
    'JobEmpresaSuscrita.Telefono.validate.size' => 'El teléfono debe tener de [{min}] a [{max}] caracteres',
    'JobEmpresaSuscrita.Celular.validate.size' => 'El celular debe tener de [{min}] a [{max}] caracteres',
    'JobEmpresaSuscrita.validate.telefonos' => 'Debe ingresar al menos un número de teléfono o celular',


    'Displayed related class attrib' => 'Displayed attrib of [{class}] class',

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