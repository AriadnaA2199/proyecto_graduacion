<div class="grid grid-cols-1 gap-4 md:grid-cols-3">
    <!-- Perfil Stats -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Rosters por Perfil</h3>
        </div>
        <div class="card-body">
            <ul>
                @foreach ($profileStats as $profile => $count)
                    <li>{{ $profile }}: {{ $count }}</li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Programa Stats -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Rosters por Programa</h3>
        </div>
        <div class="card-body">
            <ul>
                @foreach ($programStats as $program => $count)
                    <li>{{ $program }}: {{ $count }}</li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Status (Attendance) Stats -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Rosters por Status (Asistencia)</h3>
        </div>
        <div class="card-body">
            <ul>
                @foreach ($statusStats as $status => $count)
                    <li>{{ $status }}: {{ $count }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
