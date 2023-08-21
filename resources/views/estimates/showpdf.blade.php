<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Preventivo numero: {{ $estimate->id }} del {{ $estimate->dateins }}</title>

  <style>
    body {
      font-size: 12px;
      font-family:Arial, Helvetica, sans-serif;
    }
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
      vertical-align: top;
    }

    table#addresses td {
      width: 50%;
      padding: 10px;
    }

    table#addresses td span {
      display: inline-block;
      font-weight: bold;
      width: 40%;
    }

    table#dates {
      border: 0px;
    }
    table#dates td {
      padding: 10px;
      text-align: center;
      font-weight: bold;
      border: 0px;
    }

    table#details {
      border:0px;
    }

    table#details td {
      padding: 5px 20px 20px 10px;
      border:0px;
    }

    table#others {
      border:0px;
    }

    td#articles {
      width:75%;
      border:0px;
    }

    table.article caption {
      margin: 2px auto 20px auto;
      font-size: 1.1rem;
      font-weight: bold;
    }
    table.article td {
      padding: 2px 3px;
    }

    table.article td:nth-child(2),
    table.article td:nth-child(5),
    table.article td:nth-child(6),
    table.article td:nth-child(4){
      text-align: right;
      padding-right:10px;
      max-width:70px;
    }

    table.article td:nth-child(3){
      text-align: center;
      max-width:30px;
    }


    td#totals {
      padding: 5px 50px 20px 10px;
      font-size: 1.2em;
      border: 0px;
    }

    td#totals span {
      display:block;
      text-align: right;
    }
    td#totals span span{
      font-weight: bold;
      text-align: left;
      padding-right:20px;
    }


  </style>



</head>

<body>


  <table id="addresses">
    <tr>
      <td>
        <h2>Mittente</h2>
        {{ config()->get('settings.company_ragione_sociale') }}<br>
        {{ config()->get('settings.company_address') }}<br>
        P.IVA: {{ config()->get('settings.partita_iva') }}<br>
      </td>
      <td>
        <h2>Spettablile</h2>

        @if ($estimate->alt_thirdparty != '')
        {{ $estimate->alt_thirdparty }}

        @else

        <span>Ragione Sociale:</span> {{ $thirdparty->ragione_sociale }}<br>
        <span>Indirizzo:</span> {{ $thirdparty->street }}, {{ $thirdparty->zip_code }}, {{ $thirdparty->city }}<br>
        {{ $thirdparty->provincia }}, {{ $thirdparty->nation }}<br>
        <span>Email:</span> {{ $thirdparty->email }}<br>
        <span>Telefono:</span> {{ $thirdparty->telephone }}<br>
        <span>P.IVA:</span> {{ $thirdparty->partita_iva }}<br>
        <span>C.Fiscale:</span> {{ $thirdparty->codice_fiscale }}<br>

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
        <span>Scadenza:</span>{{ $estimate->datesca  }}
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

  <table id="others">
    <tr>
      <td id="articles">





        @isset($articles)
          @php
            $estimate_total = 0;
            $estimate_tax = 10;
          @endphp

          <table class="article">
            <caption>Lista articoli</caption>
            <tr>
              <th>Note</th><th>P.Unità</th><th>Q.tà</th><th>P.Totale</th><th>Imponibile</th><th>Totale</th>
            </tr>


              @foreach($articles as $article)
                @php
                  $article->tax = 10;
                  $article->price_tax = ($article->price_total * $article->tax)/100;
                  $article->total = $article->price_total + $article->price_tax;
                @endphp

                  <tr>
                    <td>{{ $article->note }}</td>
                    <td>€ {{ number_format($article->price_unity,2,',','.') }}</td>
                    <td>{{ $article->quantity }}</td>
                    <td>€ {{ number_format($article->price_total,2,',','.') }}</td>
                    <td>€ {{ number_format($article->price_tax,2,',','.') }}<sup>{{ $article->tax }}%</sup></td>
                    <td>€ {{ number_format($article->total,2,',','.') }}</td>
                  </tr>
                  <tr>
                    <td colspan="6">
                      {{ $article->content }}
                      
                    </td>
                  </tr> 
              @endforeach

          </table>

        @endisset
        
      </td>

      <td id="totals">
        <span><span>Totale articoli</span>€ {{ number_format($articles_total,2,',','.') }}</span>
        <span><span>Imponibile<sup>{{ $estimate->tax }}%</sup></span>€ {{ number_format($estimate->price_tax,2,',','.') }}</span>
        <span><span>Totale preventivo</span>€ {{ number_format($estimate->total,2,',','.') }}</span>

      </td>
    </tr>
  </table>

</body>

</html>