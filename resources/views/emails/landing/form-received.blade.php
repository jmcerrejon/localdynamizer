@component('mail::message')

Alguien ha enviado datos a través del formulario de contacto. Estos son los datos:

```
@foreach ($collection as $key => $item)
· {{ $key }}: {{ $item }}
@endforeach
```

NOTA: Esto es un aviso automático. No responda a este correo.

```
Este mensaje y los archivos que contiene van dirigidos exclusivamente a su destinatario, pudiendo contener información confidencial sometida a secreto profesional. No está permitida su reproducción o distribución sin la autorización expresa de la empresa. Si usted no es el destinatario final por favor elimínelo e infórmenos por esta vía.
```

@endcomponent
