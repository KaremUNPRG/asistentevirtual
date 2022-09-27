<?php

namespace App\Http\Controllers\Bot;

use BotMan\BotMan\BotMan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Attachments\Location;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;

class ConversacionController extends Controller
{

    private $IdUsuario ;
    private $IdPropiedad ;

    public function obtenerChatBot($idPropiedad)
    {
      // dd($idPropiedad);
      $data = DB::table('pt_propiedad as p')
                      ->join('pt_propietario as pro','p.id_propietario','=','pro.id_propietario')
                      ->leftjoin('pt_chatbot as c','c.id_usuario','=','pro.id_usuario')
                      ->where('p.id_propiedad','=',$idPropiedad)->first();
      //dd($data);
      return $data;
    }

    /**
     * Place your BotMan logic here.
     */
    public function handle(Request $request)
    {
        $userId = $request->userId; 
        $userId = explode('-',$userId);
        $this->IdUsuario = $userId[0];
        $this->IdPropiedad = $userId[1];     
        $botman = app('botman');
        $botman->hears('{message}', function($botman, $message) {
            $botman->reply('Hola '.$message.'');
            $this->PreguntaTema($botman);
        });

       $botman->listen();

    }

    public function PreguntaTema($botman)
    {
        $question = Question::create("¿En qué puedo ayudarte? Elige una opción:")
        ->fallback('Unable to ask question')
        ->callbackId('ask_reason')
        ->addButtons([
            Button::create('Medio de Pago.')->value('mediopago'),
            Button::create('Horarios de contacto.')->value('horariocontacto'),
            Button::create('Cancelar Alquiler.')->value('cancelar'),
            Button::create('Cambio de fecha Alquiler.')->value('cambio'),
            Button::create('Ingresar Reclamo.')->value('reclamo')
            // Button::create('Otros')->value('otras'),
        ]);
        return $botman->ask($question, function (Answer $answer,$botman) {
          $userId = $botman->getBot()->getMessages()[0]->getPayload()['userId'];
          $userId = explode('-',$userId);
          if ($answer->isInteractiveMessageReply()) {
              if ($answer->getValue() === 'cancelar') {
                $op = new \App\Http\Controllers\Bot\ConversacionController;
                $op->ResponderCancelar($botman, $userId[1]);
              } else if($answer->getValue() === 'mediopago'){
                $op = new \App\Http\Controllers\Bot\ConversacionController;
                $op->ResponderMedioPago($botman, $userId[1]);
              } else if($answer->getValue() === 'horariocontacto'){
                $op = new \App\Http\Controllers\Bot\ConversacionController;
                $op->ResponderHoraContacto($botman, $userId[1]);
              }else if($answer->getValue() === 'cambio'){
                $op = new \App\Http\Controllers\Bot\ConversacionController;
                $op->ResponderCambio($botman, $userId[1]);
              }else if($answer->getValue() === 'reclamo'){
                $op = new \App\Http\Controllers\Bot\ConversacionController;
                $op->ResponderReclamo($botman, $userId[1]);
              }
          }else{
            $op = new \App\Http\Controllers\Bot\ConversacionController;
            $op->PreguntaTema($botman);
          }
      });
    }

    public function ResponderMedioPago($botman,$userId)
    {
        $medio = $this->obtenerChatBot($userId);
        // $botman->say( );
        $question = Question::create(empty($medio->mediopago)?'Sin Respuesta. ¿Desea ver las opciones anteriores?':('Los Medios de pagos son '.$medio->mediopago.'. ¿Desea ver las opciones anteriores?'))
        ->fallback('Unable to ask question')
        ->callbackId('ask_reason')
        ->addButtons([
            Button::create('SI')->value('si'),
            Button::create('NO')->value('no')
        ]);
        return $botman->ask($question, function (Answer $answer,$botman) {
          if ($answer->isInteractiveMessageReply()) {
              if ($answer->getValue() === 'si') {
                $op = new \App\Http\Controllers\Bot\ConversacionController;
                $op->PreguntaTema($botman);
              } else {
                $botman->say('Muchas Gracias!');
              
              }
          }
      });
        $op = new \App\Http\Controllers\Bot\ConversacionController;
        $op->PreguntaTema($botman);
    }

