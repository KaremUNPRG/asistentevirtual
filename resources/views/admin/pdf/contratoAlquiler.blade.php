<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>{{'Contrato_#'.str_pad($DatosSolicitud->IdSolicitud,8,'0',STR_PAD_LEFT)}}</title>
    <style>
      .page-break {
          page-break-after: always;
      }
      body{
          font-family: "helvetica"!important;
          margin: 0px 70px;
      }
    </style>
  </head>
  <body>
    <div style="width:100%;text-align:center;">
      <h3><u>CONTRATO DE ALQULER</u></h3>
    </div>
    <div style="width:100%">
      <p style="font-size:14px;text-align:justify;line-height:2">
      Conste por el presente documento, el contrato de alquiler que celebran, de una parte <strong><u>{{$DatosSolicitud->NombreArrendador}}</u></strong>,
      identificado con <strong><u>{{$DatosSolicitud->TipoDocArrendador}}</u></strong> Nº <strong><u>{{$DatosSolicitud->DocArrendador}}</u></strong>
      domiciliado en <strong><u>{{$DatosSolicitud->DirecArrendador}}</u></strong>; en adelante EL ARRENDADOR; y de la otra parte don
      <strong><u>{{$DatosSolicitud->NombreArrendatario}}</u></strong> identificado con <strong><u>{{$DatosSolicitud->TipoDocArrendatario}}</u></strong> Nº
      <strong><u>{{$DatosSolicitud->DocArrendatario}}</u></strong> domiciliado en
      <strong><u>{{$DatosSolicitud->DirecArrendatario}}</u></strong>; en adelante EL ARRENDATARIO; en los términos siguientes:
      </p>
      <br>
      <p style="font-size:14px;text-align:justify;line-height:2">
        <strong><u>PRIMERO</u></strong> <br>
        EL ARRENDADOR <strong><u>{{$DatosSolicitud->NombreArrendador}}</u></strong> es propietario del inmueble ubicado en la
        <strong><u>{{$DatosSolicitud->UbicacionPropiedad}}</u></strong>. <strong>{{$InfoPropiedad}}</strong>.
      </p>
      <p style="font-size:14px;text-align:justify;line-height:2">
        <strong><u>SEGUNDO</u></strong> <br>
        Por el presente documento, EL ARRENDADOR da en alquiler a EL ARRENDATARIO, elinmueble descrito en la cláusula anterior;
      </p>
      <p style="font-size:14px;text-align:justify;line-height:2">
        <strong><u>TERCERO</u></strong> <br>
        El plazo de duración del presente contrato es de <strong><u>{{$Duracion[2]}}</u></strong> años con <strong><u>{{$Duracion[1]}}</u></strong> meses y
        <strong><u>{{$Duracion[0]}}</u></strong> dias, que se inicia el <b><u>{{$FechaInicio[2]}}</u></b> de <b><u>{{$FechaInicio[1]}}</u></b> del <b><u>{{$FechaInicio[0]}}</u></b>,
        venciendo el <b><u>{{$FechaFin[2]}}</u></b> de <b><u>{{$FechaFin[1]}}</u></b> del <b><u>{{$FechaFin[0]}}</u></b>, fecha en que EL
        ARRENDATARIO entregará el inmueble materia del presente a EL ARRENDADOR, sin necesidad de
        requerimiento judicial, ni extrajudicial alguno, en las mismas condiciones en que lo recibió, salvo el
        deterioro de su uso normal y cuidadoso.
        Se deja constancia que el inicio efectivo del alquiler, es por cuanto EL
        ARRENDADOR está realizando la habilitación del inmueble para el efecto de alquiler, por lo que
        se compromete a entregar el inmueble antes de la fecha del inicio del alquiler, completamente
        habilitado.
      </p>

      <p style="font-size:14px;text-align:justify;line-height:2">
        <strong><u>CUARTO</u></strong> <br>
        EL ARRENDATARIO entrega y EL ARRENDADOR recibe a su entera satisfacción a la suscripción del
        presente contrato, por concepto de garantía, que cubrirá cualquier daño al inmueble materia de arriendo y que ocasione EL
        ARRENDATARIO, sólo por el valor justificado del perjuicio y hasta por su importe total, de ser necesario y
        sustentado. En caso de entregar EL ARRENDATARIO a EL ARRENDADOR el inmueble en las mismas
        condiciones en que lo recibió y sin más desgaste que los derivados de su uso normal, la garantía será
        devuelta a la finalización del contrato, contra la entrega de la llave.
      </p>
      <!-- <div class="page-break"></div> -->
      <p style="font-size:14px;text-align:justify;line-height:2">
        <strong><u>QUINTO</u></strong> <br>
        EL ARRENDATARIO declara recibir el inmueble, materia de contrato, en perfectas condiciones;
        comprometiéndose a devolverlo en el mismo estado, salvo el desgaste causado por el uso normal. En
        todo caso, cualquier daño en el inmueble originará la pérdida de la garantía a que se refiere la cláusula
        anterior. Asimismo, cualquier mejora que EL ARRENDATARIO introduzca al inmueble, deberá efectuarse
        con autorización de EL ARRENDADOR. Los gastos incurridos en tales mejoras deberán ser a costo y
        responsabilidad de EL ARRENDATARIO.
      </p>
      <p style="font-size:14px;text-align:justify;line-height:2">
        <strong><u>SEXTO</u></strong> <br>
        EL ARRENDATARIO no podrá subarrendar el inmueble materia del presente contrato, ni ceder sus
        derechos derivados del presente contrato, sin autorización escrita de EL ARRENDADOR. Caso contrario,
        EL ARRENDADOR podrá resolver el presente contrato
      </p>
      <p style="font-size:14px;text-align:justify;line-height:2">
        <strong><u>SETIMO</u></strong> <br>
        EL ARRENDADOR podrá visitar el inmueble materia de arrendamiento para el efecto de verificar su
        estado y el uso que se le está dando, previo aviso de 48 horas de anticipación.
      </p>
    </div>
    <br>
    <div style="width:100%">
      Lima, <b><u>{{date('d')}}</b></u> de <b><u>{{date('m')}}</b></u> de <b><u>{{date('Y')}}</b></u>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div style="margin-top:150px">
      <div style="float: left; width: 50%;text-align:center">
        <hr style="width:70%;margin:auto auto">
        <b>EL ARRENDADOR</u>
      </div>
      <div style="margin-left: 50%; width: 50%;text-align:center">
        <hr style="width:70%;margin:auto auto">
        <b>EL ARRENDATARIO</u>
      </div>
    </div>
</body>
</html>
