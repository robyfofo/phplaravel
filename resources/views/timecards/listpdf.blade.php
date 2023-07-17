
      <table border="1" width="100%" cellpadding="4" cellspacing="1">
				<caption>{{ $title }}</caption>
				<thead>
					<tr>
						<th>id</th>
						<th>Utente</th>
						<th>Progetto</th>
						<th>Contenuto</th>
						<th>Data</th>
						<th>inizio</th>
						<th>Fine</th>
						<th>Ore</th>
					</tr>
				</thead>

			

				<tbody>
					@php  $worktimes = array(); @endphp
					@foreach($timecards as $timecard)
					<tr>
						<td>{{ $timecard->id }}</td>
						<td>{{ $timecard->name }}, {{ $timecard->surname }}</td>
						<td>{{ $timecard->project }}</td>
						<td>{{ $timecard->content }}</td>
						<td>{{ $timecard->dateins }}</td>
						<td style="text-align:right;">{{ $timecard->starttime }}</td>
						<td style="text-align:right;">{{ $timecard->endtime }}</td>
						<td style="text-align:right;">{{ $timecard->worktime }}</td>

						
					</tr>

					@php  $worktimes[] = $timecard->worktime; @endphp

					@endforeach
				</tbody>

				<tfoot>
					<tr>
						<td colspan="7" class="text-end fw-bolder" style="text-align:right;">Totale ore</td>
						<td colspan="" class="text-end fw-bolder">@php  echo sumTheTime($worktimes); @endphp</td>
						
					</tr>
				</tfoot>

			</table>