    public function ResponderHoraContacto($botman,$userId)
    {
        $medio = $this->obtenerChatBot($userId);
        // $botman->say( );
        $question = Question::create(empty($medio->horacontacto)?'Sin Respuesta. ¿Desea ver las opciones anteriores?':('Me puedes contactar a las '.$medio->horacontacto.'. ¿Desea ver las opciones anteriores?'))
        ->fallback('Unable to ask question')
        ->callbackId('ask_reason')
        ->addButtons([
            Button::create('SI')->value('si'),
            Button::create('NO')->value('no')
        ]);
        return $botman->ask($question, function (Answer $answer,$botman) {
          if ($answer->isInteractiveMessageReply()) {
              if ($answer->getValue() === 'si') {
                $op = new \App\Http\Controllers\Bot\ConversacionController;
                $op->PreguntaTema($botman);
              } else {
                $botman->say('Muchas Gracias!');
              
              }
          }
      });
        $op = new \App\Http\Controllers\Bot\ConversacionController;
        $op->PreguntaTema($botman);
    }

    public function ResponderCancelar($botman,$userId)
    {
        // $medio = $this->obtenerChatBot($userId);
        // $botman->say( );
        $question = Question::create('Porfavor indíquenos el motivo de cancelación.')
        ->fallback('Unable to ask question')
        ->callbackId('ask_reason');
        return $botman->ask($question, function (Answer $answer,$botman) {
          if ($answer->isInteractiveMessageReply()) {
              dd('Entro');
          }else{
            $botman->say('Muchas gracias en breve nos comunicaremos contigo.');
          }
        });
    }

    public function ResponderCambio($botman,$userId)
    {
        // $medio = $this->obtenerChatBot($userId);
        // $botman->say( );
        $question = Question::create('Porfavor indíquenos el motivo y la fecha que quiere.')
        ->fallback('Unable to ask question')
        ->callbackId('ask_reason');
        return $botman->ask($question, function (Answer $answer,$botman) {
          if ($answer->isInteractiveMessageReply()) {
              dd('Entro');
          }else{
            $botman->say('Muchas gracias en breve nos comunicaremos contigo');
          }
        });
    }

    public function ResponderReclamo($botman,$userId)
    {
        // $medio = $this->obtenerChatBot($userId);
        // $botman->say( );
        $question = Question::create('Porfavor indíquenos el motivo de su reclamo.')
        ->fallback('Unable to ask question')
        ->callbackId('ask_reason');
        return $botman->ask($question, function (Answer $answer,$botman) {
          if ($answer->isInteractiveMessageReply()) {
              dd('Entro');
          }else{
            $botman->say('Muchas gracias, estaremos atendiendo su reclamo');
          }
        });
    }
      /**
       * Place your BotMan logic here.
      */
    public function askUbicacion($botman){
        $attachment = new Location(61.766130, -6.822510);
        
        // Build message object
        $message = OutgoingMessage::create('This is my text')
                    ->withAttachment($attachment);
        
        // Reply message object
        $botman->say($message);
    //   $botman->say('https://www.google.com/maps/@-6.7174444,-79.9080448,15z');
      $op = new \App\Http\Controllers\Bot\ConversacionController;
            $op->askPreguntar($botman);
    }

    public function askPreguntar($botman)
    {
      // $funcion = $this->askPreguntar($botman);
      $question = Question::create("¿Que desea Saber?")
        ->fallback('Unable to ask question')
        ->callbackId('ask_reason')
        ->addButtons([
            Button::create('Horario a contactar')->value('contactar'),
            Button::create('Ubicación')->value('ubicacion'),
            Button::create('Télefono')->value('telefono'),
        ]);
        return $botman->ask($question, function (Answer $answer,$botman) {
          if ($answer->isInteractiveMessageReply()) {
              if ($answer->getValue() === 'contactar') {
                  $this->say('Me puedes contactar a las 12:30 PM.');
                  $op = new \App\Http\Controllers\Bot\ConversacionController;
            $op->askPreguntar($botman);
              } else if($answer->getValue() === 'ubicacion'){
                $op = new \App\Http\Controllers\Bot\ConversacionController;
                $op->askUbicacion($botman);
                // $this->askPreguntar($this);
                // Inspiring::quote()
                // $botman->say('NO ES PREGUNTA');
              }
          }else{
            $op = new \App\Http\Controllers\Bot\ConversacionController;
            $op->askPreguntar($botman);
            // $botman->say('PREGUNTAR DE NUEVO');
            // $this->askPreguntar($this);
          }
      });
    }
}
