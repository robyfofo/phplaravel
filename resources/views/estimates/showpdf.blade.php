<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Preventivo numero: {{ $estimate->id }} del {{ $estimate->dateins }}</title>

  <style>
    
  table {
    border: 1px solid #000;
    border-collapse: collapse;
    width: 100%;
    margin-bottom: 10px;
  }

  table td {
    border: 1px solid #000;
    border-collapse: collapse;
    padding: 3px 2px;
  }  

  table#addresses td {

    width: 50%;
    padding: 10px;

  }
    

  </style>



</head>

<body>


  <table id="addresses">
    <tr>
      <td>
        {{ config()->get('settings.company_ragione_sociale') }}<br>
        {{ config()->get('settings.company_address') }}<br>
        P.IVA: {{ config()->get('settings.partita_iva') }}<br>


      </td>
      <td>

        @if ($estimate->alt_thirdparty != '')
        {{ $estimate->alt_thirdparty }}

        @else
        {{ $estimate->thirdparty_id }}

        @endif



      </td>
    </tr>


  </table>

  <table id="dates">
    <tr>
      <td><span>Numero:</span> {{ $estimate->id }}</td>
      <td>
        <span>Data:</span> {{ $estimate->dateins }}<br>
      </td>
      <td>
        <span>Scadenza:</span>{{ $estimate->datesca  }}<br>
      </td>
    </tr>
  </table>

  <table id="details">
    <tr>
      <td>{{ $estimate->note }}</td>
    </tr>
    <tr>
      <td>{{ $estimate->content }}</td>
    </tr>
  </table>

</body>

</html>