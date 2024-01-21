<table>
  <thead>
      <tr>
          <th scope="col">#</th>
          <th scope="col">User</th>
          <th scope="col">Check In</th>
          <th scope="col">Check Out</th>
          <th scope="col">Status</th>
          <th scope="col">Date</th>
          <th scope="col">Shift</th>
      </tr>
  </thead>
  <tbody>
      @foreach ($attendances as $attendance)
          <tr>
              <th scope="row">{{ $loop->iteration }}</th>
              <td>{{ $attendance->user->name }}</td>
              <td>{{ $attendance->check_in }}</td>
              <td>{{ $attendance->check_out }}</td>
              <td>
                  <span
                      class="{{ $attendance->status == 'Masuk' ? 'badge badge-success' : 'badge badge-danger' }}">
                      {{ $attendance->status }}
                  </span>
              </td>
              <td>{{ $attendance->datetime }}</td>
              <td>
                  <span class="badge badge-primary">{{ $attendance->shiftAttendance->name_shift }}</span>
              </td>
          </tr>
      @endforeach
  </tbody>
</table>